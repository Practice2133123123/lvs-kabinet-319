<h1>Дашборд</h1>

<div style="display: flex; gap: 20px; margin-top: 30px;">
    <div style="flex: 1; background: #f8f9fa; padding: 30px; text-align: center; border-radius: 10px; border: 1px solid #ddd;">
        <div style="font-size: 36px; font-weight: bold; color: #2c3e66;"><?= number_format($totalPoints) ?></div>
        <div style="margin-top: 10px;">Всего точек</div>
    </div>
    <div style="flex: 1; background: #f8f9fa; padding: 30px; text-align: center; border-radius: 10px; border: 1px solid #ddd;">
        <div style="font-size: 36px; font-weight: bold; color: #dc3545;"><?= number_format($openDefects) ?></div>
        <div style="margin-top: 10px;">Открытых дефектов</div>
    </div>
    <div style="flex: 1; background: #f8f9fa; padding: 30px; text-align: center; border-radius: 10px; border: 1px solid #ddd;">
        <div style="font-size: 36px; font-weight: bold; color: #28a745;"><?= number_format($totalCable, 2) ?></div>
        <div style="margin-top: 10px;">Кабель (м)</div>
    </div>
</div>
<br><br><div class="card mb-3">
    <img src="/assets/src/plan.png" class="card-img-top" alt="...">
    <div class="card-body">

    </div>
</div>