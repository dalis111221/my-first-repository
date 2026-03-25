<?php include 'config/db_config.php'; include 'inc/header.php'; ?>
<section class="page-banner">
  <div class="container">
    <h1>មុខវិជ្ជាទាំងអស់</h1>
    <p>ជ្រើសរើស course ដែលស្របនឹងក្តីស្រឡាញ់របស់អ្នក</p>
    <div class="breadcrumb"><a href="index.php">ទំព័រដើម</a> › មុខវិជ្ជា</div>
  </div>
</section>

<section class="section section-gray">
  <div class="container">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
      <?php $courses = mysqli_query($conn,"SELECT * FROM courses ORDER BY id");
      while($c = mysqli_fetch_assoc($courses)): ?>
      <div class="course-item">
        <div class="course-icon"><?= htmlspecialchars($c['icon']) ?></div>
        <div class="course-info">
          <h3><?= htmlspecialchars($c['course_name']) ?></h3>
          <span>⏱ <?= htmlspecialchars($c['duration']) ?> &nbsp;·&nbsp;
            <?= $c['level']==='beginner'?'ចាប់ផ្ដើម':($c['level']==='intermediate'?'មធ្យម':'ខ្ពស់') ?>
          </span>
          <br>
          <a href="register.php?course=<?= $c['id'] ?>" class="btn btn-primary btn-sm" style="margin-top:10px;">ចុះឈ្មោះ</a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
