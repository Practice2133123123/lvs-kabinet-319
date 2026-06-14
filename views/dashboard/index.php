<h1>Дашборд</h1>
<p style="color: var(--text-light); margin-bottom: 24px;">Обзор состояния объекта и инфраструктуры</p>

<div class="stats-cards">
    <div class="stat-card">
        <span style="color: var(--primary);"><?= number_format($totalPoints) ?></span>
        <div>Всего точек</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--danger);"><?= number_format($openDefects) ?></span>
        <div>Открытых дефектов</div>
    </div>
    <div class="stat-card">
        <span style="color: var(--success);"><?= number_format($totalCable, 2) ?></span>
        <div>Кабель (м)</div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div style="padding: 16px 20px; border-bottom: 1px solid var(--border);">
        <h2 style="margin: 0; font-size: 16px;">План объекта</h2>
    </div>
    <div class="map-container" id="mapContainer" style="position: relative; overflow: hidden; cursor: grab; background: #f8fafc; height: 550px;" oncontextmenu="return false;">
        <img id="mapImage" src="/assets/src/plan.png" alt="План объекта" style="transform-origin: 0 0; user-select: none; display: block; max-width: none;" draggable="false">

        <div id="mapHint" style="position: absolute; top: 16px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.75); color: white; padding: 8px 16px; border-radius: 6px; font-size: 13px; display: flex; align-items: center; gap: 8px; pointer-events: none; transition: opacity 0.3s; z-index: 10;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
            Перетаскивайте и скролльте для навигации
        </div>

        <div id="zoomIndicator" style="position: absolute; bottom: 16px; left: 16px; background: rgba(255,255,255,0.95); border: 1px solid var(--border); padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; color: var(--text); z-index: 10;">100%</div>

        <div style="position: absolute; bottom: 16px; right: 16px; display: flex; flex-direction: column; gap: 8px; z-index: 10;">
            <button id="btnZoomIn" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border); border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text);" title="Приблизить">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </button>
            <button id="btnZoomOut" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border); border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text);" title="Отдалить">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
            </button>
            <button id="btnReset" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border); border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text);" title="Сбросить вид">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    var container = document.getElementById('mapContainer');
    var image = document.getElementById('mapImage');
    var zoomIndicator = document.getElementById('zoomIndicator');
    var hint = document.getElementById('mapHint');

    var scale = 1, panning = false, pointX = 0, pointY = 0, startX = 0, startY = 0;
    var cw = 0, ch = 0, nw = 0, nh = 0, hintHidden = false;

    function update() {
        image.style.transform = 'translate(' + pointX + 'px,' + pointY + 'px) scale(' + scale + ')';
        zoomIndicator.textContent = Math.round(scale * 100) + '%';
    }
    function center() {
        cw = container.clientWidth; ch = container.clientHeight;
        pointX = (cw - nw * scale) / 2;
        pointY = (ch - nh * scale) / 2;
        update();
    }
    function clamp() {
        var sw = nw * scale, sh = nh * scale;
        pointX = Math.max(Math.min(0, cw - sw), Math.min(Math.max(0, cw - sw), pointX));
        pointY = Math.max(Math.min(0, ch - sh), Math.min(Math.max(0, ch - sh), pointY));
    }
    function zoomAt(ns, cx, cy) {
        var r = container.getBoundingClientRect();
        var mx = cx - r.left, my = cy - r.top;
        var ratio = ns / scale;
        pointX = mx - (mx - pointX) * ratio;
        pointY = my - (my - pointY) * ratio;
        scale = ns; clamp(); update();
    }
    function hide() { if (!hintHidden) { hint.style.opacity = '0'; hintHidden = true; } }

    container.addEventListener('mousedown', function(e) {
        if (e.target.closest('[id^=btn]')) return;
        panning = true; startX = e.clientX - pointX; startY = e.clientY - pointY; hide();
    });
    window.addEventListener('mousemove', function(e) {
        if (!panning) return; e.preventDefault();
        pointX = e.clientX - startX; pointY = e.clientY - startY; clamp(); update();
    });
    window.addEventListener('mouseup', function() { panning = false; });

    container.addEventListener('wheel', function(e) {
        e.preventDefault(); hide();
        var delta = e.deltaY > 0 ? -0.25 : 0.25;
        zoomAt(Math.max(0.3, Math.min(6, scale + delta)), e.clientX, e.clientY);
    }, { passive: false });

    container.addEventListener('dblclick', function(e) {
        if (e.target.closest('[id^=btn]')) return; hide();
        zoomAt(Math.min(6, scale + 0.5), e.clientX, e.clientY);
    });

    document.getElementById('btnZoomIn').addEventListener('click', function(e) { e.stopPropagation(); hide(); zoomAt(Math.min(6, scale + 0.25), container.clientWidth/2, container.clientHeight/2); });
    document.getElementById('btnZoomOut').addEventListener('click', function(e) { e.stopPropagation(); hide(); zoomAt(Math.max(0.3, scale - 0.25), container.clientWidth/2, container.clientHeight/2); });
    document.getElementById('btnReset').addEventListener('click', function(e) { e.stopPropagation(); scale = 1; center(); });

    window.addEventListener('resize', function() { cw = container.clientWidth; ch = container.clientHeight; clamp(); update(); });

    function init() {
        nw = image.naturalWidth || image.width || 800;
        nh = image.naturalHeight || image.height || 600;
        cw = container.clientWidth; ch = container.clientHeight;
        center();
    }
    if (image.complete) init(); else image.addEventListener('load', init);
})();
</script>

