<?php
include 'config/db_config.php'; include 'inc/header.php';
$msg=''; $course_id = isset($_GET['course']) ? (int)$_GET['course'] : 0;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name     = htmlspecialchars(trim($_POST['name']));
    $email    = htmlspecialchars(trim($_POST['email']));
    $phone    = htmlspecialchars(trim($_POST['phone']));
    $cid      = (int)$_POST['course_id'];
    $stmt = $conn->prepare("INSERT INTO students (name,email,phone,course_id,status) VALUES (?,?,?,?,'pending')");
    $stmt->bind_param("sssi",$name,$email,$phone,$cid);
    $msg = $stmt->execute()
        ? "<div class='alert alert-success'>🎉 ចុះឈ្មោះបានជោគជ័យ! យើងនឹងទំនាក់ទំនងទៅអ្នក។</div>"
        : "<div class='alert alert-error'>❌ កំហុស: ".$conn->error."</div>";
}
$courses = mysqli_query($conn,"SELECT id, course_name FROM courses ORDER BY course_name");
?>
<section class="register-page">
  <div class="register-card">
    <h2>📝 ចុះឈ្មោះចូលរៀន</h2>
    <p class="sub">បំពេញព័ត៌មានខាងក្រោម ហើយយើងនឹងទំនាក់ទំនងទៅអ្នក</p>
    <?= $msg ?>
    <form method="POST">
      <div class="form-group"><label>ឈ្មោះពេញ *</label>
        <input type="text" name="name" class="form-control" required placeholder="ឈ្មោះ និងនាមត្រកូល"></div>
      <div class="form-group"><label>អ៊ីមែល *</label>
        <input type="email" name="email" class="form-control" required placeholder="example@mail.com"></div>
      <div class="form-group"><label>លេខទូរស័ព្ទ</label>
        <input type="tel" name="phone" class="form-control" placeholder="0xx xxx xxx"></div>
      <div class="form-group"><label>មុខវិជ្ជា *</label>
        <select name="course_id" class="form-control" required>
          <option value="">-- ជ្រើសរើសមុខវិជ្ជា --</option>
          <?php while($c=mysqli_fetch_assoc($courses)): ?>
          <option value="<?= $c['id'] ?>" <?= $c['id']==$course_id?'selected':'' ?>>
            <?= htmlspecialchars($c['course_name']) ?>
          </option>
          <?php endwhile; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-green" style="width:100%;justify-content:center;">✅ ផ្ញើព័ត៌មានចុះឈ្មោះ</button>
    </form>
    <p style="text-align:center;margin-top:16px;font-size:.82rem;color:var(--g3);">
      មានសំណួរ? <a href="contact.php" style="color:var(--blue);font-weight:600;">ទំនាក់ទំនងយើង</a>
    </p>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
