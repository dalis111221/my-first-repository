<?php
session_start();
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }
$admin_name = $_SESSION['admin_name'] ?? 'Admin';
$cur = basename($_SERVER['PHP_SELF'],'.php');
?><!DOCTYPE html>
<html lang="km">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin — CPT Department</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-wrap">
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo"><div class="logo-icon">💻</div><span class="logo-text" style="font-size:1rem;">CPT<span>.</span>Admin</span></div>
    <div style="font-size:.75rem;color:var(--g3);margin-top:6px;">👤 <?= htmlspecialchars($admin_name) ?></div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section">ទំព័រសំខាន់</div>
    <a href="index.php"    class="<?= $cur=='index'   ?'active':'' ?>"><i class="fa fa-home fa-fw"></i> Dashboard</a>
    <div class="nav-section">គ្រប់គ្រង</div>
    <a href="courses.php"  class="<?= $cur=='courses' ?'active':'' ?>"><i class="fa fa-book fa-fw"></i> មុខវិជ្ជា</a>
    <a href="teachers.php" class="<?= $cur=='teachers'?'active':'' ?>"><i class="fa fa-chalkboard-teacher fa-fw"></i> គ្រូបង្រៀន</a>
    <a href="students.php" class="<?= $cur=='students'?'active':'' ?>"><i class="fa fa-users fa-fw"></i> សិស្ស</a>
    <a href="messages.php" class="<?= $cur=='messages'?'active':'' ?>"><i class="fa fa-envelope fa-fw"></i> សារ</a>
    <a href="news.php"     class="<?= $cur=='news'    ?'active':'' ?>"><i class="fa fa-newspaper fa-fw"></i> ព័ត៌មាន</a>
    <div class="nav-section">ផ្សេងៗ</div>
    <a href="../index.php" target="_blank"><i class="fa fa-external-link-alt fa-fw"></i> មើល Website</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt fa-fw"></i> ចាកចេញ</a>
  </nav>
</aside>
<main class="admin-main">
