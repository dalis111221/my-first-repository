<?php $page = basename($_SERVER['PHP_SELF'],'php'); ?>
<!DOCTYPE html>
<html lang="km">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>CPT Department — ដេប៉ាតឺម៉ង់កុំព្យូទ័រ</title>
  <link rel="stylesheet" href="/cpt/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<header>
  <nav class="navbar">
    <a href="/cpt/index.php" class="logo">
      <div class="logo-icon">💻</div>
      <span class="logo-text">CPT<span>.</span>Dept</span>
    </a>
    <ul class="nav-links" id="navLinks">
      <li><a href="/cpt/index.php"   class="<?= $page=='index'  ?'active':'' ?>">ទំព័រដើម</a></li>
      <li><a href="/cpt/courses.php" class="<?= $page=='courses'?'active':'' ?>">មុខវិជ្ជា</a></li>
      <li><a href="/cpt/teachers.php"class="<?= $page=='teachers'?'active':'' ?>">គ្រូបង្រៀន</a></li>
      <li><a href="/cpt/news.php"    class="<?= $page=='news'   ?'active':'' ?>">ព័ត៌មាន</a></li>
      <li><a href="/cpt/about.php"   class="<?= $page=='about'  ?'active':'' ?>">អំពីយើង</a></li>
      <li><a href="/cpt/contact.php" class="<?= $page=='contact'?'active':'' ?>">ទំនាក់ទំនង</a></li>
      <li><a href="/cpt/register.php" class="btn-nav <?= $page=='register'?'active':'' ?>">📝 ចុះឈ្មោះ</a></li>
    </ul>
    <button class="menu-toggle" id="menuToggle"><i class="fa fa-bars"></i></button>
  </nav>
</header>
