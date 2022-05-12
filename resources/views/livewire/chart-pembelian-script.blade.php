<script>
    let myChart2;
    var ctx2 = document.getElementById("chart_pembelian").getContext("2d");
    console.log(ctx2);

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    myChart2 = new Chart(ctx2, {
        type: "line"
        , data: {
            labels: [
                @foreach($tanggal as $item)
                '{{$item}}'
                , @endforeach

            ]
            , datasets: [{
                    label: "Jumlah Transaksi"
                    , tension: 0.4
                    , borderWidth: 0
                    , pointRadius: 0
                    , borderColor: "#cb0c9f"
                    , borderWidth: 3
                    , backgroundColor: gradientStroke1
                    , fill: true
                    , data: [
                        @foreach($count as $item)
                        '{{$item}}'
                        , @endforeach
                    ]
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
    Livewire.on('ubahBulanTahun_pembelian', (count, tanggal) => {
        // console.log(count);
        // console.log(tanggal);
        myChart2.destroy();
        var ctx2 = document.getElementById("chart_pembelian").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        myChart2 = new Chart(ctx2, {
            type: "line"
            , data: {
                labels: tanggal
                , datasets: [{
                        label: "Jumlah Transaksi"
                        , tension: 0.4
                        , borderWidth: 0
                        , pointRadius: 0
                        , borderColor: "#cb0c9f"
                        , borderWidth: 3
                        , backgroundColor: gradientStroke1
                        , fill: true
                        , data: count
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
    })

</script>
