<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
include '../views/layouts/header.php';

$totalPoints = $pdo->query("SELECT COUNT(*) FROM network_points")->fetchColumn();
$openDefects = $pdo->query("SELECT COUNT(*) FROM defects WHERE status = 'open'")->fetchColumn();
$totalCable = $pdo->query("SELECT SUM(quantity) FROM material_usage WHERE material_id IN (SELECT id FROM materials WHERE type = 'cable')")->fetchColumn() ?: 0;
?>

    <div class="dashboard">
        <div class="card"><h3>Всего точек</h3><p class="number"><?= htmlspecialchars($totalPoints) ?></p></div>
        <div class="card"><h3>Открытых дефектов</h3><p class="number"><?= htmlspecialchars($openDefects) ?></p></div>
        <div class="card"><h3>Кабель (м)</h3><p class="number"><?= htmlspecialchars($totalCable) ?></p></div>
    </div>

<?php include '../views/layouts/footer.php'; ?>