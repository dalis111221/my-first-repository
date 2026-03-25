<?php
include '../config/db_config.php';
include 'inc/header.php';
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name  = $conn->real_escape_string(trim($_POST['course_name']));
    $desc  = $conn->real_escape_string(trim($_POST['description']));
    $icon  = $conn->real_escape_string(trim($_POST['icon']));
    $dur   = $conn->real_escape_string(trim($_POST['duration']));
    $level = $conn->real_escape_string($_POST['level']);
    if(isset($_POST['edit_id']) && $_POST['edit_id']>0){
        $id=(int)$_POST['edit_id'];
        mysqli_query($conn,"UPDATE courses SET course_name='$name',description='$desc',icon='$icon',duration='$dur',level='$level' WHERE id=$id");
        $msg="<div class='alert alert-success'>✅ កែសម្រួលបានជោគជ័យ!</div>";
    } else {
        mysqli_query($conn,"INSERT INTO courses (course_name,description,icon,duration,level) VALUES ('$name','$desc','$icon','$dur','$level')");
        $msg="<div class='alert alert-success'>✅ បន្ថែមមុខវិជ្ជាបានជោគជ័យ!</div>";
    }
}
if(isset($_GET['del'])){
    mysqli_query($conn,"DELETE FROM courses WHERE id=".(int)$_GET['del']);
    header("Location: courses.php"); exit;
}
$edit=null;
if(isset($_GET['edit'])){
    $edit=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM courses WHERE id=".(int)$_GET['edit']));
}
$courses=mysqli_query($conn,"SELECT * FROM courses ORDER BY id");
?>
<div class="admin-header"><h1>📚 គ្រប់គ្រងមុខវិជ្ជា</h1></div>
<?= $msg ?>
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:24px;">
  <div style="background:#fff;padding:24px;border-radius:14px;border:1px solid #e8edf5;">
    <h3 style="font-family:'Outfit',sans-serif;font-size:1rem;font-weight:700;margin-bottom:18px;"><?= $edit?'✏️ កែសម្រួល':'➕ បន្ថែមមុខវិជ្ជា' ?></h3>
    <form method="POST">
      <?php if($edit): ?><input type="hidden" name="edit_id" value="<?= $edit['id'] ?>"><?php endif; ?>
      <div class="form-group"><label>ឈ្មោះមុខវិជ្ជា *</label>
        <input type="text" name="course_name" class="form-control" required value="<?= htmlspecialchars($edit['course_name']??'') ?>"></div>
      <div class="form-group"><label>Icon (emoji)</label>
        <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($edit['icon']??'💻') ?>"></div>
      <div class="form-group"><label>រយៈពេល</label>
        <input type="text" name="duration" class="form-control" value="<?= htmlspecialchars($edit['duration']??'1 ឆ្នាំ') ?>"></div>
      <div class="form-group"><label>កម្រិត</label>
        <select name="level" class="form-control">
          <?php foreach(['beginner'=>'ចាប់ផ្ដើម','intermediate'=>'មធ្យម','advanced'=>'ខ្ពស់'] as $v=>$l): ?>
          <option value="<?= $v ?>" <?= ($edit['level']??'')===$v?'selected':'' ?>><?= $l ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group"><label>ការរៀបរាប់</label>
        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($edit['description']??'') ?></textarea></div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">💾 រក្សាទុក</button>
      <?php if($edit): ?><a href="courses.php" class="btn btn-sm" style="width:100%;justify-content:center;margin-top:8px;background:#f1f5f9;color:var(--navy2);border:1px solid #e2e8f0;"> បោះបង់</a><?php endif; ?>
    </form>
  </div>
  <div>
    <table class="data-table">
      <thead><tr><th>Icon</th><th>ឈ្មោះ</th><th>រយៈពេល</th><th>កម្រិត</th><th></th></tr></thead>
      <tbody>
        <?php while($r=mysqli_fetch_assoc($courses)): ?>
        <tr>
          <td style="font-size:1.5rem;text-align:center;"><?= htmlspecialchars($r['icon']) ?></td>
          <td><strong><?= htmlspecialchars($r['course_name']) ?></strong></td>
          <td><?= htmlspecialchars($r['duration']) ?></td>
          <td><?= $r['level']==='beginner'?'ចាប់ផ្ដើម':($r['level']==='intermediate'?'មធ្យម':'ខ្ពស់') ?></td>
          <td style="display:flex;gap:6px;">
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
