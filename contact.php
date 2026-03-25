<?php
include 'config/db_config.php'; include 'inc/header.php';
$msg = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    $stmt = $conn->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$subject,$message);
    $msg = $stmt->execute()
        ? "<div class='alert alert-success'>✅ សាររបស់អ្នកបានផ្ញើជោគជ័យ! យើងនឹងឆ្លើយតបឆាប់ៗ។</div>"
        : "<div class='alert alert-error'>❌ មានបញ្ហា: ".$conn->error."</div>";
}
?>
<section class="page-banner">
  <div class="container">
    <h1>ទាក់ទងមកយើង</h1>
    <p>យើងរីករាយឆ្លើយតបគ្រប់សំណួររបស់អ្នក</p>
    <div class="breadcrumb"><a href="index.php">ទំព័រដើម</a> › ទំនាក់ទំនង</div>
  </div>
</section>
<section class="section section-gray">
  <div class="container">
    <?= $msg ?>
    <div class="contact-wrap">
      <div class="contact-info-box">
        <h3>ព័ត៌មានទំនាក់ទំនង</h3>
        <div class="info-row"><div class="info-icon">📍</div><div class="info-text"><strong>ទីតាំង</strong><span>សំបូរ, ខេត្តកំពង់ធំ, កម្ពុជា</span></div></div>
        <div class="info-row"><div class="info-icon">📞</div><div class="info-text"><strong>ទូរស័ព្ទ</strong><span>012 345 678</span></div></div>
        <div class="info-row"><div class="info-icon">📧</div><div class="info-text"><strong>អ៊ីមែល</strong><span>info@cpt.edu.kh</span></div></div>
        <div class="info-row"><div class="info-icon">⏰</div><div class="info-text"><strong>ម៉ោងធ្វើការ</strong><span>ច័ន្ទ–សុក្រ: 7:00–17:00</span></div></div>
      </div>
      <div class="contact-form-box">
        <form method="POST">
          <div class="form-group"><label>ឈ្មោះពេញ *</label><input type="text" name="name" class="form-control" required placeholder="ឈ្មោះរបស់អ្នក"></div>
          <div class="form-group"><label>អ៊ីមែល *</label><input type="email" name="email" class="form-control" required placeholder="example@mail.com"></div>
          <div class="form-group"><label>ប្រធានបទ</label><input type="text" name="subject" class="form-control" placeholder="ប្រធានបទ"></div>
          <div class="form-group"><label>សាររបស់អ្នក *</label><textarea name="message" class="form-control" required placeholder="សរសេរសាររបស់អ្នក..."></textarea></div>
          <button type="submit" class="btn btn-primary" style="width:100%;">📩 ផ្ញើសារ</button>
        </form>
      </div>
    </div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
