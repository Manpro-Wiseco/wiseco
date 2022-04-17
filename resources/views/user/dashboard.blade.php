<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@push('scripts')
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx2 = document.getElementById("chart-line-sales").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line"
        , data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            , datasets: [{
                    label: "Mobile apps"
                    , tension: 0.4
                    , borderWidth: 0
                    , pointRadius: 0
                    , borderColor: "#cb0c9f"
                    , borderWidth: 3
                    , backgroundColor: gradientStroke1
                    , fill: true
                    , data: [50, 40, 300, 220, 500, 250, 400, 0, 500]
                    , maxBarThickness: 6

                }
                , {
                    label: "Websites"
                    , tension: 0.4
                    , borderWidth: 0
                    , pointRadius: 0
                    , borderColor: "#3A416F"
                    , borderWidth: 3
                    , backgroundColor: gradientStroke2
                    , fill: true
                    , data: [30, 90, 40, 140, 290, 290, 340, 230, 400]
                    , maxBarThickness: 6
                }
            , ]
        , }
        , options: {
            responsive: true
            , maintainAspectRatio: false
            , plugins: {
                legend: {
                    display: false
                , }
            }
            , interaction: {
                intersect: false
                , mode: 'index'
            , }
            , scales: {
                y: {
                    grid: {
                        drawBorder: false
                        , display: true
                        , drawOnChartArea: true
                        , drawTicks: false
                        , borderDash: [5, 5]
                    }
                    , ticks: {
                        display: true
                        , padding: 10
                        , color: '#b2b9bf'
                        , font: {
                            size: 11
                            , family: "Open Sans"
                            , style: 'normal'
                            , lineHeight: 2
                        }
                    , }
                }
                , x: {
                    grid: {
                        drawBorder: false
                        , display: false
                        , drawOnChartArea: false
                        , drawTicks: false
                        , borderDash: [5, 5]
                    }
                    , ticks: {
                        display: true
                        , color: '#b2b9bf'
                        , padding: 20
                        , font: {
                            size: 11
                            , family: "Open Sans"
                            , style: 'normal'
                            , lineHeight: 2
                        }
                    , }
                }
            , }
        , }
    , });

</script>
<script>
    var ctx2 = document.getElementById("chart-line-purchases").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line"
        , data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            , datasets: [{
                    label: "Mobile apps"
                    , tension: 0.4
                    , borderWidth: 0
                    , pointRadius: 0
                    , borderColor: "#cb0c9f"
                    , borderWidth: 3
                    , backgroundColor: gradientStroke1
                    , fill: true
                    , data: [50, 40, 300, 220, 500, 250, 400, 0, 500]
                    , maxBarThickness: 6

                }
                , {
                    label: "Websites"
                    , tension: 0.4
                    , borderWidth: 0
                    , pointRadius: 0
                    , borderColor: "#3A416F"
                    , borderWidth: 3
                    , backgroundColor: gradientStroke2
                    , fill: true
                    , data: [30, 90, 40, 140, 290, 290, 340, 230, 400]
                    , maxBarThickness: 6
                }
            , ]
        , }
        , options: {
            responsive: true
            , maintainAspectRatio: false
            , plugins: {
                legend: {
                    display: false
                , }
            }
            , interaction: {
                intersect: false
                , mode: 'index'
            , }
            , scales: {
                y: {
                    grid: {
                        drawBorder: false
                        , display: true
                        , drawOnChartArea: true
                        , drawTicks: false
                        , borderDash: [5, 5]
                    }
                    , ticks: {
                        display: true
                        , padding: 10
                        , color: '#b2b9bf'
                        , font: {
                            size: 11
                            , family: "Open Sans"
                            , style: 'normal'
                            , lineHeight: 2
                        }
                    , }
                }
                , x: {
                    grid: {
                        drawBorder: false
                        , display: false
                        , drawOnChartArea: false
                        , drawTicks: false
                        , borderDash: [5, 5]
                    }
                    , ticks: {
                        display: true
                        , color: '#b2b9bf'
                        , padding: 20
                        , font: {
                            size: 11
                            , family: "Open Sans"
                            , style: 'normal'
                            , lineHeight: 2
                        }
                    , }
                }
            , }
        , }
    , });

</script>
@endpush

