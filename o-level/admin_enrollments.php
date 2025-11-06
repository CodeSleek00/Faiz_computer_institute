<?php
require 'db_connect.php';

// Fetch enrollments
$res = mysqli_query($conn, "SELECT * FROM olevel_enrollments ORDER BY created_at DESC");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin - Enrollments</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  padding: 20px;
  background: #f4f6ff;
  color: #333;
}
h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #222;
}
table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  border-radius: 8px;
  overflow: hidden;
}
th, td {
  padding: 12px 10px;
  border-bottom: 1px solid #e6e6e6;
  text-align: left;
  font-size: 14px;
}
th {
  background: #f0f2f5;
  text-transform: uppercase;
  font-weight: 600;
}
tr:hover {
  background: #fafafa;
}
.status {
  color: #fff;
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 13px;
  text-transform: uppercase;
}
.locked { background: #dc3545; }   /* red */
.unlocked { background: #28a745; } /* green */
.action-btn {
  padding: 6px 10px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-weight: 600;
}
.lock { background:#e04b4b; color:#fff; }
.unlock { background:#28a745; color:#fff; }
td:nth-child(1),
td:nth-child(2),
td:nth-child(3),
td:nth-child(4) {
  font-weight: 500;
}
.form-inline { display:inline-block; margin:0; padding:0; }
.note { font-size:13px; color:#666; margin-top:12px; }
</style>
</head>
<body>
<h2>O-Level Enrollments</h2>

<div class="note">Click <strong>Lock</strong> to disable portal access for a student. Click <strong>Unlock</strong> to enable access again.</div>

<table>
  <tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Plan</th>
    <th>Amount</th>
    <th>EMI Mode</th>
    <th>EMI Months</th>
    <th>Remaining</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Pass</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php if (mysqli_num_rows($res) > 0): ?>
    <?php while($r = mysqli_fetch_assoc($res)): ?>
      <?php $locked = (int)$r['is_locked']; ?>
      <tr>
        <td><?= htmlspecialchars($r['id']) ?></td>
        <td><?= htmlspecialchars($r['student_id']) ?></td>
        <td><?= htmlspecialchars($r['plan_name']) ?></td>
        <td>₹<?= htmlspecialchars($r['amount']) ?></td>
        <td><?= htmlspecialchars(ucfirst($r['emi_mode'] ?? 'no')) ?></td>
        <td><?= htmlspecialchars($r['emi_months'] ?? '-') ?></td>
        <td><?= $r['emi_mode'] == 'yes' ? '₹' . htmlspecialchars($r['emi_remaining']) : '-' ?></td>
        <td><?= htmlspecialchars($r['name']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td><?= htmlspecialchars($r['phone']) ?></td>
        <td style="max-width:200px;"><?= nl2br(htmlspecialchars($r['address'])) ?></td>
        <td><?= htmlspecialchars($r['password']) ?></td>

        <!-- Lock status -->
        <td>
          <?php if ($locked): ?>
            <span class="status locked">Locked</span>
          <?php else: ?>
            <span class="status unlocked">Active</span>
          <?php endif; ?>
        </td>

        <!-- Action (Lock/Unlock) -->
        <td>
          <?php if ($locked): ?>
            <form class="form-inline" method="post" action="lock_action.php">
              <input type="hidden" name="student_id" value="<?= htmlspecialchars($r['student_id']) ?>">
              <input type="hidden" name="action" value="unlock">
              <button class="action-btn unlock" type="submit">Unlock</button>
            </form>
          <?php else: ?>
            <form class="form-inline" method="post" action="lock_action.php" onsubmit="return confirm('Are you sure you want to lock this student?');">
              <input type="hidden" name="student_id" value="<?= htmlspecialchars($r['student_id']) ?>">
              <input type="hidden" name="action" value="lock">
              <button class="action-btn lock" type="submit">Lock</button>
            </form>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="14" style="text-align:center; padding:15px;">No enrollments found.</td></tr>
  <?php endif; ?>
</table>

</body>
</html>
