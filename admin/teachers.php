<?php
include '../config/db_config.php';
include 'inc/header.php';
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name     = $conn->real_escape_string(trim($_POST['name']));
    $position = $conn->real_escape_string(trim($_POST['position']));
    $subject  = $conn->real_escape_string(trim($_POST['subject']));
    $email    = $conn->real_escape_string(trim($_POST['email']));
    $phone    = $conn->real_escape_string(trim($_POST['phone']));
    $is_head  = isset($_POST['is_head'])?1:0;
    if($is_head) mysqli_query($conn,"UPDATE teachers SET is_head=0");
    if(isset($_POST['edit_id']) && $_POST['edit_id']>0){
        $id=(int)$_POST['edit_id'];
        mysqli_query($conn,"UPDATE teachers SET name='$name',position='$position',subject='$subject',email='$email',phone='$phone',is_head=$is_head WHERE id=$id");
        $msg="<div class='alert alert-success'>✅ កែបានជោគជ័យ!</div>";
    } else {
        mysqli_query($conn,"INSERT INTO teachers (name,position,subject,email,phone,is_head) VALUES ('$name','$position','$subject','$email','$phone',$is_head)");
        $msg="<div class='alert alert-success'>✅ បន្ថែមបានជោគជ័យ!</div>";
    }
}
if(isset($_GET['del'])){ mysqli_query($conn,"DELETE FROM teachers WHERE id=".(int)$_GET['del']); header("Location: teachers.php"); exit; }
$edit=null;
if(isset($_GET['edit'])){ $edit=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM teachers WHERE id=".(int)$_GET['edit'])); }
$teachers=mysqli_query($conn,"SELECT * FROM teachers ORDER BY is_head DESC, id");
?>
<div class="admin-header"><h1>👨‍🏫 គ្រប់គ្រងគ្រូបង្រៀន</h1></div>
<?= $msg ?>
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:24px;">
  <div style="background:#fff;padding:24px;border-radius:14px;border:1px solid #e8edf5;">
    <h3 style="font-family:'Outfit',sans-serif;font-size:1rem;font-weight:700;margin-bottom:18px;"><?= $edit?'✏️ កែ':'➕ បន្ថែម' ?></h3>
    <form method="POST">
      <?php if($edit): ?><input type="hidden" name="edit_id" value="<?= $edit['id'] ?>"><?php endif; ?>
      <div class="form-group"><label>ឈ្មោះ *</label><input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($edit['name']??'') ?>"></div>
      <div class="form-group"><label>តួនាទី</label><input type="text" name="position" class="form-control" value="<?= htmlspecialchars($edit['position']??'') ?>" placeholder="គ្រូបង្រៀន"></div>
      <div class="form-group"><label>មុខវិជ្ជា</label><input type="text" name="subject" class="form-control" value="<?= htmlspecialchars($edit['subject']??'') ?>"></div>
      <div class="form-group"><label>អ៊ីមែល</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($edit['email']??'') ?>"></div>
      <div class="form-group"><label>ទូរស័ព្ទ</label><input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($edit['phone']??'') ?>"></div>
      <div class="form-group" style="display:flex;align-items:center;gap:8px;">
        <input type="checkbox" name="is_head" id="ih" <?= ($edit['is_head']??0)?'checked':'' ?>>
        <label for="ih" style="margin:0;">ប្រធានដេប៉ាតឺម៉ង់</label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">💾 រក្សាទុក</button>
      <?php if($edit): ?><a href="teachers.php" class="btn btn-sm" style="width:100%;justify-content:center;margin-top:8px;background:#f1f5f9;color:var(--navy2);border:1px solid #e2e8f0;">បោះបង់</a><?php endif; ?>
    </form>
  </div>
  <div>
    <table class="data-table">
      <thead><tr><th>ឈ្មោះ</th><th>តួនាទី</th><th>មុខវិជ្ជា</th><th></th></tr></thead>
      <tbody>
        <?php while($r=mysqli_fetch_assoc($teachers)): ?>
        <tr>
          <td><strong><?= htmlspecialchars($r['name']) ?></strong><?php if($r['is_head']): ?> <span class="badge badge-amber">ប្រធាន</span><?php endif; ?></td>
          <td><?= htmlspecialchars($r['position']) ?></td>
          <td style="font-size:.8rem;color:var(--g3);"><?= htmlspecialchars($r['subject']) ?></td>
          <td style="display:flex;gap:4px;">
            <a href="?edit=<?= $r['id'] ?>" class="btn btn-sm" style="background:#dbeafe;color:#1e40af;border:none;">✏️</a>
            <a href="?del=<?= $r['id'] ?>"  class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;" onclick="return confirm('លុបមែនទេ?')">🗑</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