{{-- Content Body --}}
<x-template-layout>
    <section class="content">

        {{-- Loss,Revenue,Expense,Filter  --}}
        <div class="row">
            {{-- Filter --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="Filter">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="numbers">
                                        <div class="dropdown m-0">
                                            <button class="btn bg-gradient-primary dropdown-toggle m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Show
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="javascript:;">Today</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">This Week</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">This Month</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">This Year</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="icon shadow text-center border-radius-md">
                                        <form action="/notification" method="GET">
                                            <button style="padding: 0; border: none; background: none;">
                                                <i class="fa-solid fa-bell fa-lg opacity-10 mt-2" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Loss --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Loss</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        Rp0,00
                                        <span class="text-success text-sm font-weight-bolder">+0%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-sack-dollar fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Revenue --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Revenue</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        Rp0,00
                                        <span class="text-success text-sm font-weight-bolder">+0%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-arrow-trend-up text-lg opacity-10 mt-1" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Expense --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Expense</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        Rp0,00
                                        <span class="text-danger text-sm font-weight-bolder">-0%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-arrow-trend-down text-lg opacity-10 mt-1" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daily Sales & Balance Sheet --}}
        <div class="row mt-4">
            {{-- Daily Sales --}}
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Daily Sales</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">0% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line-sales" class="chart-canvas" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Balance Sheet --}}
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header pb-0">
                        <h6>Balance Sheet</h6>
                    </div>
                    <div class="card-body p-3">

                        {{-- Asset --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                            <div class="card border border-primary" style="overflow: hidden">
                                <div class="card-body p-3" style="background-color:#E9D5F1">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Asset</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end ">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-box-open fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Liabilities --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-secondary" style="overflow: hidden">
                                <div class="card-body p-3" style="background-color: #EAEAEA">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Liabilities</p>
                                                <h5 class="font-weight-bolder mb-0 text-secondary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-clipboard fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Equity --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-info mb-3" style="overflow: hidden">
                                <div class="card-body p-3" style="background-color: #C8E9FF">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Equity</p>
                                                <h5 class="font-weight-bolder mb-0 text-info">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-chart-simple fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Sales & Purchase Invoice --}}
        <div class="row mt-4">

            {{--Sales --}}
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Sales Invoice</h6>
                    </div>
                    <div class="card-body p-3">
                        <img src="https://go.zahironline.com/assets/img/png/animated/zo-empty-state-dashboard-sales.png" alt="">
                    </div>
                </div>
            </div>

            {{-- Purchase --}}
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Purchase Invoice</h6>
                    </div>
                    <div class="card-body p-3">
                        <img src="https://go.zahironline.com/assets/img/png/animated/zo-empty-state-dashboard-purchases.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        {{-- Overall Balance & Daily Purchase --}}
        <div class="row mt-4">

            {{-- Balance Sheet --}}
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">

                        {{-- Overal Ballance --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                            <div class="card border border-primary" style="overflow: hidden">
                                <div class="card-body p-3" style="background-color: #E9D5F1">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Overall Balance</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-money-bill-wave fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Income --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-secondary" style="overflow: hidden">
                                <div class="card-body p-3" style="background-color: #EAEAEA">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Income</p>
                                                <h5 class="font-weight-bolder mb-0 text-secondary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-money-bill-trend-up fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Expense --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-info mb-3" style="overflow: hidden">
                                <div class="card-body p-3" style="background-color: #C8E9FF">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Expense</p>
                                                <h5 class="font-weight-bolder mb-0 text-info">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-clipboard-list fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Daily Purchase --}}
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Daily Purchases</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line-purchases" class="chart-canvas" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sales Amount & Purchase Amount --}}
        <div class="row mt-4">

            {{--Sales --}}
            <div class="col-lg-6 mb-lg-0 mb-4 text-center">
                <div class="card z-index-2">
                    <div class="card">
                        <div class="card-body p-3 m-2 border border-secondary rounded-3" style="background-color: #FAFAFA">
                            <h6>Sales Amount</h6>
                            <h5 class="text-info">Rp.0</h5>
                        </div>
                        <div class="row m-2">
                            <div class="col-lg-6 mb-lg-0 mb-4 border" style="background-color: #FAFAFA">
                                <div class="card-body p-3">
                                    <h6>Total Transactions</h6>
                                    <h6>0</h6>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-lg-0 mb-4 border" style="background-color: #FAFAFA">
                                <div class="card-body p-3">
                                    <h6>Total Customer</h6>
                                    <h6>0</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 m-2 border border-secondary rounded-3" style="background-color: #FAFAFA">
                            <h6>Product Sold</h6>
                            <h4 class="text-info">0</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Purchase --}}
            <div class="col-lg-6 mb-lg-0 mb-4 text-center">
                <div class="card z-index-2">
                    <div class="card-body p-3 m-2 border border-secondary rounded-3" style="background-color: #FAFAFA">
                        <h6>Purchase Amount</h6>
                        <h5 class="text-success">Rp.0</h5>
                    </div>
                    <div class="row m-2">
                        <div class="col-lg-6 mb-lg-0 mb-4 border" style="background-color: #FAFAFA">
                            <div class="card-body p-3">
                                <h6>Total Transactions</h6>
                                <h6>0</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-lg-0 mb-4 border" style="background-color: #FAFAFA">
                            <div class="card-body p-3">
                                <h6>Total Supplier</h6>
                                <h6>0</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 m-2 border border-secondary rounded-3" style="background-color: #FAFAFA">
                        <h6>Product Purchased</h6>
                        <h4 class="text-success">0</h4>
                    </div>
                </div>
            </div>
        </div>


    </section>
</x-template-layout>
