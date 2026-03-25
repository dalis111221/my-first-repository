<?php include 'config/db_config.php'; include 'inc/header.php'; ?>
<section class="page-banner">
  <div class="container">
    <h1>គ្រូបង្រៀនរបស់យើង</h1>
    <p>ក្រុមគ្រូបង្រៀនដែលឧទ្ទិសដល់ការអប់រំ</p>
    <div class="breadcrumb"><a href="index.php">ទំព័រដើម</a> › គ្រូបង្រៀន</div>
  </div>
</section>
<section class="section section-gray">
  <div class="container">
    <div class="grid-4">
      <?php $teachers = mysqli_query($conn,"SELECT * FROM teachers ORDER BY is_head DESC, id");
      while($t = mysqli_fetch_assoc($teachers)): ?>
      <div class="teacher-card">
        <?php if($t['is_head']): ?><span class="teacher-head-badge">⭐ ប្រធានដេប៉ាតឺម៉ង់</span><?php endif; ?>
        <div class="teacher-avatar">👨‍🏫</div>
        <h4><?= htmlspecialchars($t['name']) ?></h4>
        <span class="role"><?= htmlspecialchars($t['position']) ?></span>
        <p class="subject" style="font-size:.8rem;color:var(--g3);margin-top:6px;"><?= htmlspecialchars($t['subject']) ?></p>
        <?php if($t['email']): ?><p style="font-size:.78rem;color:var(--g2);margin-top:4px;">📧 <?= htmlspecialchars($t['email']) ?></p><?php endif; ?>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
