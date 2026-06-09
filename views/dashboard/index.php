<!--<h1>Дашборд</h1>-->
<!---->
<!--<div style="display: flex; gap: 20px; margin-top: 30px;">-->
<!--    <div style="flex: 1; background: #f8f9fa; padding: 30px; text-align: center; border-radius: 10px; border: 1px solid #ddd;">-->
<!--        <div style="font-size: 36px; font-weight: bold; color: #2c3e66;">--><?php //= number_format($totalPoints) ?><!--</div>-->
<!--        <div style="margin-top: 10px;">Всего точек</div>-->
<!--    </div>-->
<!--    <div style="flex: 1; background: #f8f9fa; padding: 30px; text-align: center; border-radius: 10px; border: 1px solid #ddd;">-->
<!--        <div style="font-size: 36px; font-weight: bold; color: #dc3545;">--><?php //= number_format($openDefects) ?><!--</div>-->
<!--        <div style="margin-top: 10px;">Открытых дефектов</div>-->
<!--    </div>-->
<!--    <div style="flex: 1; background: #f8f9fa; padding: 30px; text-align: center; border-radius: 10px; border: 1px solid #ddd;">-->
<!--        <div style="font-size: 36px; font-weight: bold; color: #28a745;">--><?php //= number_format($totalCable, 2) ?><!--</div>-->
<!--        <div style="margin-top: 10px;">Кабель (м)</div>-->
<!--    </div>-->
<!--</div>-->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дашборд</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.fontsource.org/fontsource/inter/inter.css" rel="stylesheet">
    <style>
        /* Стили для функционала масштабирования */
        .map-container {
            position: relative;
            overflow: hidden;
            cursor: grab;
            background: #f8fafc;
        }

        .map-container:active {
            cursor: grabbing;
        }

        .map-image {
            transform-origin: 0 0;
            transition: none;
            user-select: none;
        }

        .map-hint {
            position: absolute;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.75);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            pointer-events: none;
            transition: opacity 0.3s;
            z-index: 10;
        }

        .hidden-hint {
            opacity: 0;
        }

        .zoom-indicator {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #e2e8f0;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            z-index: 10;
        }

        .map-controls {
            position: absolute;
            bottom: 16px;
            right: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 10;
        }

        .map-control-btn {
            width: 40px;
            height: 40px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #475569;
        }

        .map-control-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .map-control-btn:active {
            background: #f1f5f9;
        }
    </style>
</head>
<body class="min-h-screen">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Дашборд</h1>
        <p class="text-slate-500 mt-2 text-sm">Обзор состояния объекта и инфраструктуры</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="stat-card bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
            <div class="text-4xl font-bold text-slate-800 tracking-tight"><?= number_format($totalPoints) ?></div>
            <div class="mt-2 text-sm font-medium text-slate-500 uppercase tracking-wide">Всего точек</div>
        </div>

        <div class="stat-card bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
            <div class="text-4xl font-bold text-red-500 tracking-tight"><?= number_format($openDefects) ?></div>
            <div class="mt-2 text-sm font-medium text-slate-500 uppercase tracking-wide">Открытых дефектов</div>
        </div>

        <div class="stat-card bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
            <div class="text-4xl font-bold text-emerald-500 tracking-tight"><?= number_format($totalCable, 2) ?></div>
            <div class="mt-2 text-sm font-medium text-slate-500 uppercase tracking-wide">Кабель (м)</div>
        </div>
    </div>


    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">План объекта</h2>
            </div>
        </div>

        <div class="relative w-full" style="height: 650px;">
            <div id="mapContainer" class="map-container w-full h-full">
                <img
                        id="mapImage"
                        src="/assets/src/plan.png"
                        alt="План объекта"
                        class="map-image block max-w-none"
                        draggable="false"
                >


                <div id="mapHint" class="map-hint">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                    </svg>
                </div>

                <div id="zoomIndicator" class="zoom-indicator">100%</div>

                <div class="map-controls">
                    <button id="btnZoomIn" class="map-control-btn" title="Приблизить">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </button>
                    <button id="btnZoomOut" class="map-control-btn" title="Отдалить">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                    </button>
                    <button id="btnReset" class="map-control-btn" title="Сбросить вид">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
