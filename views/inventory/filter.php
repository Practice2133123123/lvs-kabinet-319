<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <h3>Фильтр</h3>
        <select name="type">
            <option value=""></option>
            <option value="socket">розетка</option>
            <option value="switch">Коммутатор</option>
            <option value="cable_run'">кабель</option>
            <option value="patch_cord">патчкорд</option>
        </select>
        <select name="status">
            <option value=""></option>
            <option value="active">активна</option>
            <option value="defect">дефект</option>
            <option value="decommissioned'">списана</option>
        </select>
        <button>найти</button>
    </form>
</body>
</html>