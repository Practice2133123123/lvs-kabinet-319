<div style="display: flex; gap: 20px; margin-bottom: 20px;">
    <div style="flex: 1; background: #d4edda; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Кабель</strong><br>
        <span style="font-size: 24px;"><?= number_format($total_cable, 2) ?> м</span>
    </div>
    <div style="flex: 1; background: #fff3cd; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Коннекторы</strong><br>
        <span style="font-size: 24px;"><?= number_format($total_connectors) ?> шт</span>
    </div>
    <div style="flex: 1; background: #f8d7da; padding: 15px; text-align: center; border-radius: 8px;">
        <strong>Розетки</strong><br>
        <span style="font-size: 24px;"><?= number_format($total_sockets) ?> шт</span>
    </div>
</div>