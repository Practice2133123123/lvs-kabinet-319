<div class="summary-card" style="margin-bottom: 20px;">
    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse; background: #f8f9fa;">
        <thead style="background: #e9ecef;">
        <tr>
            <th colspan="3">Сводка расхода материалов</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="text-align: center;"><strong> Кабель (м)</strong><br><?= number_format($total_cable, 2) ?></td>
            <td style="text-align: center;"><strong> Коннекторы (шт)</strong><br><?= number_format($total_connectors) ?></td>
            <td style="text-align: center;"><strong> Розетки (шт)</strong><br><?= number_format($total_sockets) ?></td>
        </tr>
        </tbody>
    </table>
</div>