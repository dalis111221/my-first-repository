<?php
include '../config/db_config.php';
include 'inc/header.php';
if(isset($_GET['read'])){
    $id=(int)$_GET['read'];
    mysqli_query($conn,"UPDATE messages SET is_read=1 WHERE id=$id");
}
if(isset($_GET['del'])){
    $id=(int)$_GET['del'];
    mysqli_query($conn,"DELETE FROM messages WHERE id=$id");
    header("Location: messages.php"); exit;
}
$messages = mysqli_query($conn,"SELECT * FROM messages ORDER BY created_at DESC");
?>
<div class="admin-header"><h1>✉️ សារទំនាក់ទំនង</h1></div>
<table class="data-table">
  <thead><tr><th>ឈ្មោះ</th><th>អ៊ីមែល</th><th>ប្រធានបទ</th><th>សារ</th><th>ថ្ងៃ</th><th></th></tr></thead>
  <tbody>
    <?php while($r=mysqli_fetch_assoc($messages)): ?>
    <tr style="<?= !$r['is_read']?'background:#fffbeb':'' ?>">
      <td><strong><?= htmlspecialchars($r['name']) ?></strong><?php if(!$r['is_read']): ?> <span class="badge badge-blue">ថ្មី</span><?php endif; ?></td>
      <td style="font-size:.8rem"><?= htmlspecialchars($r['email']) ?></td>
      <td><?= htmlspecialchars($r['subject']??'—') ?></td>
      <td style="max-width:240px;font-size:.82rem;color:var(--g3);"><?= htmlspecialchars(substr($r['message'],0,80)) ?>...</td>
      <td style="font-size:.78rem;color:var(--g3);"><?= date('d/m/Y',strtotime($r['created_at'])) ?></td>
      <td style="display:flex;gap:6px;">
        <?php if(!$r['is_read']): ?><a href="?read=<?= $r['id'] ?>" class="btn btn-sm" style="background:#dbeafe;color:#1e40af;border:none;">✓ អាន</a><?php endif; ?>
        <a href="?del=<?= $r['id'] ?>" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;" onclick="return confirm('លុបមែនទេ?')">🗑</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php include 'inc/footer.php'; ?>
