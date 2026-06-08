<div style="display: flex; gap: 20px; margin-bottom: 20px;">
    <div style="flex: 1; background: #d4edda; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Открыто</strong><br>
        <span style="font-size: 24px;"><?= $totalOpen ?? 0 ?></span>
    </div>
    <div style="flex: 1; background: #fff3cd; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>В работе</strong><br>
        <span style="font-size: 24px;"><?= $totalInProgress ?? 0 ?></span>
    </div>
    <div style="flex: 1; background: #f8d7da; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Закрыто</strong><br>
        <span style="font-size: 24px;"><?= $totalClosed ?? 0 ?></span>
    </div>
</div>