@extends('template.master')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <!-- -------------------------------------------- -->
            <!-- Welcome Card -->
            <!-- -------------------------------------------- -->
            <div class="card text-bg-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex flex-column h-100">
                                <div class="hstack gap-3">
                                    <span
                                        class="d-flex align-items-center justify-content-center round-48 bg-white rounded flex-shrink-0">
                                        <iconify-icon icon="solar:course-up-outline" class="fs-7 text-muted"></iconify-icon>
                                    </span>
                                    <h5 class="text-white fs-6 mb-0 text-nowrap">Welcome Back
                                        <br>David
                                    </h5>
                                </div>
                                <div class="mt-4 mt-sm-auto">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="opacity-75">Budget</span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                                $98,450</h4>
                                        </div>
                                        <div class="col-6 border-start border-light" style="--bs-border-opacity: .15;">
                                            <span class="opacity-75">Expense</span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                                $2,440</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-md-end">
                            <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/backgrounds/welcome-bg.png"
                                alt="welcome" class="img-fluid mb-n7 mt-2" width="180">
                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <!-- -------------------------------------------- -->
                <!-- Customers -->
                <!-- -------------------------------------------- -->
                <div class="col-md-6">
                    <div class="card bg-secondary-subtle overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light">Customers</span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">36,358</h5>
                                <span class="fs-11 text-dark-light fw-semibold">-12%</span>
                            </div>
                        </div>
                        <div id="customers" style="min-height: 70px;">
                            <div id="apexchartscustomers"
                                class="apexcharts-canvas apexchartscustomers apexcharts-theme-light"
                                style="width: 211px; height: 70px;"><svg id="SvgjsSvg1392" width="211" height="70"
                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                    class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                    style="background: transparent;">
                                    <foreignObject x="0" y="0" width="211" height="70">
                                        <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                            style="max-height: 35px;"></div>
                                    </foreignObject>
                                    <rect id="SvgjsRect1396" width="0" height="0" x="0" y="0" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                        fill="#fefefe"></rect>
                                    <g id="SvgjsG1432" class="apexcharts-yaxis" rel="0"
                                        transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1394" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1393">
                                            <clipPath id="gridRectMask5vi81ck6">
                                                <rect id="SvgjsRect1398" width="217" height="72" x="-3" y="-1"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="forecastMask5vi81ck6"></clipPath>
                                            <clipPath id="nonForecastMask5vi81ck6"></clipPath>
                                            <clipPath id="gridRectMarkerMask5vi81ck6">
                                                <rect id="SvgjsRect1399" width="215" height="74" x="-2" y="-2"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <linearGradient id="SvgjsLinearGradient1404" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop1405" stop-opacity="0.2"
                                                    stop-color="var(--bs-secondary)" offset="1"></stop>
                                                <stop id="SvgjsStop1406" stop-opacity="0.1" stop-color=""
                                                    offset="1"></stop>
                                                <stop id="SvgjsStop1407" stop-opacity="0.1" stop-color=""
                                                    offset="1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <line id="SvgjsLine1397" x1="0" y1="0" x2="0"
                                            y2="70" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt"
                                            class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="70"
                                            fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                        <g id="SvgjsG1410" class="apexcharts-grid">
                                            <g id="SvgjsG1411" class="apexcharts-gridlines-horizontal"
                                                style="display: none;">
                                                <line id="SvgjsLine1414" x1="0" y1="0" x2="211"
                                                    y2="0" stroke="#e0e0e0" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1415" x1="0" y1="14" x2="211"
                                                    y2="14" stroke="#e0e0e0" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1416" x1="0" y1="28" x2="211"
                                                    y2="28" stroke="#e0e0e0" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1417" x1="0" y1="42" x2="211"
                                                    y2="42" stroke="#e0e0e0" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1418" x1="0" y1="56" x2="211"
                                                    y2="56" stroke="#e0e0e0" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1419" x1="0" y1="70" x2="211"
                                                    y2="70" stroke="#e0e0e0" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1412" class="apexcharts-gridlines-vertical"
                                                style="display: none;"></g>
                                            <line id="SvgjsLine1421" x1="0" y1="70" x2="211"
                                                y2="70" stroke="transparent" stroke-dasharray="0"
                                                stroke-linecap="butt"></line>
                                            <line id="SvgjsLine1420" x1="0" y1="1" x2="0"
                                                y2="70" stroke="transparent" stroke-dasharray="0"
                                                stroke-linecap="butt"></line>
                                        </g>
                                        <g id="SvgjsG1413" class="apexcharts-grid-borders" style="display: none;">
                                        </g>
                                        <g id="SvgjsG1400" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1401" class="apexcharts-series" seriesName="customers"
                                                data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1408"
                                                    d="M 0 70 L 0 42C4.51670927857853, 38.628522694899914, 28.71316412750243, 7.70355891269304, 42.2, 10.5S70.42943373357352, 60.658696254324475, 84.4, 59.5S113.62654190635382, 7.265991982160328, 126.60000000000001, 3.5S155.1100147189554, 32.729149360964165, 168.8, 35S204.9987056938928, 19.98868839708238, 211.00000000000003, 17.5 L 211.00000000000003 70 L 0 70M 0 42z"
                                                    fill="url(#SvgjsLinearGradient1404)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMask5vi81ck6)"
                                                    pathTo="M 0 70 L 0 42C4.51670927857853, 38.628522694899914, 28.71316412750243, 7.70355891269304, 42.2, 10.5S70.42943373357352, 60.658696254324475, 84.4, 59.5S113.62654190635382, 7.265991982160328, 126.60000000000001, 3.5S155.1100147189554, 32.729149360964165, 168.8, 35S204.9987056938928, 19.98868839708238, 211.00000000000003, 17.5 L 211.00000000000003 70 L 0 70M 0 42z"
                                                    pathFrom="M -1 168 L -1 168 L 42.2 168 L 84.4 168 L 126.60000000000001 168 L 168.8 168 L 211.00000000000003 168">
                                                </path>
                                                <path id="SvgjsPath1409"
                                                    d="M 0 42C4.51670927857853, 38.628522694899914, 28.71316412750243, 7.70355891269304, 42.2, 10.5S70.42943373357352, 60.658696254324475, 84.4, 59.5S113.62654190635382, 7.265991982160328, 126.60000000000001, 3.5S155.1100147189554, 32.729149360964165, 168.8, 35S204.9987056938928, 19.98868839708238, 211.00000000000003, 17.5"
                                                    fill="none" fill-opacity="1" stroke="var(--bs-secondary)"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMask5vi81ck6)"
                                                    pathTo="M 0 42C4.51670927857853, 38.628522694899914, 28.71316412750243, 7.70355891269304, 42.2, 10.5S70.42943373357352, 60.658696254324475, 84.4, 59.5S113.62654190635382, 7.265991982160328, 126.60000000000001, 3.5S155.1100147189554, 32.729149360964165, 168.8, 35S204.9987056938928, 19.98868839708238, 211.00000000000003, 17.5"
                                                    pathFrom="M -1 168 L -1 168 L 42.2 168 L 84.4 168 L 126.60000000000001 168 L 168.8 168 L 211.00000000000003 168"
                                                    fill-rule="evenodd"></path>
                                                <g id="SvgjsG1402"
                                                    class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                    data:realIndex="0">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle1436" r="0" cx="0" cy="0"
                                                            class="apexcharts-marker wx1vl2ipe no-pointer-events"
                                                            stroke="#ffffff" fill="var(--bs-secondary)" fill-opacity="1"
                                                            stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1403" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1422" x1="0" y1="0" x2="211"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1423" x1="0" y1="0" x2="211"
                                            y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                            class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1424" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1425" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG1433" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1434" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1435" class="apexcharts-point-annotations"></g>
                                    </g>
                                </svg>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: var(--bs-secondary);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: inherit; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------- -->
                <!-- Projects -->
                <!-- -------------------------------------------- -->
                <div class="col-md-6">
                    <div class="card bg-danger-subtle overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light">Projects</span>
                            <div class="hstack gap-6 mb-4">
                                <h5 class="mb-0 fs-7">78,298</h5>
                                <span class="fs-11 text-dark-light fw-semibold">+31.8%</span>
                            </div>
                            <div class="mx-n1">
                                <div id="projects" style="min-height: 46px;">
                                    <div id="apexchartsyc8f481r"
                                        class="apexcharts-canvas apexchartsyc8f481r apexcharts-theme-light"
                                        style="width: 171px; height: 46px;"><svg id="SvgjsSvg1437" width="171"
                                            height="46" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                            class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                            transform="translate(-10, 0)" style="background: transparent;">
                                            <foreignObject x="0" y="0" width="171" height="46">
                                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                                    style="max-height: 23px;"></div>
                                            </foreignObject>
                                            <g id="SvgjsG1492" class="apexcharts-yaxis" rel="0"
                                                transform="translate(-18, 0)"></g>
                                            <g id="SvgjsG1439" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(16.8375, 0)">
                                                <defs id="SvgjsDefs1438">
                                                    <linearGradient id="SvgjsLinearGradient1441" x1="0"
                                                        y1="0" x2="0" y2="1">
                                                        <stop id="SvgjsStop1442" stop-opacity="0.4"
                                                            stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                        <stop id="SvgjsStop1443" stop-opacity="0.5"
                                                            stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                        <stop id="SvgjsStop1444" stop-opacity="0.5"
                                                            stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                    </linearGradient>
                                                    <clipPath id="gridRectMaskyc8f481r">
                                                        <rect id="SvgjsRect1446" width="175" height="46"
                                                            x="-14.837499999999999" y="0" rx="0" ry="0"
                                                            opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff">
                                                        </rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMaskyc8f481r"></clipPath>
                                                    <clipPath id="nonForecastMaskyc8f481r"></clipPath>
                                                    <clipPath id="gridRectMarkerMaskyc8f481r">
                                                        <rect id="SvgjsRect1447" width="149.325" height="50" x="-2"
                                                            y="-2" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <rect id="SvgjsRect1445" width="9.99109375" height="46" x="0" y="0"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke-dasharray="3" fill="url(#SvgjsLinearGradient1441)"
                                                    class="apexcharts-xcrosshairs" y2="46" filter="none"
                                                    fill-opacity="0.9"></rect>
                                                <g id="SvgjsG1471" class="apexcharts-grid">
                                                    <g id="SvgjsG1472" class="apexcharts-gridlines-horizontal"
                                                        style="display: none;">
                                                        <line id="SvgjsLine1475" x1="-12.837499999999999" y1="0"
                                                            x2="158.1625" y2="0" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1476" x1="-12.837499999999999" y1="11.5"
                                                            x2="158.1625" y2="11.5" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1477" x1="-12.837499999999999" y1="23"
                                                            x2="158.1625" y2="23" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1478" x1="-12.837499999999999" y1="34.5"
                                                            x2="158.1625" y2="34.5" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1479" x1="-12.837499999999999" y1="46"
                                                            x2="158.1625" y2="46" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                    </g>
                                                    <g id="SvgjsG1473" class="apexcharts-gridlines-vertical"
                                                        style="display: none;"></g>
                                                    <line id="SvgjsLine1481" x1="0" y1="46"
                                                        x2="145.325" y2="46" stroke="transparent"
                                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                                    <line id="SvgjsLine1480" x1="0" y1="1"
                                                        x2="0" y2="46" stroke="transparent"
                                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                                </g>
                                                <g id="SvgjsG1474" class="apexcharts-grid-borders"
                                                    style="display: none;"></g>
                                                <g id="SvgjsG1448" class="apexcharts-bar-series apexcharts-plot-series">
                                                    <g id="SvgjsG1449" class="apexcharts-series" rel="1"
                                                        seriesName="Project" data:realIndex="0">
                                                        <path id="SvgjsPath1454"
                                                            d="M -4.995546875 42.001 L -4.995546875 32.751000000000005 C -4.995546875 30.751000000000005 -2.9955468749999996 28.751 -0.9955468749999996 28.751 L 0.9955468749999996 28.751 C 2.9955468749999996 28.751 4.995546875 30.751000000000005 4.995546875 32.751000000000005 L 4.995546875 42.001 C 4.995546875 44.001 2.9955468749999996 46.001 0.9955468749999996 46.001 L -0.9955468749999996 46.001 C -2.9955468749999996 46.001 -4.995546875 44.001 -4.995546875 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M -4.995546875 42.001 L -4.995546875 32.751000000000005 C -4.995546875 30.751000000000005 -2.9955468749999996 28.751 -0.9955468749999996 28.751 L 0.9955468749999996 28.751 C 2.9955468749999996 28.751 4.995546875 30.751000000000005 4.995546875 32.751000000000005 L 4.995546875 42.001 C 4.995546875 44.001 2.9955468749999996 46.001 0.9955468749999996 46.001 L -0.9955468749999996 46.001 C -2.9955468749999996 46.001 -4.995546875 44.001 -4.995546875 42.001 Z "
                                                            pathFrom="M -4.995546875 46.001 L -4.995546875 46.001 L 4.995546875 46.001 L 4.995546875 46.001 L 4.995546875 46.001 L 4.995546875 46.001 L 4.995546875 46.001 L -4.995546875 46.001 Z"
                                                            cy="28.75" cx="4.995546875" j="0" val="3"
                                                            barHeight="17.25" barWidth="9.99109375"></path>
                                                        <path id="SvgjsPath1456"
                                                            d="M 13.170078125 42.001 L 13.170078125 21.251 C 13.170078125 19.251 15.170078125 17.251 17.170078125 17.251 L 19.161171875 17.251 C 21.161171875 17.251 23.161171875 19.251 23.161171875 21.251 L 23.161171875 42.001 C 23.161171875 44.001 21.161171875 46.001 19.161171875 46.001 L 17.170078125 46.001 C 15.170078125 46.001 13.170078125 44.001 13.170078125 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 13.170078125 42.001 L 13.170078125 21.251 C 13.170078125 19.251 15.170078125 17.251 17.170078125 17.251 L 19.161171875 17.251 C 21.161171875 17.251 23.161171875 19.251 23.161171875 21.251 L 23.161171875 42.001 C 23.161171875 44.001 21.161171875 46.001 19.161171875 46.001 L 17.170078125 46.001 C 15.170078125 46.001 13.170078125 44.001 13.170078125 42.001 Z "
                                                            pathFrom="M 13.170078125 46.001 L 13.170078125 46.001 L 23.161171875 46.001 L 23.161171875 46.001 L 23.161171875 46.001 L 23.161171875 46.001 L 23.161171875 46.001 L 13.170078125 46.001 Z"
                                                            cy="17.25" cx="23.161171875" j="1" val="5"
                                                            barHeight="28.75" barWidth="9.99109375"></path>
                                                        <path id="SvgjsPath1458"
                                                            d="M 31.335703125 42.001 L 31.335703125 21.251 C 31.335703125 19.251 33.335703124999995 17.251 35.335703124999995 17.251 L 37.326796875 17.251 C 39.326796875 17.251 41.326796875 19.251 41.326796875 21.251 L 41.326796875 42.001 C 41.326796875 44.001 39.326796875 46.001 37.326796875 46.001 L 35.335703124999995 46.001 C 33.335703124999995 46.001 31.335703125 44.001 31.335703125 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 31.335703125 42.001 L 31.335703125 21.251 C 31.335703125 19.251 33.335703124999995 17.251 35.335703124999995 17.251 L 37.326796875 17.251 C 39.326796875 17.251 41.326796875 19.251 41.326796875 21.251 L 41.326796875 42.001 C 41.326796875 44.001 39.326796875 46.001 37.326796875 46.001 L 35.335703124999995 46.001 C 33.335703124999995 46.001 31.335703125 44.001 31.335703125 42.001 Z "
                                                            pathFrom="M 31.335703125 46.001 L 31.335703125 46.001 L 41.326796875 46.001 L 41.326796875 46.001 L 41.326796875 46.001 L 41.326796875 46.001 L 41.326796875 46.001 L 31.335703125 46.001 Z"
                                                            cy="17.25" cx="41.326796875" j="2" val="5"
                                                            barHeight="28.75" barWidth="9.99109375"></path>
                                                        <path id="SvgjsPath1460"
                                                            d="M 49.50132812499999 42.001 L 49.50132812499999 9.751 C 49.50132812499999 7.7509999999999994 51.50132812499999 5.751 53.50132812499999 5.751 L 55.49242187499999 5.751 C 57.49242187499999 5.751 59.49242187499999 7.7509999999999994 59.49242187499999 9.751 L 59.49242187499999 42.001 C 59.49242187499999 44.001 57.49242187499999 46.001 55.49242187499999 46.001 L 53.50132812499999 46.001 C 51.50132812499999 46.001 49.50132812499999 44.001 49.50132812499999 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 49.50132812499999 42.001 L 49.50132812499999 9.751 C 49.50132812499999 7.7509999999999994 51.50132812499999 5.751 53.50132812499999 5.751 L 55.49242187499999 5.751 C 57.49242187499999 5.751 59.49242187499999 7.7509999999999994 59.49242187499999 9.751 L 59.49242187499999 42.001 C 59.49242187499999 44.001 57.49242187499999 46.001 55.49242187499999 46.001 L 53.50132812499999 46.001 C 51.50132812499999 46.001 49.50132812499999 44.001 49.50132812499999 42.001 Z "
                                                            pathFrom="M 49.50132812499999 46.001 L 49.50132812499999 46.001 L 59.49242187499999 46.001 L 59.49242187499999 46.001 L 59.49242187499999 46.001 L 59.49242187499999 46.001 L 59.49242187499999 46.001 L 49.50132812499999 46.001 Z"
                                                            cy="5.75" cx="59.49242187499999" j="3" val="7"
                                                            barHeight="40.25" barWidth="9.99109375">
                                                        </path>
                                                        <path id="SvgjsPath1462"
                                                            d="M 67.66695312499999 42.001 L 67.66695312499999 15.501 C 67.66695312499999 13.501 69.66695312499999 11.501 71.66695312499999 11.501 L 73.658046875 11.501 C 75.658046875 11.501 77.658046875 13.501 77.658046875 15.501 L 77.658046875 42.001 C 77.658046875 44.001 75.658046875 46.001 73.658046875 46.001 L 71.66695312499999 46.001 C 69.66695312499999 46.001 67.66695312499999 44.001 67.66695312499999 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 67.66695312499999 42.001 L 67.66695312499999 15.501 C 67.66695312499999 13.501 69.66695312499999 11.501 71.66695312499999 11.501 L 73.658046875 11.501 C 75.658046875 11.501 77.658046875 13.501 77.658046875 15.501 L 77.658046875 42.001 C 77.658046875 44.001 75.658046875 46.001 73.658046875 46.001 L 71.66695312499999 46.001 C 69.66695312499999 46.001 67.66695312499999 44.001 67.66695312499999 42.001 Z "
                                                            pathFrom="M 67.66695312499999 46.001 L 67.66695312499999 46.001 L 77.658046875 46.001 L 77.658046875 46.001 L 77.658046875 46.001 L 77.658046875 46.001 L 77.658046875 46.001 L 67.66695312499999 46.001 Z"
                                                            cy="11.5" cx="77.658046875" j="4" val="6"
                                                            barHeight="34.5" barWidth="9.99109375"></path>
                                                        <path id="SvgjsPath1464"
                                                            d="M 85.83257812499998 42.001 L 85.83257812499998 21.251 C 85.83257812499998 19.251 87.83257812499998 17.251 89.83257812499998 17.251 L 91.82367187499999 17.251 C 93.82367187499999 17.251 95.82367187499999 19.251 95.82367187499999 21.251 L 95.82367187499999 42.001 C 95.82367187499999 44.001 93.82367187499999 46.001 91.82367187499999 46.001 L 89.83257812499998 46.001 C 87.83257812499998 46.001 85.83257812499998 44.001 85.83257812499998 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 85.83257812499998 42.001 L 85.83257812499998 21.251 C 85.83257812499998 19.251 87.83257812499998 17.251 89.83257812499998 17.251 L 91.82367187499999 17.251 C 93.82367187499999 17.251 95.82367187499999 19.251 95.82367187499999 21.251 L 95.82367187499999 42.001 C 95.82367187499999 44.001 93.82367187499999 46.001 91.82367187499999 46.001 L 89.83257812499998 46.001 C 87.83257812499998 46.001 85.83257812499998 44.001 85.83257812499998 42.001 Z "
                                                            pathFrom="M 85.83257812499998 46.001 L 85.83257812499998 46.001 L 95.82367187499999 46.001 L 95.82367187499999 46.001 L 95.82367187499999 46.001 L 95.82367187499999 46.001 L 95.82367187499999 46.001 L 85.83257812499998 46.001 Z"
                                                            cy="17.25" cx="95.82367187499999" j="5" val="5"
                                                            barHeight="28.75" barWidth="9.99109375">
                                                        </path>
                                                        <path id="SvgjsPath1466"
                                                            d="M 103.99820312499999 42.001 L 103.99820312499999 32.751000000000005 C 103.99820312499999 30.751000000000005 105.99820312499999 28.751 107.99820312499999 28.751 L 109.989296875 28.751 C 111.989296875 28.751 113.989296875 30.751000000000005 113.989296875 32.751000000000005 L 113.989296875 42.001 C 113.989296875 44.001 111.989296875 46.001 109.989296875 46.001 L 107.99820312499999 46.001 C 105.99820312499999 46.001 103.99820312499999 44.001 103.99820312499999 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 103.99820312499999 42.001 L 103.99820312499999 32.751000000000005 C 103.99820312499999 30.751000000000005 105.99820312499999 28.751 107.99820312499999 28.751 L 109.989296875 28.751 C 111.989296875 28.751 113.989296875 30.751000000000005 113.989296875 32.751000000000005 L 113.989296875 42.001 C 113.989296875 44.001 111.989296875 46.001 109.989296875 46.001 L 107.99820312499999 46.001 C 105.99820312499999 46.001 103.99820312499999 44.001 103.99820312499999 42.001 Z "
                                                            pathFrom="M 103.99820312499999 46.001 L 103.99820312499999 46.001 L 113.989296875 46.001 L 113.989296875 46.001 L 113.989296875 46.001 L 113.989296875 46.001 L 113.989296875 46.001 L 103.99820312499999 46.001 Z"
                                                            cy="28.75" cx="113.989296875" j="6" val="3"
                                                            barHeight="17.25" barWidth="9.99109375"></path>
                                                        <path id="SvgjsPath1468"
                                                            d="M 122.16382812499998 42.001 L 122.16382812499998 21.251 C 122.16382812499998 19.251 124.16382812499998 17.251 126.16382812499998 17.251 L 128.15492187499999 17.251 C 130.15492187499999 17.251 132.15492187499999 19.251 132.15492187499999 21.251 L 132.15492187499999 42.001 C 132.15492187499999 44.001 130.15492187499999 46.001 128.15492187499999 46.001 L 126.16382812499998 46.001 C 124.16382812499998 46.001 122.16382812499998 44.001 122.16382812499998 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 122.16382812499998 42.001 L 122.16382812499998 21.251 C 122.16382812499998 19.251 124.16382812499998 17.251 126.16382812499998 17.251 L 128.15492187499999 17.251 C 130.15492187499999 17.251 132.15492187499999 19.251 132.15492187499999 21.251 L 132.15492187499999 42.001 C 132.15492187499999 44.001 130.15492187499999 46.001 128.15492187499999 46.001 L 126.16382812499998 46.001 C 124.16382812499998 46.001 122.16382812499998 44.001 122.16382812499998 42.001 Z "
                                                            pathFrom="M 122.16382812499998 46.001 L 122.16382812499998 46.001 L 132.15492187499999 46.001 L 132.15492187499999 46.001 L 132.15492187499999 46.001 L 132.15492187499999 46.001 L 132.15492187499999 46.001 L 122.16382812499998 46.001 Z"
                                                            cy="17.25" cx="132.15492187499999" j="7" val="5"
                                                            barHeight="28.75" barWidth="9.99109375">
                                                        </path>
                                                        <path id="SvgjsPath1470"
                                                            d="M 140.329453125 42.001 L 140.329453125 32.751000000000005 C 140.329453125 30.751000000000005 142.329453125 28.751 144.329453125 28.751 L 146.320546875 28.751 C 148.320546875 28.751 150.320546875 30.751000000000005 150.320546875 32.751000000000005 L 150.320546875 42.001 C 150.320546875 44.001 148.320546875 46.001 146.320546875 46.001 L 144.329453125 46.001 C 142.329453125 46.001 140.329453125 44.001 140.329453125 42.001 Z "
                                                            fill="var(--bs-white)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                            class="apexcharts-bar-area" index="0"
                                                            clip-path="url(#gridRectMaskyc8f481r)"
                                                            pathTo="M 140.329453125 42.001 L 140.329453125 32.751000000000005 C 140.329453125 30.751000000000005 142.329453125 28.751 144.329453125 28.751 L 146.320546875 28.751 C 148.320546875 28.751 150.320546875 30.751000000000005 150.320546875 32.751000000000005 L 150.320546875 42.001 C 150.320546875 44.001 148.320546875 46.001 146.320546875 46.001 L 144.329453125 46.001 C 142.329453125 46.001 140.329453125 44.001 140.329453125 42.001 Z "
                                                            pathFrom="M 140.329453125 46.001 L 140.329453125 46.001 L 150.320546875 46.001 L 150.320546875 46.001 L 150.320546875 46.001 L 150.320546875 46.001 L 150.320546875 46.001 L 140.329453125 46.001 Z"
                                                            cy="28.75" cx="150.320546875" j="8" val="3"
                                                            barHeight="17.25" barWidth="9.99109375"></path>
                                                        <g id="SvgjsG1451" class="apexcharts-bar-goals-markers">
                                                            <g id="SvgjsG1453" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1455" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1457" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1459" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1461" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1463" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1465" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1467" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                            <g id="SvgjsG1469" className="apexcharts-bar-goals-groups"
                                                                class="apexcharts-hidden-element-shown"
                                                                clip-path="url(#gridRectMarkerMaskyc8f481r)"></g>
                                                        </g>
                                                        <g id="SvgjsG1452"
                                                            class="apexcharts-bar-shadows apexcharts-hidden-element-shown">
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1450"
                                                        class="apexcharts-datalabels apexcharts-hidden-element-shown"
                                                        data:realIndex="0"></g>
                                                </g>
                                                <line id="SvgjsLine1482" x1="-12.837499999999999" y1="0"
                                                    x2="158.1625" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                                    stroke-width="1" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1483" x1="-12.837499999999999" y1="0"
                                                    x2="158.1625" y2="0" stroke-dasharray="0" stroke-width="0"
                                                    stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG1484" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                    <g id="SvgjsG1485" class="apexcharts-xaxis-texts-g"
                                                        transform="translate(0, -4)"></g>
                                                </g>
                                                <g id="SvgjsG1493" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG1494" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG1495" class="apexcharts-point-annotations"></g>
                                            </g>
                                        </svg>
                                        <div class="apexcharts-tooltip apexcharts-theme-dark">
                                            <div class="apexcharts-tooltip-title"
                                                style="font-family: inherit; font-size: 12px;"></div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-white);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                            <div class="apexcharts-yaxistooltip-text"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <!-- -------------------------------------------- -->
            <!-- Revenue Forecast -->
            <!-- -------------------------------------------- -->
            <div class="card">
                <div class="card-body pb-4">
                    <div class="d-md-flex align-items-center justify-content-between mb-4">
                        <div class="hstack align-items-center gap-3">
                            <span
                                class="d-flex align-items-center justify-content-center round-48 bg-primary-subtle rounded flex-shrink-0">
                                <iconify-icon icon="solar:layers-linear" class="fs-7 text-primary"></iconify-icon>
                            </span>
                            <div>
                                <h5 class="card-title">Revenue Forecast</h5>
                                <p class="card-subtitle mb-0">Overview of Profit</p>
                            </div>
                        </div>

                        <div class="hstack gap-9 mt-4 mt-md-0">
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-block flex-shrink-0 round-8 bg-primary rounded-circle"></span>
                                <span class="text-nowrap text-muted">2024</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-block flex-shrink-0 round-8 bg-danger rounded-circle"></span>
                                <span class="text-nowrap text-muted">2023</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-block flex-shrink-0 round-8 bg-secondary rounded-circle"></span>
                                <span class="text-nowrap text-muted">2022</span>
                            </div>
                        </div>
                    </div>
                    <div style="height: 285px;" class="me-n7">
                        <div id="revenue-forecast" style="min-height: 315px;">
                            <div id="apexcharts003dpwjof"
                                class="apexcharts-canvas apexcharts003dpwjof apexcharts-theme-light"
                                style="width: 614px; height: 300px;"><svg id="SvgjsSvg1499" width="614"
                                    height="300" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                    class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                    transform="translate(-10, 0)" style="background: transparent;">
                                    <foreignObject x="0" y="0" width="614" height="300">
                                        <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                            style="max-height: 150px;"></div>
                                    </foreignObject>
                                    <rect id="SvgjsRect1504" width="0" height="0" x="0" y="0" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsG1583" class="apexcharts-yaxis" rel="0"
                                        transform="translate(14.274999618530273, 0)">
                                        <g id="SvgjsG1584" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1586"
                                                font-family="inherit" x="20" y="31.4" text-anchor="end"
                                                dominant-baseline="auto" font-size="11px" font-weight="400"
                                                fill="#adb0bb" class="apexcharts-text apexcharts-yaxis-label "
                                                style="font-family: inherit;">
                                                <tspan id="SvgjsTspan1587">120</tspan>
                                                <title>120</title>
                                            </text><text id="SvgjsText1589" font-family="inherit" x="20"
                                                y="88.3543995370865" text-anchor="end" dominant-baseline="auto"
                                                font-size="11px" font-weight="400" fill="#adb0bb"
                                                class="apexcharts-text apexcharts-yaxis-label "
                                                style="font-family: inherit;">
                                                <tspan id="SvgjsTspan1590">90</tspan>
                                                <title>90</title>
                                            </text><text id="SvgjsText1592" font-family="inherit" x="20"
                                                y="145.30879907417298" text-anchor="end" dominant-baseline="auto"
                                                font-size="11px" font-weight="400" fill="#adb0bb"
                                                class="apexcharts-text apexcharts-yaxis-label "
                                                style="font-family: inherit;">
                                                <tspan id="SvgjsTspan1593">60</tspan>
                                                <title>60</title>
                                            </text><text id="SvgjsText1595" font-family="inherit" x="20"
                                                y="202.26319861125947" text-anchor="end" dominant-baseline="auto"
                                                font-size="11px" font-weight="400" fill="#adb0bb"
                                                class="apexcharts-text apexcharts-yaxis-label "
                                                style="font-family: inherit;">
                                                <tspan id="SvgjsTspan1596">30</tspan>
                                                <title>30</title>
                                            </text><text id="SvgjsText1598" font-family="inherit" x="20"
                                                y="259.2175981483459" text-anchor="end" dominant-baseline="auto"
                                                font-size="11px" font-weight="400" fill="#adb0bb"
                                                class="apexcharts-text apexcharts-yaxis-label "
                                                style="font-family: inherit;">
                                                <tspan id="SvgjsTspan1599">0</tspan>
                                                <title>0</title>
                                            </text></g>
                                    </g>
                                    <g id="SvgjsG1501" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(44.27499961853027, 30)">
                                        <defs id="SvgjsDefs1500">
                                            <clipPath id="gridRectMask003dpwjof">
                                                <rect id="SvgjsRect1506" width="553.760009765625"
                                                    height="229.81759814834595" x="-3" y="-1" rx="0"
                                                    ry="0" opacity="1" stroke-width="0" stroke="none"
                                                    stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="forecastMask003dpwjof"></clipPath>
                                            <clipPath id="nonForecastMask003dpwjof"></clipPath>
                                            <clipPath id="gridRectMarkerMask003dpwjof">
                                                <rect id="SvgjsRect1507" width="551.760009765625"
                                                    height="231.81759814834595" x="-2" y="-2" rx="0"
                                                    ry="0" opacity="1" stroke-width="0" stroke="none"
                                                    stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <linearGradient id="SvgjsLinearGradient1512" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop1513" stop-opacity="0.1" stop-color="var(--bs-danger)"
                                                    offset="0"></stop>
                                                <stop id="SvgjsStop1514" stop-opacity="0.01" stop-color=""
                                                    offset="1"></stop>
                                                <stop id="SvgjsStop1515" stop-opacity="0.01" stop-color=""
                                                    offset="1"></stop>
                                            </linearGradient>
                                            <linearGradient id="SvgjsLinearGradient1521" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop1522" stop-opacity="0.1"
                                                    stop-color="var(--bs-secondary)" offset="0"></stop>
                                                <stop id="SvgjsStop1523" stop-opacity="0.01" stop-color=""
                                                    offset="1"></stop>
                                                <stop id="SvgjsStop1524" stop-opacity="0.01" stop-color=""
                                                    offset="1"></stop>
                                            </linearGradient>
                                            <linearGradient id="SvgjsLinearGradient1530" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop1531" stop-opacity="0.1"
                                                    stop-color="var(--bs-primary)" offset="0"></stop>
                                                <stop id="SvgjsStop1532" stop-opacity="0.01" stop-color=""
                                                    offset="1"></stop>
                                                <stop id="SvgjsStop1533" stop-opacity="0.01" stop-color=""
                                                    offset="1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <line id="SvgjsLine1505" x1="0" y1="0" x2="0"
                                            y2="227.81759814834595" stroke="#b6b6b6" stroke-dasharray="3"
                                            stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0"
                                            width="1" height="227.81759814834595" fill="#b1b9c4" filter="none"
                                            fill-opacity="0.9" stroke-width="1"></line>
                                        <g id="SvgjsG1536" class="apexcharts-grid">
                                            <g id="SvgjsG1537" class="apexcharts-gridlines-horizontal">
                                                <line id="SvgjsLine1549" x1="0" y1="56.95439953708649"
                                                    x2="547.760009765625" y2="56.95439953708649"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1550" x1="0" y1="113.90879907417298"
                                                    x2="547.760009765625" y2="113.90879907417298"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1551" x1="0" y1="170.86319861125946"
                                                    x2="547.760009765625" y2="170.86319861125946"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1538" class="apexcharts-gridlines-vertical">
                                                <line id="SvgjsLine1540" x1="0" y1="0" x2="0"
                                                    y2="227.81759814834595" stroke="rgba(0,0,0,0.05)"
                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1541" x1="78.25142996651786" y1="0"
                                                    x2="78.25142996651786" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1542" x1="156.50285993303572" y1="0"
                                                    x2="156.50285993303572" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1543" x1="234.75428989955358" y1="0"
                                                    x2="234.75428989955358" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1544" x1="313.00571986607144" y1="0"
                                                    x2="313.00571986607144" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1545" x1="391.25714983258933" y1="0"
                                                    x2="391.25714983258933" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1546" x1="469.5085797991072" y1="0"
                                                    x2="469.5085797991072" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1547" x1="547.7600097656251" y1="0"
                                                    x2="547.7600097656251" y2="227.81759814834595"
                                                    stroke="rgba(0,0,0,0.05)" stroke-dasharray="0"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            </g>
                                            <line id="SvgjsLine1554" x1="0" y1="227.81759814834595"
                                                x2="547.760009765625" y2="227.81759814834595" stroke="transparent"
                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                            <line id="SvgjsLine1553" x1="0" y1="1" x2="0"
                                                y2="227.81759814834595" stroke="transparent" stroke-dasharray="0"
                                                stroke-linecap="butt"></line>
                                        </g>
                                        <g id="SvgjsG1539" class="apexcharts-grid-borders">
                                            <line id="SvgjsLine1548" x1="0" y1="0"
                                                x2="547.760009765625" y2="0" stroke="rgba(0,0,0,0.05)"
                                                stroke-dasharray="0" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1552" x1="0" y1="227.81759814834595"
                                                x2="547.760009765625" y2="227.81759814834595"
                                                stroke="rgba(0,0,0,0.05)" stroke-dasharray="0" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                        </g>
                                        <g id="SvgjsG1508" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1509" class="apexcharts-series" seriesName="2023"
                                                data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1516"
                                                    d="M 0 227.81759814834595 L 0 132.89359891986845C12.316919080394891, 129.90535648702118, 53.61759180572807, 107.93231420847843, 78.25142996651785, 113.90879907417296S130.51465564071714, 169.28693074928614, 156.5028599330357, 170.86319861125946S214.65865243097315, 134.37098222488981, 234.75428989955356, 123.40119899702071S287.0175155737528, 87.00786716760305, 313.0057198660714, 85.43159930562973S367.37022682926647, 121.15289116842705, 391.2571498325893, 113.90879907417296S452.45753859703996, 50.380003099499746, 469.5085797991071, 37.96959969139098S537.2035572791858, 5.122261347080652, 547.760009765625, -2.842170943040401e-14 L 547.760009765625 227.81759814834595 L 0 227.81759814834595M 0 132.89359891986845z"
                                                    fill="url(#SvgjsLinearGradient1512)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMask003dpwjof)"
                                                    pathTo="M 0 227.81759814834595 L 0 132.89359891986845C12.316919080394891, 129.90535648702118, 53.61759180572807, 107.93231420847843, 78.25142996651785, 113.90879907417296S130.51465564071714, 169.28693074928614, 156.5028599330357, 170.86319861125946S214.65865243097315, 134.37098222488981, 234.75428989955356, 123.40119899702071S287.0175155737528, 87.00786716760305, 313.0057198660714, 85.43159930562973S367.37022682926647, 121.15289116842705, 391.2571498325893, 113.90879907417296S452.45753859703996, 50.380003099499746, 469.5085797991071, 37.96959969139098S537.2035572791858, 5.122261347080652, 547.760009765625, -2.842170943040401e-14 L 547.760009765625 227.81759814834595 L 0 227.81759814834595M 0 132.89359891986845z"
                                                    pathFrom="M -1 227.81759814834595 L -1 227.81759814834595 L 78.25142996651785 227.81759814834595 L 156.5028599330357 227.81759814834595 L 234.75428989955356 227.81759814834595 L 313.0057198660714 227.81759814834595 L 391.2571498325893 227.81759814834595 L 469.5085797991071 227.81759814834595 L 547.760009765625 227.81759814834595">
                                                </path>
                                                <path id="SvgjsPath1517"
                                                    d="M 0 132.89359891986845C12.316919080394891, 129.90535648702118, 53.61759180572807, 107.93231420847843, 78.25142996651785, 113.90879907417296S130.51465564071714, 169.28693074928614, 156.5028599330357, 170.86319861125946S214.65865243097315, 134.37098222488981, 234.75428989955356, 123.40119899702071S287.0175155737528, 87.00786716760305, 313.0057198660714, 85.43159930562973S367.37022682926647, 121.15289116842705, 391.2571498325893, 113.90879907417296S452.45753859703996, 50.380003099499746, 469.5085797991071, 37.96959969139098S537.2035572791858, 5.122261347080652, 547.760009765625, -2.842170943040401e-14"
                                                    fill="none" fill-opacity="1" stroke="var(--bs-danger)"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMask003dpwjof)"
                                                    pathTo="M 0 132.89359891986845C12.316919080394891, 129.90535648702118, 53.61759180572807, 107.93231420847843, 78.25142996651785, 113.90879907417296S130.51465564071714, 169.28693074928614, 156.5028599330357, 170.86319861125946S214.65865243097315, 134.37098222488981, 234.75428989955356, 123.40119899702071S287.0175155737528, 87.00786716760305, 313.0057198660714, 85.43159930562973S367.37022682926647, 121.15289116842705, 391.2571498325893, 113.90879907417296S452.45753859703996, 50.380003099499746, 469.5085797991071, 37.96959969139098S537.2035572791858, 5.122261347080652, 547.760009765625, -2.842170943040401e-14"
                                                    pathFrom="M -1 227.81759814834595 L -1 227.81759814834595 L 78.25142996651785 227.81759814834595 L 156.5028599330357 227.81759814834595 L 234.75428989955356 227.81759814834595 L 313.0057198660714 227.81759814834595 L 391.2571498325893 227.81759814834595 L 469.5085797991071 227.81759814834595 L 547.760009765625 227.81759814834595"
                                                    fill-rule="evenodd"></path>
                                                <g id="SvgjsG1510"
                                                    class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                    data:realIndex="0">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle1603" r="0" cx="0"
                                                            cy="0"
                                                            class="apexcharts-marker whan3xuyd no-pointer-events"
                                                            stroke="var(--bs-danger)" fill="var(--bs-danger)"
                                                            fill-opacity="1" stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1518" class="apexcharts-series" seriesName="2022"
                                                data:longestSeries="true" rel="2" data:realIndex="1">
                                                <path id="SvgjsPath1525"
                                                    d="M 0 227.81759814834595 L 0 161.3707986884117C12.316919080394895, 158.38255625556442, 52.26322567419929, 143.96226670468954, 78.25142996651785, 142.38599884271622S130.51465564071714, 153.45466662753728, 156.5028599330357, 151.87839876556396S208.766085607235, 131.31733105789513, 234.75428989955356, 132.89359891986845S287.0175155737528, 162.94706655038502, 313.0057198660714, 161.3707986884117S365.2689455402707, 124.97746685899403, 391.2571498325893, 123.40119899702071S443.80303321894337, 148.7601512334906, 469.5085797991071, 151.87839876556396S534.9072364755432, 143.94512260875288, 547.760009765625, 142.38599884271622 L 547.760009765625 227.81759814834595 L 0 227.81759814834595M 0 161.3707986884117z"
                                                    fill="url(#SvgjsLinearGradient1521)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="1"
                                                    clip-path="url(#gridRectMask003dpwjof)"
                                                    pathTo="M 0 227.81759814834595 L 0 161.3707986884117C12.316919080394895, 158.38255625556442, 52.26322567419929, 143.96226670468954, 78.25142996651785, 142.38599884271622S130.51465564071714, 153.45466662753728, 156.5028599330357, 151.87839876556396S208.766085607235, 131.31733105789513, 234.75428989955356, 132.89359891986845S287.0175155737528, 162.94706655038502, 313.0057198660714, 161.3707986884117S365.2689455402707, 124.97746685899403, 391.2571498325893, 123.40119899702071S443.80303321894337, 148.7601512334906, 469.5085797991071, 151.87839876556396S534.9072364755432, 143.94512260875288, 547.760009765625, 142.38599884271622 L 547.760009765625 227.81759814834595 L 0 227.81759814834595M 0 161.3707986884117z"
                                                    pathFrom="M -1 227.81759814834595 L -1 227.81759814834595 L 78.25142996651785 227.81759814834595 L 156.5028599330357 227.81759814834595 L 234.75428989955356 227.81759814834595 L 313.0057198660714 227.81759814834595 L 391.2571498325893 227.81759814834595 L 469.5085797991071 227.81759814834595 L 547.760009765625 227.81759814834595">
                                                </path>
                                                <path id="SvgjsPath1526"
                                                    d="M 0 161.3707986884117C12.316919080394895, 158.38255625556442, 52.26322567419929, 143.96226670468954, 78.25142996651785, 142.38599884271622S130.51465564071714, 153.45466662753728, 156.5028599330357, 151.87839876556396S208.766085607235, 131.31733105789513, 234.75428989955356, 132.89359891986845S287.0175155737528, 162.94706655038502, 313.0057198660714, 161.3707986884117S365.2689455402707, 124.97746685899403, 391.2571498325893, 123.40119899702071S443.80303321894337, 148.7601512334906, 469.5085797991071, 151.87839876556396S534.9072364755432, 143.94512260875288, 547.760009765625, 142.38599884271622"
                                                    fill="none" fill-opacity="1" stroke="var(--bs-secondary)"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                    stroke-dasharray="0" class="apexcharts-area" index="1"
                                                    clip-path="url(#gridRectMask003dpwjof)"
                                                    pathTo="M 0 161.3707986884117C12.316919080394895, 158.38255625556442, 52.26322567419929, 143.96226670468954, 78.25142996651785, 142.38599884271622S130.51465564071714, 153.45466662753728, 156.5028599330357, 151.87839876556396S208.766085607235, 131.31733105789513, 234.75428989955356, 132.89359891986845S287.0175155737528, 162.94706655038502, 313.0057198660714, 161.3707986884117S365.2689455402707, 124.97746685899403, 391.2571498325893, 123.40119899702071S443.80303321894337, 148.7601512334906, 469.5085797991071, 151.87839876556396S534.9072364755432, 143.94512260875288, 547.760009765625, 142.38599884271622"
                                                    pathFrom="M -1 227.81759814834595 L -1 227.81759814834595 L 78.25142996651785 227.81759814834595 L 156.5028599330357 227.81759814834595 L 234.75428989955356 227.81759814834595 L 313.0057198660714 227.81759814834595 L 391.2571498325893 227.81759814834595 L 469.5085797991071 227.81759814834595 L 547.760009765625 227.81759814834595"
                                                    fill-rule="evenodd"></path>
                                                <g id="SvgjsG1519"
                                                    class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                    data:realIndex="1">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle1604" r="0" cx="0"
                                                            cy="0"
                                                            class="apexcharts-marker w862aog6u no-pointer-events"
                                                            stroke="var(--bs-secondary)" fill="var(--bs-secondary)"
                                                            fill-opacity="1" stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1527" class="apexcharts-series" seriesName="2024"
                                                data:longestSeries="true" rel="3" data:realIndex="2">
                                                <path id="SvgjsPath1534"
                                                    d="M 0 227.81759814834595 L 0 37.96959969139098C9.534384839437413, 43.75250959814932, 52.99110473060166, 80.87073396167847, 78.25142996651785, 85.43159930562973S132.78679705335142, 68.4456261814373, 156.5028599330357, 75.93919938278196S217.70324869748637, 139.4679953574552, 234.75428989955356, 151.87839876556396S286.9219098772321, 189.84799845695494, 313.0057198660714, 189.84799845695494S366.6233116717995, 145.9019138998694, 391.2571498325893, 151.87839876556396S444.260709149803, 223.22350538532416, 469.5085797991071, 227.81759814834595S538.2256249261876, 186.13850844086554, 547.760009765625, 180.3555985341072 L 547.760009765625 227.81759814834595 L 0 227.81759814834595M 0 37.96959969139098z"
                                                    fill="url(#SvgjsLinearGradient1530)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="2"
                                                    clip-path="url(#gridRectMask003dpwjof)"
                                                    pathTo="M 0 227.81759814834595 L 0 37.96959969139098C9.534384839437413, 43.75250959814932, 52.99110473060166, 80.87073396167847, 78.25142996651785, 85.43159930562973S132.78679705335142, 68.4456261814373, 156.5028599330357, 75.93919938278196S217.70324869748637, 139.4679953574552, 234.75428989955356, 151.87839876556396S286.9219098772321, 189.84799845695494, 313.0057198660714, 189.84799845695494S366.6233116717995, 145.9019138998694, 391.2571498325893, 151.87839876556396S444.260709149803, 223.22350538532416, 469.5085797991071, 227.81759814834595S538.2256249261876, 186.13850844086554, 547.760009765625, 180.3555985341072 L 547.760009765625 227.81759814834595 L 0 227.81759814834595M 0 37.96959969139098z"
                                                    pathFrom="M -1 227.81759814834595 L -1 227.81759814834595 L 78.25142996651785 227.81759814834595 L 156.5028599330357 227.81759814834595 L 234.75428989955356 227.81759814834595 L 313.0057198660714 227.81759814834595 L 391.2571498325893 227.81759814834595 L 469.5085797991071 227.81759814834595 L 547.760009765625 227.81759814834595">
                                                </path>
                                                <path id="SvgjsPath1535"
                                                    d="M 0 37.96959969139098C9.534384839437413, 43.75250959814932, 52.99110473060166, 80.87073396167847, 78.25142996651785, 85.43159930562973S132.78679705335142, 68.4456261814373, 156.5028599330357, 75.93919938278196S217.70324869748637, 139.4679953574552, 234.75428989955356, 151.87839876556396S286.9219098772321, 189.84799845695494, 313.0057198660714, 189.84799845695494S366.6233116717995, 145.9019138998694, 391.2571498325893, 151.87839876556396S444.260709149803, 223.22350538532416, 469.5085797991071, 227.81759814834595S538.2256249261876, 186.13850844086554, 547.760009765625, 180.3555985341072"
                                                    fill="none" fill-opacity="1" stroke="var(--bs-primary)"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                    stroke-dasharray="0" class="apexcharts-area" index="2"
                                                    clip-path="url(#gridRectMask003dpwjof)"
                                                    pathTo="M 0 37.96959969139098C9.534384839437413, 43.75250959814932, 52.99110473060166, 80.87073396167847, 78.25142996651785, 85.43159930562973S132.78679705335142, 68.4456261814373, 156.5028599330357, 75.93919938278196S217.70324869748637, 139.4679953574552, 234.75428989955356, 151.87839876556396S286.9219098772321, 189.84799845695494, 313.0057198660714, 189.84799845695494S366.6233116717995, 145.9019138998694, 391.2571498325893, 151.87839876556396S444.260709149803, 223.22350538532416, 469.5085797991071, 227.81759814834595S538.2256249261876, 186.13850844086554, 547.760009765625, 180.3555985341072"
                                                    pathFrom="M -1 227.81759814834595 L -1 227.81759814834595 L 78.25142996651785 227.81759814834595 L 156.5028599330357 227.81759814834595 L 234.75428989955356 227.81759814834595 L 313.0057198660714 227.81759814834595 L 391.2571498325893 227.81759814834595 L 469.5085797991071 227.81759814834595 L 547.760009765625 227.81759814834595"
                                                    fill-rule="evenodd"></path>
                                                <g id="SvgjsG1528"
                                                    class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                    data:realIndex="2">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle1605" r="0" cx="0"
                                                            cy="0"
                                                            class="apexcharts-marker w7fv5k5cr no-pointer-events"
                                                            stroke="var(--bs-primary)" fill="var(--bs-primary)"
                                                            fill-opacity="1" stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1511" class="apexcharts-datalabels" data:realIndex="0">
                                            </g>
                                            <g id="SvgjsG1520" class="apexcharts-datalabels" data:realIndex="1">
                                            </g>
                                            <g id="SvgjsG1529" class="apexcharts-datalabels" data:realIndex="2">
                                            </g>
                                        </g>
                                        <line id="SvgjsLine1555" x1="0" y1="0" x2="547.760009765625"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1556" x1="0" y1="0" x2="547.760009765625"
                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                            stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1557" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1558" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, -4)"><text id="SvgjsText1560"
                                                    font-family="inherit" x="0" y="256.81759814834595"
                                                    text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                    font-weight="400" fill="#adb0bb"
                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1561">Jan</tspan>
                                                    <title>Jan</title>
                                                </text><text id="SvgjsText1563" font-family="inherit"
                                                    x="78.25142996651786" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1564">Feb</tspan>
                                                    <title>Feb</title>
                                                </text><text id="SvgjsText1566" font-family="inherit"
                                                    x="156.50285993303572" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1567">Mar</tspan>
                                                    <title>Mar</title>
                                                </text><text id="SvgjsText1569" font-family="inherit"
                                                    x="234.75428989955356" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1570">Apr</tspan>
                                                    <title>Apr</title>
                                                </text><text id="SvgjsText1572" font-family="inherit"
                                                    x="313.00571986607144" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1573">May</tspan>
                                                    <title>May</title>
                                                </text><text id="SvgjsText1575" font-family="inherit"
                                                    x="391.25714983258933" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1576">Jun</tspan>
                                                    <title>Jun</title>
                                                </text><text id="SvgjsText1578" font-family="inherit"
                                                    x="469.5085797991072" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1579">July</tspan>
                                                    <title>July</title>
                                                </text><text id="SvgjsText1581" font-family="inherit"
                                                    x="547.7600097656251" y="256.81759814834595" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="12px" font-weight="400"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;">
                                                    <tspan id="SvgjsTspan1582">Aug</tspan>
                                                    <title>Aug</title>
                                                </text></g>
                                        </g>
                                        <g id="SvgjsG1600" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1601" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1602" class="apexcharts-point-annotations"></g>
                                        <rect id="SvgjsRect1606" width="0" height="0" x="0" y="0"
                                            rx="0" ry="0" opacity="1" stroke-width="0"
                                            stroke="none" stroke-dasharray="0" fill="#fefefe"
                                            class="apexcharts-zoom-rect"></rect>
                                        <rect id="SvgjsRect1607" width="0" height="0" x="0" y="0"
                                            rx="0" ry="0" opacity="1" stroke-width="0"
                                            stroke="none" stroke-dasharray="0" fill="#fefefe"
                                            class="apexcharts-selection-rect"></rect>
                                    </g>
                                </svg>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-title"
                                        style="font-family: inherit; font-size: 12px;"></div>
                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: var(--bs-danger);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: inherit; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                    <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: var(--bs-secondary);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: inherit; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                    <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: var(--bs-primary);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: inherit; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-dark">
                                    <div class="apexcharts-xaxistooltip-text"
                                        style="font-family: inherit; font-size: 12px;"></div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- -------------------------------------------- -->
            <!-- Your Performance -->
            <!-- -------------------------------------------- -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Your Performance</h5>
                    <p class="card-subtitle mb-0 lh-base">Last check on 25 february</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="vstack gap-9 mt-2">
                                <div class="hstack align-items-center gap-3">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded bg-primary-subtle flex-shrink-0">
                                        <iconify-icon icon="solar:shop-2-linear"
                                            class="fs-7 text-primary"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap">64 new orders</h6>
                                        <span>Processing</span>
                                    </div>

                                </div>
                                <div class="hstack align-items-center gap-3">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded bg-danger-subtle">
                                        <iconify-icon icon="solar:filters-outline"
                                            class="fs-7 text-danger"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">4 orders</h6>
                                        <span>On hold</span>
                                    </div>

                                </div>
                                <div class="hstack align-items-center gap-3">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded bg-secondary-subtle">
                                        <iconify-icon icon="solar:pills-3-linear"
                                            class="fs-7 text-secondary"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">12 orders</h6>
                                        <span>Delivered</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center mt-sm-n7">
                                <div id="your-preformance" style="min-height: 113.7px;">
                                    <div id="apexcharts1ttz4aua"
                                        class="apexcharts-canvas apexcharts1ttz4aua apexcharts-theme-light"
                                        style="width: 181px; height: 113.7px;"><svg id="SvgjsSvg1608" width="181"
                                            height="113.69999999999999" xmlns="http://www.w3.org/2000/svg"
                                            version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                            style="background: transparent;">
                                            <foreignObject x="0" y="0" width="181" height="113.69999999999999">
                                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml">
                                                </div>
                                            </foreignObject>
                                            <g id="SvgjsG1610" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(1, 10)">
                                                <defs id="SvgjsDefs1609">
                                                    <clipPath id="gridRectMask1ttz4aua">
                                                        <rect id="SvgjsRect1611" width="187" height="285" x="-3"
                                                            y="-1" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMask1ttz4aua"></clipPath>
                                                    <clipPath id="nonForecastMask1ttz4aua"></clipPath>
                                                    <clipPath id="gridRectMarkerMask1ttz4aua">
                                                        <rect id="SvgjsRect1612" width="185" height="287" x="-2"
                                                            y="-2" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <g id="SvgjsG1613" class="apexcharts-pie">
                                                    <g id="SvgjsG1614" transform="translate(0, 0) scale(1)">
                                                        <circle id="SvgjsCircle1615" r="74.06341463414634"
                                                            cx="90.5" cy="90.5" fill="transparent">
                                                        </circle>
                                                        <g id="SvgjsG1616" class="apexcharts-slices">
                                                            <g id="SvgjsG1617"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesName="245" rel="1" data:realIndex="0">
                                                                <path id="SvgjsPath1618"
                                                                    d="M 8.207317073170728 90.49999999999999 A 82.29268292682927 82.29268292682927 0 0 1 23.92382099948604 42.12957460402915 L 30.58143889953744 46.96661714362624 A 74.06341463414634 74.06341463414634 0 0 0 16.43658536585366 90.49999999999999 L 8.207317073170728 90.49999999999999 z"
                                                                    fill="var(--bs-danger)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-0"
                                                                    index="0" j="0" data:angle="36"
                                                                    data:startAngle="-90" data:strokeWidth="2"
                                                                    data:value="20"
                                                                    data:pathOrig="M 8.207317073170728 90.49999999999999 A 82.29268292682927 82.29268292682927 0 0 1 23.92382099948604 42.12957460402915 L 30.58143889953744 46.96661714362624 A 74.06341463414634 74.06341463414634 0 0 0 16.43658536585366 90.49999999999999 L 8.207317073170728 90.49999999999999 z"
                                                                    stroke="var(--bs-card-bg)"></path>
                                                            </g>
                                                            <g id="SvgjsG1619"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesName="45" rel="2" data:realIndex="1">
                                                                <path id="SvgjsPath1620"
                                                                    d="M 23.92382099948604 42.12957460402915 A 82.29268292682927 82.29268292682927 0 0 1 65.07016246290067 12.235007659028085 L 67.6131462166106 20.061506893125284 A 74.06341463414634 74.06341463414634 0 0 0 30.58143889953744 46.96661714362624 L 23.92382099948604 42.12957460402915 z"
                                                                    fill="var(--bs-warning)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-1"
                                                                    index="0" j="1" data:angle="36"
                                                                    data:startAngle="-54" data:strokeWidth="2"
                                                                    data:value="20"
                                                                    data:pathOrig="M 23.92382099948604 42.12957460402915 A 82.29268292682927 82.29268292682927 0 0 1 65.07016246290067 12.235007659028085 L 67.6131462166106 20.061506893125284 A 74.06341463414634 74.06341463414634 0 0 0 30.58143889953744 46.96661714362624 L 23.92382099948604 42.12957460402915 z"
                                                                    stroke="var(--bs-card-bg)"></path>
                                                            </g>
                                                            <g id="SvgjsG1621"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesName="14" rel="3" data:realIndex="2">
                                                                <path id="SvgjsPath1622"
                                                                    d="M 65.07016246290067 12.235007659028085 A 82.29268292682927 82.29268292682927 0 0 1 115.92983753709933 12.2350076590281 L 113.3868537833894 20.061506893125284 A 74.06341463414634 74.06341463414634 0 0 0 67.6131462166106 20.061506893125284 L 65.07016246290067 12.235007659028085 z"
                                                                    fill="var(--bs-warning-bg-subtle)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-2"
                                                                    index="0" j="2" data:angle="36"
                                                                    data:startAngle="-18" data:strokeWidth="2"
                                                                    data:value="20"
                                                                    data:pathOrig="M 65.07016246290067 12.235007659028085 A 82.29268292682927 82.29268292682927 0 0 1 115.92983753709933 12.2350076590281 L 113.3868537833894 20.061506893125284 A 74.06341463414634 74.06341463414634 0 0 0 67.6131462166106 20.061506893125284 L 65.07016246290067 12.235007659028085 z"
                                                                    stroke="var(--bs-card-bg)"></path>
                                                            </g>
                                                            <g id="SvgjsG1623"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesName="78" rel="4" data:realIndex="3">
                                                                <path id="SvgjsPath1624"
                                                                    d="M 115.92983753709933 12.2350076590281 A 82.29268292682927 82.29268292682927 0 0 1 157.07617900051397 42.12957460402916 L 150.41856110046257 46.966617143626245 A 74.06341463414634 74.06341463414634 0 0 0 113.3868537833894 20.061506893125284 L 115.92983753709933 12.2350076590281 z"
                                                                    fill="var(--bs-secondary-bg-subtle)"
                                                                    fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="butt" stroke-width="2"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-3"
                                                                    index="0" j="3" data:angle="36"
                                                                    data:startAngle="18" data:strokeWidth="2"
                                                                    data:value="20"
                                                                    data:pathOrig="M 115.92983753709933 12.2350076590281 A 82.29268292682927 82.29268292682927 0 0 1 157.07617900051397 42.12957460402916 L 150.41856110046257 46.966617143626245 A 74.06341463414634 74.06341463414634 0 0 0 113.3868537833894 20.061506893125284 L 115.92983753709933 12.2350076590281 z"
                                                                    stroke="var(--bs-card-bg)"></path>
                                                            </g>
                                                            <g id="SvgjsG1625"
                                                                class="apexcharts-series apexcharts-pie-series"
                                                                seriesName="95" rel="5" data:realIndex="4">
                                                                <path id="SvgjsPath1626"
                                                                    d="M 157.07617900051397 42.12957460402916 A 82.29268292682927 82.29268292682927 0 0 1 172.79268167344003 90.48563721739919 L 164.56341350609603 90.48707349565926 A 74.06341463414634 74.06341463414634 0 0 0 150.41856110046257 46.966617143626245 L 157.07617900051397 42.12957460402916 z"
                                                                    fill="var(--bs-secondary)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-pie-area apexcharts-donut-slice-4"
                                                                    index="0" j="4" data:angle="36"
                                                                    data:startAngle="54" data:strokeWidth="2"
                                                                    data:value="20"
                                                                    data:pathOrig="M 157.07617900051397 42.12957460402916 A 82.29268292682927 82.29268292682927 0 0 1 172.79268167344003 90.48563721739919 L 164.56341350609603 90.48707349565926 A 74.06341463414634 74.06341463414634 0 0 0 150.41856110046257 46.966617143626245 L 157.07617900051397 42.12957460402916 z"
                                                                    stroke="var(--bs-card-bg)"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1627" x1="0" y1="0"
                                                    x2="181" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1628" x1="0" y1="0"
                                                    x2="181" y2="0" stroke-dasharray="0"
                                                    stroke-width="0" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                            </g>
                                        </svg>
                                        <div class="apexcharts-tooltip apexcharts-theme-dark">
                                            <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-danger);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-warning);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-warning-bg-subtle);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 4;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-secondary-bg-subtle);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 5;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-secondary);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="fs-8">275</h2>
                                <p class="mb-0">
                                    Learn insigs how to manage all aspects of your
                                    startup.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-md-6">
                    <!-- -------------------------------------------- -->
                    <!-- Customers -->
                    <!-- -------------------------------------------- -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <h5 class="card-title fw-semibold">Customers</h5>
                                    <p class="card-subtitle mb-0">Last 7 days</p>
                                </div>
                                <span class="fs-11 text-success fw-semibold lh-lg">+26.5%</span>
                            </div>
                            <div class="py-4 my-1">
                                <div id="customers-area" style="min-height: 100px;">
                                    <div id="apexchartsruolqrw1"
                                        class="apexcharts-canvas apexchartsruolqrw1 apexcharts-theme-light"
                                        style="width: 247px; height: 100px;"><svg id="SvgjsSvg1631" width="247"
                                            height="100" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                            class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                            transform="translate(0, 0)" style="background: transparent;">
                                            <foreignObject x="0" y="0" width="247" height="100">
                                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                                    style="max-height: 50px;"></div>
                                            </foreignObject>
                                            <rect id="SvgjsRect1635" width="0" height="0" x="0" y="0"
                                                rx="0" ry="0" opacity="1" stroke-width="0"
                                                stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                            <g id="SvgjsG1670" class="apexcharts-yaxis" rel="0"
                                                transform="translate(-18, 0)"></g>
                                            <g id="SvgjsG1633" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(0, 0)">
                                                <defs id="SvgjsDefs1632">
                                                    <clipPath id="gridRectMaskruolqrw1">
                                                        <rect id="SvgjsRect1637" width="253" height="102" x="-3"
                                                            y="-1" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMaskruolqrw1"></clipPath>
                                                    <clipPath id="nonForecastMaskruolqrw1"></clipPath>
                                                    <clipPath id="gridRectMarkerMaskruolqrw1">
                                                        <rect id="SvgjsRect1638" width="251" height="104" x="-2"
                                                            y="-2" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <line id="SvgjsLine1636" x1="0" y1="0"
                                                    x2="0" y2="100" stroke="#b6b6b6"
                                                    stroke-dasharray="3" stroke-linecap="butt"
                                                    class="apexcharts-xcrosshairs" x="0" y="0" width="1"
                                                    height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                    stroke-width="1"></line>
                                                <g id="SvgjsG1648" class="apexcharts-grid">
                                                    <g id="SvgjsG1649" class="apexcharts-gridlines-horizontal"
                                                        style="display: none;">
                                                        <line id="SvgjsLine1652" x1="0" y1="0"
                                                            x2="247" y2="0" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1653" x1="0" y1="25"
                                                            x2="247" y2="25" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1654" x1="0" y1="50"
                                                            x2="247" y2="50" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1655" x1="0" y1="75"
                                                            x2="247" y2="75" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1656" x1="0" y1="100"
                                                            x2="247" y2="100" stroke="#e0e0e0"
                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                            class="apexcharts-gridline"></line>
                                                    </g>
                                                    <g id="SvgjsG1650" class="apexcharts-gridlines-vertical"
                                                        style="display: none;"></g>
                                                    <line id="SvgjsLine1658" x1="0" y1="100"
                                                        x2="247" y2="100" stroke="transparent"
                                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                                    <line id="SvgjsLine1657" x1="0" y1="1"
                                                        x2="0" y2="100" stroke="transparent"
                                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                                </g>
                                                <g id="SvgjsG1651" class="apexcharts-grid-borders"
                                                    style="display: none;"></g>
                                                <g id="SvgjsG1639"
                                                    class="apexcharts-line-series apexcharts-plot-series">
                                                    <g id="SvgjsG1640" class="apexcharts-series"
                                                        seriesName="Aprilx07x" data:longestSeries="true"
                                                        rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath1643"
                                                            d="M 0 100C2.0759868265162513, 96.84819813788019, 30.803537736948932, 43.400060751990104, 41.166666666666664, 37.5S68.63085114493545, 52.60491590884117, 82.33333333333333, 53.125S109.79751781160212, 40.10491590884117, 123.5, 40.625S151.62102067532012, 59.22092140491191, 164.66666666666666, 56.25S195.8083174002536, 27.963066356121296, 205.83333333333334, 21.875S241.0028488931512, 8.526246624563063, 247, 6.25"
                                                            fill="none" fill-opacity="1" stroke="var(--bs-primary)"
                                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                            stroke-dasharray="0" class="apexcharts-line"
                                                            index="0" clip-path="url(#gridRectMaskruolqrw1)"
                                                            pathTo="M 0 100C2.0759868265162513, 96.84819813788019, 30.803537736948932, 43.400060751990104, 41.166666666666664, 37.5S68.63085114493545, 52.60491590884117, 82.33333333333333, 53.125S109.79751781160212, 40.10491590884117, 123.5, 40.625S151.62102067532012, 59.22092140491191, 164.66666666666666, 56.25S195.8083174002536, 27.963066356121296, 205.83333333333334, 21.875S241.0028488931512, 8.526246624563063, 247, 6.25"
                                                            pathFrom="M -1 100 L -1 100 L 41.166666666666664 100 L 82.33333333333333 100 L 123.5 100 L 164.66666666666666 100 L 205.83333333333334 100 L 247 100"
                                                            fill-rule="evenodd"></path>
                                                        <g id="SvgjsG1641"
                                                            class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                            data:realIndex="0">
                                                            <g class="apexcharts-series-markers">
                                                                <circle id="SvgjsCircle1674" r="0" cx="0"
                                                                    cy="0"
                                                                    class="apexcharts-marker w96hrx05x no-pointer-events"
                                                                    stroke="transparent" fill="var(--bs-primary)"
                                                                    fill-opacity="1" stroke-width="2"
                                                                    stroke-opacity="0.9" default-marker-size="0">
                                                                </circle>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1644" class="apexcharts-series"
                                                        seriesName="LastxWeek" data:longestSeries="true"
                                                        rel="2" data:realIndex="1">
                                                        <path id="SvgjsPath1647"
                                                            d="M 0 100C5.012507966539867, 96.95596682193936, 32.13926227790956, 81.5101473957383, 41.166666666666664, 75S69.08814241314035, 43.138636940826096, 82.33333333333333, 40.625S110.68256381557835, 62.780442306083685, 123.5, 59.375S151.12008343219753, 20.292500621333787, 164.66666666666666, 18.75S192.13085114493546, 49.47991590884118, 205.83333333333334, 50S242.32226745763845, 25.070819297666034, 247, 21.875"
                                                            fill="none" fill-opacity="1"
                                                            stroke="var(--bs-primary-bg-subtle)" stroke-opacity="1"
                                                            stroke-linecap="butt" stroke-width="2"
                                                            stroke-dasharray="0" class="apexcharts-line"
                                                            index="1" clip-path="url(#gridRectMaskruolqrw1)"
                                                            pathTo="M 0 100C5.012507966539867, 96.95596682193936, 32.13926227790956, 81.5101473957383, 41.166666666666664, 75S69.08814241314035, 43.138636940826096, 82.33333333333333, 40.625S110.68256381557835, 62.780442306083685, 123.5, 59.375S151.12008343219753, 20.292500621333787, 164.66666666666666, 18.75S192.13085114493546, 49.47991590884118, 205.83333333333334, 50S242.32226745763845, 25.070819297666034, 247, 21.875"
                                                            pathFrom="M -1 100 L -1 100 L 41.166666666666664 100 L 82.33333333333333 100 L 123.5 100 L 164.66666666666666 100 L 205.83333333333334 100 L 247 100"
                                                            fill-rule="evenodd"></path>
                                                        <g id="SvgjsG1645"
                                                            class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                            data:realIndex="1">
                                                            <g class="apexcharts-series-markers">
                                                                <circle id="SvgjsCircle1675" r="0" cx="0"
                                                                    cy="0"
                                                                    class="apexcharts-marker wrwhr8ea4 no-pointer-events"
                                                                    stroke="transparent"
                                                                    fill="var(--bs-primary-bg-subtle)" fill-opacity="1"
                                                                    stroke-width="2" stroke-opacity="0.9"
                                                                    default-marker-size="0">
                                                                </circle>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1642" class="apexcharts-datalabels"
                                                        data:realIndex="0"></g>
                                                    <g id="SvgjsG1646" class="apexcharts-datalabels"
                                                        data:realIndex="1"></g>
                                                </g>
                                                <line id="SvgjsLine1659" x1="0" y1="0"
                                                    x2="247" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1660" x1="0" y1="0"
                                                    x2="247" y2="0" stroke-dasharray="0"
                                                    stroke-width="0" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG1661" class="apexcharts-xaxis"
                                                    transform="translate(0, 0)">
                                                    <g id="SvgjsG1662" class="apexcharts-xaxis-texts-g"
                                                        transform="translate(0, -4)"></g>
                                                </g>
                                                <g id="SvgjsG1671" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG1672" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG1673" class="apexcharts-point-annotations"></g>
                                            </g>
                                        </svg>
                                        <div class="apexcharts-tooltip apexcharts-theme-dark">
                                            <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-primary);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: var(--bs-primary-bg-subtle);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: inherit; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-y-label"></span><span
                                                            class="apexcharts-tooltip-text-y-value"></span></div>
                                                    <div class="apexcharts-tooltip-goals-group"><span
                                                            class="apexcharts-tooltip-text-goals-label"></span><span
                                                            class="apexcharts-tooltip-text-goals-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                            <div class="apexcharts-yaxistooltip-text"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-center gap-2 w-100 mt-3">
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <span class="d-block flex-shrink-0 round-8 bg-primary rounded-circle"></span>
                                    <h6 class="fs-3 fw-normal text-muted mb-0">April 07 - April 14</h6>
                                    <h6 class="fs-3 fw-normal mb-0 ms-auto text-muted">6,380</h6>
                                </div>
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <span class="d-block flex-shrink-0 round-8 bg-light rounded-circle"></span>
                                    <h6 class="fs-3 fw-normal text-muted mb-0">Last Week</h6>
                                    <h6 class="fs-3 fw-normal mb-0 ms-auto text-muted">4,298</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- -------------------------------------------- -->
                    <!-- Sales Overview -->
                    <!-- -------------------------------------------- -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">Sales Overview</h5>
                            <p class="card-subtitle mb-1">Last 7 days</p>

                            <div class="position-relative labels-chart">
                                <span class="fs-11 label-1">0%</span>
                                <span class="fs-11 label-2">25%</span>
                                <span class="fs-11 label-3">50%</span>
                                <span class="fs-11 label-4">75%</span>
                                <div id="sales-overview" style="min-height: 210.75px;">
                                    <div id="apexchartspvrdxaec"
                                        class="apexcharts-canvas apexchartspvrdxaec apexcharts-theme-light"
                                        style="width: 247px; height: 210.75px;"><svg id="SvgjsSvg1676" width="247"
                                            height="210.75" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                            class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                            transform="translate(0, 0)" style="background: transparent;">
                                            <foreignObject x="0" y="0" width="247" height="210.75">
                                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml">
                                                </div>
                                            </foreignObject>
                                            <g id="SvgjsG1678" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(21.5, 0)">
                                                <defs id="SvgjsDefs1677">
                                                    <clipPath id="gridRectMaskpvrdxaec">
                                                        <rect id="SvgjsRect1679" width="211" height="229"
                                                            x="-2.5" y="-0.5" rx="0" ry="0"
                                                            opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="forecastMaskpvrdxaec"></clipPath>
                                                    <clipPath id="nonForecastMaskpvrdxaec"></clipPath>
                                                    <clipPath id="gridRectMarkerMaskpvrdxaec">
                                                        <rect id="SvgjsRect1680" width="210" height="232" x="-2"
                                                            y="-2" rx="0" ry="0" opacity="1"
                                                            stroke-width="0" stroke="none" stroke-dasharray="0"
                                                            fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <g id="SvgjsG1681" class="apexcharts-radialbar">
                                                    <g id="SvgjsG1682">
                                                        <g id="SvgjsG1683" class="apexcharts-tracks">
                                                            <g id="SvgjsG1684"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="1">
                                                                <path id="apexcharts-radialbarTrack-0"
                                                                    d="M 103 26.496951219512184 A 76.50304878048782 76.50304878048782 0 1 1 26.496951219512184 103.00000000000001"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="round"
                                                                    stroke-width="9.043475609756099"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathOrig="M 103 26.496951219512184 A 76.50304878048782 76.50304878048782 0 1 1 26.496951219512184 103.00000000000001">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1686"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="2">
                                                                <path id="apexcharts-radialbarTrack-1"
                                                                    d="M 103 40.820121951219505 A 62.179878048780495 62.179878048780495 0 1 1 40.820121951219505 103.00000000000001"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="round"
                                                                    stroke-width="9.043475609756099"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathOrig="M 103 40.820121951219505 A 62.179878048780495 62.179878048780495 0 1 1 40.820121951219505 103.00000000000001">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1688"
                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                rel="3">
                                                                <path id="apexcharts-radialbarTrack-2"
                                                                    d="M 103 55.14329268292683 A 47.85670731707317 47.85670731707317 0 1 1 55.14329268292683 103"
                                                                    fill="none" fill-opacity="1"
                                                                    stroke="rgba(242,242,242,0.85)" stroke-opacity="1"
                                                                    stroke-linecap="round"
                                                                    stroke-width="9.043475609756099"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area"
                                                                    data:pathOrig="M 103 55.14329268292683 A 47.85670731707317 47.85670731707317 0 1 1 55.14329268292683 103">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1690">
                                                            <g id="SvgjsG1692"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesName="36x" rel="1" data:realIndex="0">
                                                                <path id="SvgjsPath1693"
                                                                    d="M 103 26.496951219512184 A 76.50304878048782 76.50304878048782 0 0 1 157.0958245741282 157.09582457412816"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="var(--bs-primary)" stroke-opacity="1"
                                                                    stroke-linecap="round"
                                                                    stroke-width="9.323170731707318"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                    data:angle="135" data:value="50" index="0"
                                                                    j="0"
                                                                    data:pathOrig="M 103 26.496951219512184 A 76.50304878048782 76.50304878048782 0 0 1 157.0958245741282 157.09582457412816">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1694"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesName="10x" rel="2" data:realIndex="1">
                                                                <path id="SvgjsPath1695"
                                                                    d="M 103 40.820121951219505 A 62.179878048780495 62.179878048780495 0 1 1 66.45158469358236 153.30457804962518"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="var(--bs-secondary)" stroke-opacity="1"
                                                                    stroke-linecap="round"
                                                                    stroke-width="9.323170731707318"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-1"
                                                                    data:angle="216" data:value="80" index="0"
                                                                    j="1"
                                                                    data:pathOrig="M 103 40.820121951219505 A 62.179878048780495 62.179878048780495 0 1 1 66.45158469358236 153.30457804962518">
                                                                </path>
                                                            </g>
                                                            <g id="SvgjsG1696"
                                                                class="apexcharts-series apexcharts-radial-series"
                                                                seriesName="36x" rel="3" data:realIndex="2">
                                                                <path id="SvgjsPath1697"
                                                                    d="M 103 55.14329268292683 A 47.85670731707317 47.85670731707317 0 0 1 150.26751183634718 95.51356159226675"
                                                                    fill="none" fill-opacity="0.85"
                                                                    stroke="var(--bs-danger)" stroke-opacity="1"
                                                                    stroke-linecap="round"
                                                                    stroke-width="9.323170731707318"
                                                                    stroke-dasharray="0"
                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-2"
                                                                    data:angle="81" data:value="30" index="0"
                                                                    j="2"
                                                                    data:pathOrig="M 103 55.14329268292683 A 47.85670731707317 47.85670731707317 0 0 1 150.26751183634718 95.51356159226675">
                                                                </path>
                                                            </g>
                                                            <circle id="SvgjsCircle1691" r="42.33496951219514"
                                                                cx="103" cy="103"
                                                                class="apexcharts-radialbar-hollow" fill="transparent">
                                                            </circle>
                                                        </g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1698" x1="0" y1="0"
                                                    x2="206" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1699" x1="0" y1="0"
                                                    x2="206" y2="0" stroke-dasharray="0"
                                                    stroke-width="0" stroke-linecap="butt"
                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                            </g>
                                        </svg></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8">
            <!-- -------------------------------------------- -->
            <!-- Revenue by Product -->
            <!-- -------------------------------------------- -->
            <div class="card mb-lg-0">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-9 justify-content-between align-items-center">
                        <h5 class="card-title fw-semibold mb-0">Revenue by Product</h5>
                        <select class="form-select w-auto fw-semibold">
                            <option value="1">Sep 2024</option>
                            <option value="2">Oct 2024</option>
                            <option value="3">Nov 2024</option>
                        </select>
                    </div>

                    <div class="table-responsive">
                        <ul class="nav nav-tabs theme-tab gap-3 flex-nowrap" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#app" role="tab"
                                    aria-selected="true">
                                    <div class="hstack gap-2">
                                        <iconify-icon icon="solar:widget-linear" class="fs-4"></iconify-icon>
                                        <span>App</span>
                                    </div>

                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#mobile" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <div class="hstack gap-2">
                                        <iconify-icon icon="solar:smartphone-line-duotone"
                                            class="fs-4"></iconify-icon>
                                        <span>Mobile</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#saas" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <div class="hstack gap-2">
                                        <iconify-icon icon="solar:calculator-linear" class="fs-4"></iconify-icon>
                                        <span>SaaS</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#other" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <div class="hstack gap-2">
                                        <iconify-icon icon="solar:folder-open-outline" class="fs-4"></iconify-icon>
                                        <span>Others</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content mb-n3">
                        <div class="tab-pane active" id="app" role="tabpanel">
                            <div class="table-responsive" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <table
                                                        class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="fw-normal ps-0">Assigned
                                                                </th>
                                                                <th scope="col" class="fw-normal">Progress</th>
                                                                <th scope="col" class="fw-normal">Priority</th>
                                                                <th scope="col" class="fw-normal">Budget</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-1.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Minecraf App</h6>
                                                                            <span>Jason Roy</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-success-subtle text-success">Low</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-2.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Web App Project</h6>
                                                                            <span>Mathew Flintoff</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-warning-subtle text-warning">Medium</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-3.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Modernize Dashboard
                                                                            </h6>
                                                                            <span>Anil Kumar</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-secondary-subtle text-secondary">Very
                                                                        High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-4.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Dashboard Co</h6>
                                                                            <span>George Cruize</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger">High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 681px; height: 356px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="mobile" role="tabpanel">
                            <div class="table-responsive" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <table
                                                        class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="fw-normal ps-0">Assigned
                                                                </th>
                                                                <th scope="col" class="fw-normal">Progress</th>
                                                                <th scope="col" class="fw-normal">Priority</th>
                                                                <th scope="col" class="fw-normal">Budget</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-2.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Web App Project</h6>
                                                                            <span>Mathew Flintoff</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-warning-subtle text-warning">Medium</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-3.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Modernize Dashboard
                                                                            </h6>
                                                                            <span>Anil Kumar</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-secondary-subtle text-secondary">Very
                                                                        High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-1.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Minecraf App</h6>
                                                                            <span>Jason Roy</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-success-subtle text-success">Low</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-4.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Dashboard Co</h6>
                                                                            <span>George Cruize</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger">High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="saas" role="tabpanel">
                            <div class="table-responsive" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <table
                                                        class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="fw-normal ps-0">Assigned
                                                                </th>
                                                                <th scope="col" class="fw-normal">Progress</th>
                                                                <th scope="col" class="fw-normal">Priority</th>
                                                                <th scope="col" class="fw-normal">Budget</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-2.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Web App Project</h6>
                                                                            <span>Mathew Flintoff</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-warning-subtle text-warning">Medium</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-1.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Minecraf App</h6>
                                                                            <span>Jason Roy</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-success-subtle text-success">Low</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-3.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Modernize Dashboard
                                                                            </h6>
                                                                            <span>Anil Kumar</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-secondary-subtle text-secondary">Very
                                                                        High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-4.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Dashboard Co</h6>
                                                                            <span>George Cruize</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger">High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="other" role="tabpanel">
                            <div class="table-responsive" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <table
                                                        class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="fw-normal ps-0">Assigned
                                                                </th>
                                                                <th scope="col" class="fw-normal">Progress</th>
                                                                <th scope="col" class="fw-normal">Priority</th>
                                                                <th scope="col" class="fw-normal">Budget</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-1.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Minecraf App</h6>
                                                                            <span>Jason Roy</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-success-subtle text-success">Low</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-3.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Modernize Dashboard
                                                                            </h6>
                                                                            <span>Anil Kumar</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-secondary-subtle text-secondary">Very
                                                                        High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-2.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Web App Project</h6>
                                                                            <span>Mathew Flintoff</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-warning-subtle text-warning">Medium</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="ps-0">
                                                                    <div class="d-flex align-items-center gap-6">
                                                                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/products/dash-prd-4.jpg"
                                                                            alt="prd1" width="48"
                                                                            class="rounded">
                                                                        <div>
                                                                            <h6 class="mb-0">Dashboard Co</h6>
                                                                            <span>George Cruize</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span>73.2%</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger">High</span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark-light">$3.5k</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- -------------------------------------------- -->
            <!-- Total settlements -->
            <!-- -------------------------------------------- -->
            <div class="card bg-primary-subtle mb-0">
                <div class="card-body">
                    <div class="hstack align-items-center gap-3 mb-4">
                        <span
                            class="d-flex align-items-center justify-content-center round-48 bg-white rounded flex-shrink-0">
                            <iconify-icon icon="solar:box-linear" class="fs-7 text-primary"></iconify-icon>
                        </span>
                        <div>
                            <p class="mb-1 text-dark-light">Total settlements</p>
                            <h4 class="mb-0 fw-bolder">$122,580</h4>
                        </div>
                    </div>
                    <div style="height: 278px;">
                        <div id="settlements" style="min-height: 315px;">
                            <div id="apexchartsn4ju18kt"
                                class="apexcharts-canvas apexchartsn4ju18kt apexcharts-theme-light"
                                style="width: 295px; height: 300px;"><svg id="SvgjsSvg1701" width="295"
                                    height="300" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                    class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                    transform="translate(0, 0)" style="background: transparent;">
                                    <foreignObject x="0" y="0" width="295" height="300">
                                        <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                            style="max-height: 150px;"></div>
                                    </foreignObject>
                                    <rect id="SvgjsRect1706" width="0" height="0" x="0" y="0"
                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                        stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsG1776" class="apexcharts-yaxis" rel="0"
                                        transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1703" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(12, 30)">
                                        <defs id="SvgjsDefs1702">
                                            <clipPath id="gridRectMaskn4ju18kt">
                                                <rect id="SvgjsRect1708" width="279" height="225.33013292185467"
                                                    x="-3" y="-1" rx="0" ry="0" opacity="1"
                                                    stroke-width="0" stroke="none" stroke-dasharray="0"
                                                    fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="forecastMaskn4ju18kt"></clipPath>
                                            <clipPath id="nonForecastMaskn4ju18kt"></clipPath>
                                            <clipPath id="gridRectMarkerMaskn4ju18kt">
                                                <rect id="SvgjsRect1709" width="277" height="227.33013292185467"
                                                    x="-2" y="-2" rx="0" ry="0" opacity="1"
                                                    stroke-width="0" stroke="none" stroke-dasharray="0"
                                                    fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <line id="SvgjsLine1707" x1="0" y1="0" x2="0"
                                            y2="223.33013292185467" stroke="#b6b6b6" stroke-dasharray="3"
                                            stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0"
                                            width="1" height="223.33013292185467" fill="#b1b9c4" filter="none"
                                            fill-opacity="0.9" stroke-width="1"></line>
                                        <g id="SvgjsG1715" class="apexcharts-grid">
                                            <g id="SvgjsG1716" class="apexcharts-gridlines-horizontal">
                                                <line id="SvgjsLine1720" x1="0" y1="111.66506646092733"
                                                    x2="273" y2="111.66506646092733"
                                                    stroke="var(--bs-primary-bg-subtle)" stroke-dasharray="4"
                                                    stroke-linecap="butt" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1717" class="apexcharts-gridlines-vertical"></g>
                                            <line id="SvgjsLine1723" x1="0" y1="223.33013292185467"
                                                x2="273" y2="223.33013292185467" stroke="transparent"
                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                            <line id="SvgjsLine1722" x1="0" y1="1" x2="0"
                                                y2="223.33013292185467" stroke="transparent" stroke-dasharray="0"
                                                stroke-linecap="butt"></line>
                                        </g>
                                        <g id="SvgjsG1718" class="apexcharts-grid-borders">
                                            <line id="SvgjsLine1719" x1="0" y1="0" x2="273"
                                                y2="0" stroke="var(--bs-primary-bg-subtle)"
                                                stroke-dasharray="4" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                            <line id="SvgjsLine1721" x1="0" y1="223.33013292185467"
                                                x2="273" y2="223.33013292185467"
                                                stroke="var(--bs-primary-bg-subtle)" stroke-dasharray="4"
                                                stroke-linecap="butt" class="apexcharts-gridline"></line>
                                        </g>
                                        <g id="SvgjsG1710" class="apexcharts-line-series apexcharts-plot-series">
                                            <g id="SvgjsG1711" class="apexcharts-series" seriesName="settlements"
                                                data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1714"
                                                    d="M 0 159.52152351561048C3.033333333333333, 159.52152351561048, 12.133333333333333, 159.52152351561048, 18.2, 159.52152351561048S30.333333333333332, 95.7129141093663, 36.4, 95.7129141093663S48.53333333333333, 95.7129141093663, 54.6, 95.7129141093663S66.73333333333333, 175.47367586717152, 72.8, 175.47367586717152S84.93333333333334, 175.47367586717152, 91, 175.47367586717152S103.13333333333334, 207.37798057029363, 109.2, 207.37798057029363S121.33333333333334, 207.37798057029363, 127.4, 207.37798057029363S139.53333333333333, 175.47367586717152, 145.6, 175.47367586717152S157.73333333333335, 175.47367586717152, 163.8, 175.47367586717152S175.93333333333334, 63.80860940624419, 182, 63.80860940624419S194.13333333333335, 63.80860940624419, 200.20000000000002, 63.80860940624419S212.33333333333334, 191.4258282187326, 218.4, 191.4258282187326S230.53333333333333, 191.4258282187326, 236.6, 191.4258282187326S248.73333333333335, 0, 254.8, 0S269.9666666666667, 0, 273, 0"
                                                    fill="none" fill-opacity="1" stroke="var(--bs-primary)"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                    stroke-dasharray="0" class="apexcharts-line" index="0"
                                                    clip-path="url(#gridRectMaskn4ju18kt)"
                                                    pathTo="M 0 159.52152351561048C3.033333333333333, 159.52152351561048, 12.133333333333333, 159.52152351561048, 18.2, 159.52152351561048S30.333333333333332, 95.7129141093663, 36.4, 95.7129141093663S48.53333333333333, 95.7129141093663, 54.6, 95.7129141093663S66.73333333333333, 175.47367586717152, 72.8, 175.47367586717152S84.93333333333334, 175.47367586717152, 91, 175.47367586717152S103.13333333333334, 207.37798057029363, 109.2, 207.37798057029363S121.33333333333334, 207.37798057029363, 127.4, 207.37798057029363S139.53333333333333, 175.47367586717152, 145.6, 175.47367586717152S157.73333333333335, 175.47367586717152, 163.8, 175.47367586717152S175.93333333333334, 63.80860940624419, 182, 63.80860940624419S194.13333333333335, 63.80860940624419, 200.20000000000002, 63.80860940624419S212.33333333333334, 191.4258282187326, 218.4, 191.4258282187326S230.53333333333333, 191.4258282187326, 236.6, 191.4258282187326S248.73333333333335, 0, 254.8, 0S269.9666666666667, 0, 273, 0"
                                                    pathFrom="M -1 223.33013292185467 L -1 223.33013292185467 L 18.2 223.33013292185467 L 36.4 223.33013292185467 L 54.6 223.33013292185467 L 72.8 223.33013292185467 L 91 223.33013292185467 L 109.2 223.33013292185467 L 127.4 223.33013292185467 L 145.6 223.33013292185467 L 163.8 223.33013292185467 L 182 223.33013292185467 L 200.20000000000002 223.33013292185467 L 218.4 223.33013292185467 L 236.6 223.33013292185467 L 254.8 223.33013292185467 L 273 223.33013292185467"
                                                    fill-rule="evenodd"></path>
                                                <g id="SvgjsG1712"
                                                    class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                                    data:realIndex="0">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle1780" r="0" cx="0"
                                                            cy="0"
                                                            class="apexcharts-marker whqo0xskp no-pointer-events"
                                                            stroke="var(--bs-primary)" fill="var(--bs-primary)"
                                                            fill-opacity="1" stroke-width="3" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1713" class="apexcharts-datalabels" data:realIndex="0">
                                            </g>
                                        </g>
                                        <line id="SvgjsLine1724" x1="0" y1="0" x2="273"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                        </line>
                                        <line id="SvgjsLine1725" x1="0" y1="0" x2="273"
                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                            stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1726" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1727" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, -10)"><text id="SvgjsText1729"
                                                    font-family="inherit" x="0" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 1.3849973678588867 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1730">1W</tspan>
                                                    <title>1W</title>
                                                </text><text id="SvgjsText1732" font-family="inherit"
                                                    x="18.199999999999996" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1733"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1735" font-family="inherit" x="36.4"
                                                    y="246.33013292185467" text-anchor="end" dominant-baseline="auto"
                                                    font-size="10px" font-weight="600" fill="#adb0bb"
                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 37.78499794006348 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1736">3W</tspan>
                                                    <title>3W</title>
                                                </text><text id="SvgjsText1738" font-family="inherit" x="54.6"
                                                    y="246.33013292185467" text-anchor="end" dominant-baseline="auto"
                                                    font-size="10px" font-weight="600" fill="#adb0bb"
                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1739"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1741" font-family="inherit"
                                                    x="72.80000000000001" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 74.18624782562256 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1742">5W</tspan>
                                                    <title>5W</title>
                                                </text><text id="SvgjsText1744" font-family="inherit"
                                                    x="91.00000000000001" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1745"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1747" font-family="inherit"
                                                    x="109.20000000000002" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 110.583749294281 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1748">7W</tspan>
                                                    <title>7W</title>
                                                </text><text id="SvgjsText1750" font-family="inherit" x="127.4"
                                                    y="246.33013292185467" text-anchor="end" dominant-baseline="auto"
                                                    font-size="10px" font-weight="600" fill="#adb0bb"
                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1751"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1753" font-family="inherit" x="145.6"
                                                    y="246.33013292185467" text-anchor="end" dominant-baseline="auto"
                                                    font-size="10px" font-weight="600" fill="#adb0bb"
                                                    class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 146.9824981689453 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1754">9W</tspan>
                                                    <title>9W</title>
                                                </text><text id="SvgjsText1756" font-family="inherit"
                                                    x="163.79999999999998" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1757"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1759" font-family="inherit"
                                                    x="181.99999999999997" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 183.3825044631958 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1760">11W</tspan>
                                                    <title>11W</title>
                                                </text><text id="SvgjsText1762" font-family="inherit"
                                                    x="200.19999999999996" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1763"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1765" font-family="inherit"
                                                    x="218.39999999999995" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 219.78249835968018 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1766">13W</tspan>
                                                    <title>13W</title>
                                                </text><text id="SvgjsText1768" font-family="inherit"
                                                    x="236.59999999999994" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1769"></tspan>
                                                    <title></title>
                                                </text><text id="SvgjsText1771" font-family="inherit"
                                                    x="254.79999999999993" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;"
                                                    transform="rotate(0 256.1837434768677 241.73013019561768)">
                                                    <tspan id="SvgjsTspan1772">15W</tspan>
                                                    <title>15W</title>
                                                </text><text id="SvgjsText1774" font-family="inherit"
                                                    x="272.9999999999999" y="246.33013292185467" text-anchor="end"
                                                    dominant-baseline="auto" font-size="10px" font-weight="600"
                                                    fill="#adb0bb" class="apexcharts-text apexcharts-xaxis-label "
                                                    style="font-family: inherit;" transform="rotate(0 1 -1)">
                                                    <tspan id="SvgjsTspan1775"></tspan>
                                                    <title></title>
                                                </text></g>
                                        </g>
                                        <g id="SvgjsG1777" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1778" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1779" class="apexcharts-point-annotations"></g>
                                        <rect id="SvgjsRect1781" width="0" height="0" x="0" y="0"
                                            rx="0" ry="0" opacity="1" stroke-width="0"
                                            stroke="none" stroke-dasharray="0" fill="#fefefe"
                                            class="apexcharts-zoom-rect"></rect>
                                        <rect id="SvgjsRect1782" width="0" height="0" x="0" y="0"
                                            rx="0" ry="0" opacity="1" stroke-width="0"
                                            stroke="none" stroke-dasharray="0" fill="#fefefe"
                                            class="apexcharts-selection-rect"></rect>
                                    </g>
                                </svg>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-title"
                                        style="font-family: inherit; font-size: 12px;"></div>
                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: var(--bs-primary);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: inherit; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-dark">
                                    <div class="apexcharts-xaxistooltip-text"
                                        style="font-family: inherit; font-size: 12px;"></div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mb-2">
                        <div class="col-md-6 text-center">
                            <p class="mb-1 text-dark-light lh-lg">Total balance</p>
                            <h4 class="mb-0 text-nowrap">$122,580</h4>
                        </div>
                        <div class="col-md-6 text-center mt-3 mt-md-0">
                            <p class="mb-1 text-dark-light lh-lg">Withdrawals</p>
                            <h4 class="mb-0">$31,640</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
