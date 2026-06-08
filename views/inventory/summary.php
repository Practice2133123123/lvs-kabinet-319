<div style="display: flex; gap: 20px; margin-bottom: 20px;">
    <div style="flex: 1; background: #d4edda; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Активных</strong><br>
        <span style="font-size: 24px;"><?= $totalActive ?? 0 ?></span>
    </div>
    <div style="flex: 1; background: #fff3cd; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Дефектных</strong><br>
        <span style="font-size: 24px;"><?= $totalDefect ?? 0 ?></span>
    </div>
    <div style="flex: 1; background: #f8d7da; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Списано</strong><br>
        <span style="font-size: 24px;"><?= $totalDecommissioned ?? 0 ?></span>
    </div>
</div>