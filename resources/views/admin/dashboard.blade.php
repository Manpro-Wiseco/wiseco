@component('admin.template')
@push('scripts')
<script>
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = "gray";
    new Chart("myChart", {
        type: "bar"
        , data: {
            labels: xValues
            , datasets: [{
                backgroundColor: barColors
                , data: yValues
            }]
        }
        , options: {
            legend: {
                display: false
            }
            , title: {
                display: true
                , text: "(Demo Chart) World Wine Production 2018"
            }
        }
    });

</script>
@endpush
<div class="row">
    {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                    <h4 class="mb-0">$53k</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>
            </div>
        </div>
    </div> --}}
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">credit_card</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Tiket</p>
                    <h4 class="mb-0">{{$totalTicket}}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$openTicket}}</span> status terbuka</p>
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$closeTicket}}</span> status tertutup</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Pengguna</p>
                    <h4 class="mb-0">{{$totalUser}}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">{{$adminUser}}</span> Admin</p>
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">{{$clientUser}}</span> Client</p>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">store</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total UMKM</p>
                    <h4 class="mb-0">{{$totalUMKM}}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">&nbsp;</span> </p>
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">&nbsp;</span> </p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-xl-12 col-sm-6">
        <div class="card mb-3">
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="myChart" class="chart-canvas" height="100px"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Website Views</h6>
                <p class="text-sm ">Last Campaign Performance</p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 "> Daily Sales </h6>
                <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm"> updated 4 min ago </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-4 mb-3">
        <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Completed Tasks</h6>
                <p class="text-sm ">Last Campaign Performance</p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm">just updated</p>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@endcomponent
