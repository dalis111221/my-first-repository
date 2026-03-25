<?php
include '../config/db_config.php';
include 'inc/header.php';
// Update status
if(isset($_POST['update_status'])){
    $id=(int)$_POST['id']; $st=$conn->real_escape_string($_POST['status']);
    mysqli_query($conn,"UPDATE students SET status='$st' WHERE id=$id");
}
// Delete
if(isset($_GET['del'])){
    $id=(int)$_GET['del'];
    mysqli_query($conn,"DELETE FROM students WHERE id=$id");
    header("Location: students.php"); exit;
}
$students = mysqli_query($conn,"SELECT s.*,c.course_name FROM students s LEFT JOIN courses c ON s.course_id=c.id ORDER BY s.created_at DESC");
?>
<div class="admin-header">
  <h1>🎓 គ្រប់គ្រងសិស្ស</h1>
  <span style="font-size:.85rem;color:var(--g3);"><?= mysqli_num_rows($students) ?> នាក់</span>
</div>
<table class="data-table">
  <thead><tr><th>#</th><th>ឈ្មោះ</th><th>ទូរស័ព្ទ</th><th>មុខវិជ្ជា</th><th>ស្ថានភាព</th><th>ចុះឈ្មោះ</th><th>សកម្មភាព</th></tr></thead>
  <tbody>
    <?php $i=1; while($r=mysqli_fetch_assoc($students)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td><strong><?= htmlspecialchars($r['name']) ?></strong><br><span style="font-size:.75rem;color:var(--g3);"><?= htmlspecialchars($r['email']) ?></span></td>
      <td><?= htmlspecialchars($r['phone']??'—') ?></td>
      <td><?= htmlspecialchars($r['course_name']??'—') ?></td>
      <td>
        <form method="POST" style="display:inline">
          <input type="hidden" name="id" value="<?= $r['id'] ?>">
          <select name="status" class="form-control" style="padding:4px 8px;font-size:.78rem;width:auto;" onchange="this.form.submit()">
            <?php foreach(['pending'=>'រង់ចាំ','active'=>'កំពុងរៀន','completed'=>'បញ្ចប់'] as $v=>$l): ?>
            <option value="<?= $v ?>" <?= $r['status']==$v?'selected':'' ?>><?= $l ?></option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" name="update_status" value="1">
        </form>
      </td>
      <td style="font-size:.78rem;color:var(--g3);"><?= date('d/m/Y',strtotime($r['created_at'])) ?></td>
      <td><a href="?del=<?= $r['id'] ?>" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;" onclick="return confirm('លុបមែនទេ?')">🗑</a></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php include 'inc/footer.php'; ?>
