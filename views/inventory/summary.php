<div class="stats-cards">
    <div class="stat-card">
        <span style="color: var(--success);"><?= $totalActive ?? 0 ?></span>
        <div>Активных</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--warning);"><?= $totalDefect ?? 0 ?></span>
        <div>Дефектных</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--danger);"><?= $totalDecommissioned ?? 0 ?></span>
        <div>Списано</div>
    </div>
</div>
