@extends('layouts.main')

@section('container')
    <style>
        #barchart {
            width: 100%;
            height: 500px;
        }
    </style>
    <div class="col-lg-15">
        @if (session()->has('berhasil'))
            <div class="alert alert-success col-lg-15" role="alert">
                {{ session('berhasil') }}
            </div>
        @endif
        @if (session()->has('gagal'))
            <div class="alert alert-danger col-lg-15" role="alert">
                {{ session('gagal') }}
            </div>
        @endif
        <!-- /.card -->
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Grafik</div>
                    <div class="card-body">
                        <div id="barchart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Data Makanan & Minuman</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
    </div> --}}


    <script type="text/javascript">
        $(function() {
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Makanan',
                    'Minuman',
                ],
                datasets: [{
                    data: [90, 100],
                    backgroundColor: ['#f56954', '#00a65a'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
        })
    </script>

    {{-- <script type="text/javascript">
        $(function() {
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

        })
    </script> --}}

    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("barchart", am4charts.XYChart);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.data = [{
                    country: "Gudang",
                    visits: 23725
                },
                {
                    country: "Layanan",
                    visits: 1882
                },
                {
                    country: "Kontrak",
                    visits: 1809
                },
                {
                    country: "Depo Container",
                    visits: 1322
                },
                {
                    country: "Pelanggan",
                    visits: 1322
                },
            ];

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.dataFields.category = "country";
            categoryAxis.renderer.minGridDistance = 40;
            categoryAxis.fontSize = 11;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.max = 5000;
            valueAxis.strictMinMax = true;
            valueAxis.renderer.minGridDistance = 30;
            // axis break
            // var axisBreak = valueAxis.axisBreaks.create();
            // axisBreak.startValue = 2100;
            // axisBreak.endValue = 22900;
            //axisBreak.breakSize = 0.005;

            // fixed axis break
            // var d = (axisBreak.endValue - axisBreak.startValue) / (valueAxis.max - valueAxis.min);
            // axisBreak.breakSize = 0.05 * (1 - d) /
            //     d; // 0.05 means that the break will take 5% of the total value axis height

            // make break expand on hover
            // var hoverState = axisBreak.states.create("hover");
            // hoverState.properties.breakSize = 1;
            // hoverState.properties.opacity = 0.1;
            // hoverState.transitionDuration = 1500;

            // axisBreak.defaultState.transitionDuration = 1000;
            /*
            // this is exactly the same, but with events
            axisBreak.events.on("over", function() {
              axisBreak.animate(
                [{ property: "breakSize", to: 1 }, { property: "opacity", to: 0.1 }],
                1500,
                am4core.ease.sinOut
              );
            });
            axisBreak.events.on("out", function() {
              axisBreak.animate(
                [{ property: "breakSize", to: 0.005 }, { property: "opacity", to: 1 }],
                1000,
                am4core.ease.quadOut
              );
            });*/

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.categoryX = "country";
            series.dataFields.valueY = "visits";
            series.columns.template.tooltipText = "{valueY.value}";
            series.columns.template.tooltipY = 0;
            series.columns.template.strokeOpacity = 0;

            // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
            series.columns.template.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

        }); // end am4core.ready()
    </script>
@endsection