</div>

<script>
    (function() {
        'use strict';

        const container = document.getElementById('mapContainer');
        const image = document.getElementById('mapImage');
        const zoomIndicator = document.getElementById('zoomIndicator');
        const hint = document.getElementById('mapHint');
        const btnZoomIn = document.getElementById('btnZoomIn');
        const btnZoomOut = document.getElementById('btnZoomOut');
        const btnReset = document.getElementById('btnReset');

        let imgScale = 1;
        let imgPanning = false;
        let imgPointX = 0;
        let imgPointY = 0;
        let imgStartX = 0;
        let imgStartY = 0;
        let imgContainerWidth = 0;
        let imgContainerHeight = 0;
        let imgNaturalWidth = 0;
        let imgNaturalHeight = 0;
        let hintHidden = false;

        const MIN_SCALE = 0.3;
        const MAX_SCALE = 6;
        const ZOOM_STEP = 0.25;

        function updateTransform() {
            image.style.transform = `translate(${imgPointX}px, ${imgPointY}px) scale(${imgScale})`;
            zoomIndicator.textContent = Math.round(imgScale * 100) + '%';
        }

        function centerImage() {
            imgContainerWidth = container.clientWidth;
            imgContainerHeight = container.clientHeight;

            const scaledWidth = imgNaturalWidth * imgScale;
            const scaledHeight = imgNaturalHeight * imgScale;

            imgPointX = (imgContainerWidth - scaledWidth) / 2;
            imgPointY = (imgContainerHeight - scaledHeight) / 2;

            updateTransform();
        }

        function clampPan() {
            const scaledWidth = imgNaturalWidth * imgScale;
            const scaledHeight = imgNaturalHeight * imgScale;

            const maxX = Math.max(0, imgContainerWidth - scaledWidth);
            const maxY = Math.max(0, imgContainerHeight - scaledHeight);
            const minX = Math.min(0, imgContainerWidth - scaledWidth);
            const minY = Math.min(0, imgContainerHeight - scaledHeight);

            imgPointX = Math.max(minX, Math.min(maxX, imgPointX));
            imgPointY = Math.max(minY, Math.min(maxY, imgPointY));
        }

        function zoomAtPoint(newScale, clientX, clientY) {
            const rect = container.getBoundingClientRect();
            const mouseX = clientX - rect.left;
            const mouseY = clientY - rect.top;

            const scaleRatio = newScale / imgScale;

            imgPointX = mouseX - (mouseX - imgPointX) * scaleRatio;
            imgPointY = mouseY - (mouseY - imgPointY) * scaleRatio;
            imgScale = newScale;

            clampPan();
            updateTransform();
        }

        function zoomIn() {
            const newScale = Math.min(MAX_SCALE, imgScale + ZOOM_STEP);
            const rect = container.getBoundingClientRect();
            zoomAtPoint(newScale, rect.left + rect.width / 2, rect.top + rect.height / 2);
        }

        function zoomOut() {
            const newScale = Math.max(MIN_SCALE, imgScale - ZOOM_STEP);
            const rect = container.getBoundingClientRect();
            zoomAtPoint(newScale, rect.left + rect.width / 2, rect.top + rect.height / 2);
        }

        function resetView() {
            imgScale = 1;
            centerImage();
        }

        function hideHint() {
            if (!hintHidden) {
                hint.classList.add('hidden-hint');
                hintHidden = true;
            }
        }

        container.addEventListener('mousedown', function(e) {
            if (e.target.closest('.map-controls') || e.target.closest('.map-hint') || e.target.closest('.zoom-indicator')) return;
            imgPanning = true;
            imgStartX = e.clientX - imgPointX;
            imgStartY = e.clientY - imgPointY;
            hideHint();
        });

        window.addEventListener('mousemove', function(e) {
            if (!imgPanning) return;
            e.preventDefault();
            imgPointX = e.clientX - imgStartX;
            imgPointY = e.clientY - imgStartY;
            clampPan();
            updateTransform();
        });

        window.addEventListener('mouseup', function() {
            imgPanning = false;
        });

        container.addEventListener('wheel', function(e) {
            e.preventDefault();
            hideHint();

            const delta = e.deltaY > 0 ? -ZOOM_STEP : ZOOM_STEP;
            const newScale = Math.max(MIN_SCALE, Math.min(MAX_SCALE, imgScale + delta));

            zoomAtPoint(newScale, e.clientX, e.clientY);
        }, { passive: false });

        let lastTouchDist = 0;
        let lastTouchX = 0;
        let lastTouchY = 0;
        let touchCount = 0;

        container.addEventListener('touchstart', function(e) {
            if (e.target.closest('.map-controls')) return;
            touchCount = e.touches.length;
            hideHint();

            if (touchCount === 1) {
                imgPanning = true;
                imgStartX = e.touches[0].clientX - imgPointX;
                imgStartY = e.touches[0].clientY - imgPointY;
            } else if (touchCount === 2) {
                imgPanning = false;
                const dx = e.touches[0].clientX - e.touches[1].clientX;
                const dy = e.touches[0].clientY - e.touches[1].clientY;
                lastTouchDist = Math.sqrt(dx * dx + dy * dy);
                lastTouchX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
                lastTouchY = (e.touches[0].clientY + e.touches[1].clientY) / 2;
            }
        }, { passive: true });

        container.addEventListener('touchmove', function(e) {
            if (e.touches.length === 1 && imgPanning) {
                e.preventDefault();
                imgPointX = e.touches[0].clientX - imgStartX;
                imgPointY = e.touches[0].clientY - imgStartY;
                clampPan();
                updateTransform();
            } else if (e.touches.length === 2) {
                e.preventDefault();
                const dx = e.touches[0].clientX - e.touches[1].clientX;
                const dy = e.touches[0].clientY - e.touches[1].clientY;
                const dist = Math.sqrt(dx * dx + dy * dy);
                const centerX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
                const centerY = (e.touches[0].clientY + e.touches[1].clientY) / 2;

                if (lastTouchDist > 0) {
                    const scaleChange = dist / lastTouchDist;
                    const newScale = Math.max(MIN_SCALE, Math.min(MAX_SCALE, imgScale * scaleChange));
                    zoomAtPoint(newScale, centerX, centerY);
                }

                lastTouchDist = dist;
                lastTouchX = centerX;
                lastTouchY = centerY;
            }
        }, { passive: false });

        container.addEventListener('touchend', function() {
            imgPanning = false;
            lastTouchDist = 0;
        });

        container.addEventListener('dblclick', function(e) {
            if (e.target.closest('.map-controls')) return;
            hideHint();
            const newScale = Math.min(MAX_SCALE, imgScale + 0.5);
            zoomAtPoint(newScale, e.clientX, e.clientY);
        });

        btnZoomIn.addEventListener('click', function(e) {
            e.stopPropagation();
            hideHint();
            zoomIn();
        });

        btnZoomOut.addEventListener('click', function(e) {
            e.stopPropagation();
            hideHint();
            zoomOut();
        });

        btnReset.addEventListener('click', function(e) {
            e.stopPropagation();
            resetView();
        });

        window.addEventListener('resize', function() {
            imgContainerWidth = container.clientWidth;
            imgContainerHeight = container.clientHeight;
            clampPan();
            updateTransform();
        });

        function init() {
            imgNaturalWidth = image.naturalWidth || image.width;
            imgNaturalHeight = image.naturalHeight || image.height;
            imgContainerWidth = container.clientWidth;
            imgContainerHeight = container.clientHeight;
            centerImage();
        }

        if (image.complete) {
            init();
        } else {
            image.addEventListener('load', init);
        }
    })();
</script>
</body>
</html>