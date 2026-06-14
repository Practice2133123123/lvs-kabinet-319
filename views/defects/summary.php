<div class="stats-cards">
    <div class="stat-card">
        <span style="color: var(--danger);"><?= $totalOpen ?? 0 ?></span>
        <div>Открыто</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--warning);"><?= $totalInProgress ?? 0 ?></span>
        <div>В работе</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--success);"><?= $totalClosed ?? 0 ?></span>
        <div>Закрыто</div>
    </div>
</div>
