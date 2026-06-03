<?php 
require_once '../config/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

$defects = $pdo->query("SELECT defects.id, network_points.label AS network_label,
 defects.category, defects.severity, defects.status
FROM network_points
JOIN defects ON defects.point_id=network_points.id")->fetchAll(PDO::FETCH_ASSOC);
?>
    <table>
        <thead>
            <tr> 
                <th>ID</th>
                <th>Точка</th>
                <th>Категория</th>
                <th>Критичность</th>
                <th>Статус</th>
            </tr>      
        </thead>
        <?php foreach($defects as $defect): ?>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['network_label']) ?></td>
                <td><?= htmlspecialchars($defect['category']) ?></td>
                <td><span class="badge bg-primary"><?= htmlspecialchars($defect['severity']) ?></span></td>
                <td><span class="badge bg-primary"><?= htmlspecialchars($defect['status']) ?></span></td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>

<?php include '../includes/footer.php'; ?>