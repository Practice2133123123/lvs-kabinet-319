<div class="stats-cards">
    <div class="stat-card">
        <span style="color: var(--accent);"><?= number_format($total_cable, 2) ?> м</span>
        <div>Кабель</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--warning);"><?= number_format($total_connectors) ?> шт</span>
        <div>Коннекторы</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--success);"><?= number_format($total_sockets) ?> шт</span>
        <div>Розетки</div>
    </div>
</div>
