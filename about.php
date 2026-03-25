<?php include 'config/db_config.php'; include 'inc/header.php'; ?>
<section class="section section-gray">
  <div class="container">
    <div class="about-hero-box">
      <h1>អំពីដេប៉ាតឺម៉ង់យើង</h1>
      <p>ដេប៉ាតឺម៉ង់កុំព្យូទ័របង្កើតឡើងក្នុងគោលបំណងពង្រឹងសមត្ថភាពសិស្ស ក្នុងវិស័យបច្ចេកវិទ្យា តាមរយៈការផ្ដល់ចំណេះដឹងពិត ប្រកបដោយក្រមសីលធម៌ និងវិជ្ជាជីវៈខ្ពស់ ដើម្បីឆ្លើយតបទៅនឹងតម្រូវការទីផ្សារការងារ។</p>
      <div class="vision-box">
        <h3>👁️ ចក្ខុវិស័យ</h3>
        <p>ក្លាយជាមជ្ឈមណ្ឌលបណ្តុះបណ្តាលបច្ចេកវិទ្យាឈានមុខ ដែលបង្កើតធនធានមនុស្សប្រកបដោយនវានុវត្តន៍។</p>
      </div>
    </div>

    <div class="sec-head"><h2>ថ្នាក់ដឹកនាំ &amp; គ្រូបង្រៀន</h2><div class="sec-line"></div></div>
    <div class="grid-4">
      <?php $teachers = mysqli_query($conn,"SELECT * FROM teachers ORDER BY is_head DESC, id");
      while($t = mysqli_fetch_assoc($teachers)): ?>
      <div class="teacher-card">
        <?php if($t['is_head']): ?><span class="teacher-head-badge">⭐ ប្រធាន</span><?php endif; ?>
        <div class="teacher-avatar">👨‍🏫</div>
        <h4><?= htmlspecialchars($t['name']) ?></h4>
        <span class="role"><?= htmlspecialchars($t['position']) ?></span>
        <p class="subject" style="font-size:.8rem;color:var(--g3);margin-top:6px;"><?= htmlspecialchars($t['subject']) ?></p>
      </div>
      <?php endwhile; ?>
    </div>

    <div class="sec-head" style="margin-top:56px;"><h2>គុណតម្លៃស្នូល</h2><div class="sec-line"></div></div>
    <div class="grid-3">
      <?php $values=[['🎯','ផ្ដោតលើ Practice','រៀន ហើយអនុវត្តភ្លាម ប្រើ projects ពិតប្រាកដ'],['🤝','ក្រុមការងារ','ផ្ដើមចេញពីការធ្វើការជាក្រុម teamwork'],['🚀','Innovation','លើកទឹកចិត្ត creativity និង problem solving']];
      foreach($values as $v): ?>
      <div class="card">
        <div class="card-img-placeholder" style="height:120px;font-size:48px;"><?= $v[0] ?></div>
        <div class="card-body"><h3><?= $v[1] ?></h3><p><?= $v[2] ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
