<?php include 'config/db_config.php'; include 'inc/header.php'; ?>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <div class="hero-badge">ដេប៉ាតឺម៉ង់កុំព្យូទ័រ · CPT Department</div>
    <h1>ស្វាគមន៍មកកាន់<br><span class="hl">ដេប៉ាតឺម៉ង់កុំព្យូទ័រ</span></h1>
    <p>បណ្តុះបណ្តាលជំនាញបច្ចេកវិទ្យា ជាមួយគ្រូបង្រៀនដែលមានបទពិសោធន៍ ដើម្បីបង្កើតអនាគតឌីជីថលដ៏រស់រវើក</p>
    <div class="hero-btns">
      <a href="courses.php" class="btn btn-primary">🎓 មើលមុខវិជ្ជា</a>
      <a href="register.php" class="btn btn-outline">📝 ចុះឈ្មោះឥឡូវ</a>
    </div>
    <div class="hero-stats">
      <?php
        $total_courses  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM courses"))[0];
        $total_teachers = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM teachers"))[0];
        $total_students = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM students"))[0];
      ?>
      <div><span class="stat-num"><?= $total_courses ?>+</span><span class="stat-lbl">មុខវិជ្ជា</span></div>
      <div><span class="stat-num"><?= $total_teachers ?></span><span class="stat-lbl">គ្រូបង្រៀន</span></div>
      <div><span class="stat-num"><?= max($total_students,100) ?>+</span><span class="stat-lbl">សិស្ស</span></div>
      <div><span class="stat-num">5+</span><span class="stat-lbl">ឆ្នាំបទពិសោធន៍</span></div>
    </div>
  </div>
</section>

<!-- COURSES -->
<section class="section section-gray">
  <div class="container">
    <div class="sec-head">
      <h2>មុខវិជ្ជាសិក្សារបស់យើង</h2>
      <p>ជ្រើសរើសមុខវិជ្ជាដែលស្របនឹងសក្តានុពល និងក្តីស្រឡាញ់របស់អ្នក</p>
      <div class="sec-line"></div>
    </div>
    <div class="grid-3">
      <?php $courses = mysqli_query($conn,"SELECT * FROM courses LIMIT 6");
      while($c = mysqli_fetch_assoc($courses)): ?>
      <div class="card" data-aos>
        <div class="card-img-placeholder"><?= htmlspecialchars($c['icon']) ?></div>
        <div class="card-body">
          <h3><?= htmlspecialchars($c['course_name']) ?></h3>
          <p><?= htmlspecialchars(substr($c['description'],0,90)) ?>...</p>
          <div class="card-meta">
            <span>⏱ <?= htmlspecialchars($c['duration']) ?></span>
            <span>📊 <?= $c['level'] === 'beginner' ? 'ចាប់ផ្ដើម' : ($c['level']==='intermediate'?'មធ្យម':'ខ្ពស់') ?></span>
          </div>
          <a href="register.php?course=<?= $c['id'] ?>" class="btn btn-primary btn-sm">ចុះឈ្មោះ →</a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <div style="text-align:center;margin-top:36px;">
      <a href="courses.php" class="btn btn-primary">មើលមុខវិជ្ជាទាំងអស់ →</a>
    </div>
  </div>
</section>

<!-- STATS BANNER -->
<section class="stats-banner">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-box"><span class="num">6+</span><div class="lbl">មុខវិជ្ជា</div></div>
      <div class="stat-box"><span class="num">5</span><div class="lbl">គ្រូបង្រៀន</div></div>
      <div class="stat-box"><span class="num">100%</span><div class="lbl">បង្រៀនដោយប្រើ Practice</div></div>
      <div class="stat-box"><span class="num">5+</span><div class="lbl">ឆ្នាំបទពិសោធន៍</div></div>
    </div>
  </div>
</section>

<!-- TEACHERS PREVIEW -->
<section class="section section-white">
  <div class="container">
    <div class="sec-head">
      <h2>គ្រូបង្រៀនរបស់យើង</h2>
      <p>ក្រុមគ្រូបង្រៀនដែលមានបទពិសោធន៍ និងចំណង់ចំណូលចិត្តខ្ពស់</p>
      <div class="sec-line"></div>
    </div>
    <div class="grid-4">
      <?php $teachers = mysqli_query($conn,"SELECT * FROM teachers ORDER BY is_head DESC LIMIT 4");
      while($t = mysqli_fetch_assoc($teachers)): ?>
      <div class="teacher-card">
        <?php if($t['is_head']): ?><span class="teacher-head-badge">⭐ ប្រធានដេប៉ាតឺម៉ង់</span><?php endif; ?>
        <div class="teacher-avatar">
          <?php if($t['photo'] && $t['photo']!='default.jpg'): ?>
            <img src="uploads/teachers/<?= htmlspecialchars($t['photo']) ?>" alt="">
          <?php else: ?>👨‍🏫<?php endif; ?>
        </div>
        <h4><?= htmlspecialchars($t['name']) ?></h4>
        <span class="role"><?= htmlspecialchars($t['position']) ?></span>
        <p class="subject"><?= htmlspecialchars($t['subject']) ?></p>
      </div>
      <?php endwhile; ?>
    </div>
    <div style="text-align:center;margin-top:32px;">
      <a href="teachers.php" class="btn btn-primary">មើលគ្រូទាំងអស់ →</a>
    </div>
  </div>
</section>

<!-- NEWS PREVIEW -->
<section class="section section-gray">
  <div class="container">
    <div class="sec-head">
      <h2>ព័ត៌មានថ្មីៗ</h2>
      <p>ព្រឹត្តិការណ៍ និងព័ត៌មានថ្មីៗពីដេប៉ាតឺម៉ង់</p>
      <div class="sec-line"></div>
    </div>
    <div class="grid-3">
      <?php $news = mysqli_query($conn,"SELECT * FROM news WHERE is_active=1 ORDER BY created_at DESC LIMIT 3");
      if(mysqli_num_rows($news) > 0):
        while($n = mysqli_fetch_assoc($news)): ?>
        <div class="news-card">
          <div class="news-img-ph">📰</div>
          <div class="news-body">
            <div class="news-date">📅 <?= date('d M Y', strtotime($n['created_at'])) ?></div>
            <h3><?= htmlspecialchars($n['title']) ?></h3>
            <p><?= htmlspecialchars(substr($n['content'],0,100)) ?>...</p>
          </div>
        </div>
      <?php endwhile; else: ?>
        <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--g2);">
          <p>មិនទាន់មានព័ត៌មានថ្មីៗ — <a href="admin/news.php" style="color:var(--blue)">បន្ថែមព័ត៌មាន</a></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section-dark">
  <div class="container" style="text-align:center;">
    <h2 style="font-family:'Outfit',sans-serif;color:#fff;font-size:2rem;font-weight:800;margin-bottom:14px;">ចាប់ផ្ដើមដំណើររៀន CS ថ្ងៃនេះ!</h2>
    <p style="color:var(--g2);margin-bottom:32px;max-width:500px;margin-left:auto;margin-right:auto;">
      ចុះឈ្មោះឥឡូវ ហើយចាប់ផ្ដើមបង្កើតអនាគតបច្ចេកវិទ្យារបស់អ្នក
    </p>
    <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
      <a href="register.php" class="btn btn-primary">📝 ចុះឈ្មោះឥឡូវនេះ</a>
      <a href="contact.php"  class="btn btn-outline">📞 ទំនាក់ទំនងយើង</a>
    </div>
  </div>
</section>

<?php include 'inc/footer.php'; ?>
