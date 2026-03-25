<?php
include '../config/db_config.php';
include 'inc/header.php';
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $title   = $conn->real_escape_string(trim($_POST['title']));
    $content = $conn->real_escape_string(trim($_POST['content']));
    $active  = isset($_POST['is_active'])?1:0;
    if(isset($_POST['edit_id']) && $_POST['edit_id']>0){
        $id=(int)$_POST['edit_id'];
        mysqli_query($conn,"UPDATE news SET title='$title',content='$content',is_active=$active WHERE id=$id");
        $msg="<div class='alert alert-success'>✅ កែបានជោគជ័យ!</div>";
    } else {
        mysqli_query($conn,"INSERT INTO news (title,content,is_active) VALUES ('$title','$content',$active)");
        $msg="<div class='alert alert-success'>✅ បន្ថែមបានជោគជ័យ!</div>";
    }
}
if(isset($_GET['del'])){ mysqli_query($conn,"DELETE FROM news WHERE id=".(int)$_GET['del']); header("Location: news.php"); exit; }
if(isset($_GET['toggle'])){
    $r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT is_active FROM news WHERE id=".(int)$_GET['toggle']));
    mysqli_query($conn,"UPDATE news SET is_active=".($r['is_active']?0:1)." WHERE id=".(int)$_GET['toggle']);
    header("Location: news.php"); exit;
}
$edit=null;
if(isset($_GET['edit'])){ $edit=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM news WHERE id=".(int)$_GET['edit'])); }
$news=mysqli_query($conn,"SELECT * FROM news ORDER BY created_at DESC");
?>
<div class="admin-header"><h1>📰 គ្រប់គ្រងព័ត៌មាន</h1></div>
<?= $msg ?>
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:24px;">
  <div style="background:#fff;padding:24px;border-radius:14px;border:1px solid #e8edf5;">
    <h3 style="font-family:'Outfit',sans-serif;font-size:1rem;font-weight:700;margin-bottom:18px;"><?= $edit?'✏️ កែ':'➕ បន្ថែមព័ត៌មាន' ?></h3>
    <form method="POST">
      <?php if($edit): ?><input type="hidden" name="edit_id" value="<?= $edit['id'] ?>"><?php endif; ?>
      <div class="form-group"><label>ចំណងជើង *</label>
        <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($edit['title']??'') ?>"></div>
      <div class="form-group"><label>ខ្លឹមសារ *</label>
        <textarea name="content" class="form-control" rows="5" required><?= htmlspecialchars($edit['content']??'') ?></textarea></div>
      <div class="form-group" style="display:flex;align-items:center;gap:8px;">
        <input type="checkbox" name="is_active" id="ia" <?= ($edit['is_active']??1)?'checked':'' ?>>
        <label for="ia" style="margin:0;">បង្ហាញ</label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">💾 រក្សាទុក</button>
      <?php if($edit): ?><a href="news.php" class="btn btn-sm" style="width:100%;justify-content:center;margin-top:8px;background:#f1f5f9;color:var(--navy2);border:1px solid #e2e8f0;">បោះបង់</a><?php endif; ?>
    </form>
  </div>
  <div>
    <table class="data-table">
      <thead><tr><th>ចំណងជើង</th><th>ស្ថានភាព</th><th>ថ្ងៃ</th><th></th></tr></thead>
      <tbody>
        <?php while($r=mysqli_fetch_assoc($news)): ?>
        <tr>
          <td><?= htmlspecialchars(substr($r['title'],0,50)) ?></td>
          <td><span class="badge <?= $r['is_active']?'badge-green':'badge-red' ?>"><?= $r['is_active']?'បង្ហាញ':'លាក់' ?></span></td>
          <td style="font-size:.78rem;color:var(--g3);"><?= date('d/m/Y',strtotime($r['created_at'])) ?></td>
          <td style="display:flex;gap:4px;">
            <a href="?edit=<?= $r['id'] ?>"   class="btn btn-sm" style="background:#dbeafe;color:#1e40af;border:none;">✏️</a>
            <a href="?toggle=<?= $r['id'] ?>" class="btn btn-sm" style="background:#fef3c7;color:#92400e;border:none;">👁</a>
            <a href="?del=<?= $r['id'] ?>"    class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;" onclick="return confirm('លុបមែនទេ?')">🗑</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
