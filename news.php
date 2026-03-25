<?php include 'config/db_config.php'; include 'inc/header.php'; ?>
<section class="page-banner">
  <div class="container">
    <h1>ព័ត៌មានថ្មីៗ</h1>
    <p>ព្រឹត្តិការណ៍ និងព័ត៌មានពីដេប៉ាតឺម៉ង់</p>
    <div class="breadcrumb"><a href="index.php">ទំព័រដើម</a> › ព័ត៌មាន</div>
  </div>
</section>
<section class="section section-gray">
  <div class="container">
    <div class="grid-3">
      <?php $news = mysqli_query($conn,"SELECT * FROM news WHERE is_active=1 ORDER BY created_at DESC");
      if(mysqli_num_rows($news)>0):
        while($n = mysqli_fetch_assoc($news)): ?>
        <div class="news-card">
          <div class="news-img-ph">📰</div>
          <div class="news-body">
            <div class="news-date">📅 <?= date('d M Y',strtotime($n['created_at'])) ?></div>
            <h3><?= htmlspecialchars($n['title']) ?></h3>
            <p><?= htmlspecialchars(substr($n['content'],0,120)) ?>...</p>
          </div>
        </div>
      <?php endwhile; else: ?>
        <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--g2);">
          <p style="font-size:3rem;margin-bottom:12px;">📭</p>
          <p>មិនទាន់មានព័ត៌មានថ្មីៗ</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php include 'inc/footer.php'; ?>
