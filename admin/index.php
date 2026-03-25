<?php
include '../config/db_config.php';
include 'inc/header.php';
$courses  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM courses"))[0];
$teachers = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM teachers"))[0];
$students = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM students"))[0];
$messages = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM messages WHERE is_read=0"))[0];
$recent_students = mysqli_query($conn,"SELECT s.*,c.course_name FROM students s LEFT JOIN courses c ON s.course_id=c.id ORDER BY s.created_at DESC LIMIT 8");
$recent_messages = mysqli_query($conn,"SELECT * FROM messages ORDER BY created_at DESC LIMIT 5");
?>
<div class="admin-header">
  <h1>📊 Dashboard</h1>
  <span style="font-size:.85rem;color:var(--g3);">📅 <?= date('d M Y') ?></span>
</div>

<div class="stats-row">
  <div class="stat-card"><div class="s-icon">📚</div><div class="s-num"><?= $courses ?></div><div class="s-lbl">មុខវិជ្ជា</div></div>
  <div class="stat-card"><div class="s-icon">👨‍🏫</div><div class="s-num"><?= $teachers ?></div><div class="s-lbl">គ្រូបង្រៀន</div></div>
  <div class="stat-card"><div class="s-icon">🎓</div><div class="s-num"><?= $students ?></div><div class="s-lbl">សិស្ស</div></div>
  <div class="stat-card"><div class="s-icon">✉️</div><div class="s-num"><?= $messages ?></div><div class="s-lbl">សារថ្មី</div></div>
</div>

<div style="display:grid;grid-template-columns:1.5fr 1fr;gap:20px;flex-wrap:wrap;">
  <div>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
      <h3 style="font-family:'Outfit',sans-serif;font-size:1rem;font-weight:700;">🎓 សិស្សថ្មីៗ</h3>
      <a href="students.php" class="btn btn-primary btn-sm">មើលទាំងអស់</a>
    </div>
    <table class="data-table">
      <thead><tr><th>ឈ្មោះ</th><th>មុខវិជ្ជា</th><th>ស្ថានភាព</th><th>កាលបរិច្ឆេទ</th></tr></thead>
      <tbody>
        <?php while($r=mysqli_fetch_assoc($recent_students)): ?>
        <tr>
          <td><?= htmlspecialchars($r['name']) ?></td>
          <td><?= htmlspecialchars($r['course_name']??'—') ?></td>
          <td>
            <?php $badges=['pending'=>'badge-amber','active'=>'badge-green','completed'=>'badge-blue'];
            $labels=['pending'=>'រង់ចាំ','active'=>'កំពុងរៀន','completed'=>'បញ្ចប់']; ?>
            <span class="badge <?= $badges[$r['status']] ?>"><?= $labels[$r['status']] ?></span>
          </td>
          <td style="font-size:.78rem;color:var(--g3);"><?= date('d/m/Y',strtotime($r['created_at'])) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <div>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
      <h3 style="font-family:'Outfit',sans-serif;font-size:1rem;font-weight:700;">✉️ សារថ្មីៗ</h3>
      <a href="messages.php" class="btn btn-primary btn-sm">មើលទាំងអស់</a>
    </div>
    <?php while($m=mysqli_fetch_assoc($recent_messages)): ?>
    <div style="background:#fff;border:1px solid #e8edf5;border-radius:10px;padding:14px;margin-bottom:10px;">
      <div style="font-weight:700;font-size:.88rem;color:var(--navy2);"><?= htmlspecialchars($m['name']) ?></div>
      <div style="font-size:.78rem;color:var(--g3);margin-bottom:4px;"><?= htmlspecialchars($m['email']) ?></div>
      <div style="font-size:.82rem;color:var(--g2);"><?= htmlspecialchars(substr($m['message'],0,60)) ?>...</div>
      <?php if(!$m['is_read']): ?><span class="badge badge-blue" style="margin-top:6px;">ថ្មី</span><?php endif; ?>
    </div>
    <?php endwhile; ?>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
