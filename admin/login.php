<?php
session_start();
if(isset($_SESSION['admin_id'])) { header("Location: index.php"); exit; }
include '../config/db_config.php';
$error = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);
    $stmt = $conn->prepare("SELECT id,password,name FROM admins WHERE username=?");
    $stmt->bind_param("s",$u);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if($row && password_verify($p,$row['password'])){
        $_SESSION['admin_id']   = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        header("Location: index.php"); exit;
    }
    $error = "Username ឬ Password មិនត្រឹមត្រូវ";
}
?><!DOCTYPE html>
<html lang="km">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login — CPT Dept</title>
<link rel="stylesheet" href="../css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;600;700&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
<style>
body{background:var(--navy);min-height:100vh;display:flex;align-items:center;justify-content:center;}
.login-box{background:#fff;border-radius:20px;padding:48px;width:100%;max-width:420px;box-shadow:0 24px 64px rgba(0,0,0,.35);}
.login-box h2{font-family:'Outfit',sans-serif;font-size:1.8rem;font-weight:800;text-align:center;color:var(--navy2);margin-bottom:4px;}
.login-box p{text-align:center;color:var(--g3);font-size:.87rem;margin-bottom:28px;}
.logo-wrap{display:flex;justify-content:center;margin-bottom:20px;}
.logo-big{width:60px;height:60px;background:linear-gradient(135deg,var(--blue),var(--cyan));border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;}
</style>
</head>
<body>
<div class="login-box">
  <div class="logo-wrap"><div class="logo-big">💻</div></div>
  <h2>Admin Panel</h2>
  <p>CPT Department</p>
  <?php if($error): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>
  <form method="POST">
    <div class="form-group"><label>Username</label>
      <input type="text" name="username" class="form-control" required placeholder="admin" value="<?= htmlspecialchars($_POST['username']??'') ?>"></div>
    <div class="form-group"><label>Password</label>
      <input type="password" name="password" class="form-control" required placeholder="••••••••"></div>
    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px;">🔑 ចូលប្រើ</button>
  </form>
  <p style="text-align:center;margin-top:18px;font-size:.8rem;color:var(--g2);">Default: admin / admin123</p>
</div>
</body></html>
