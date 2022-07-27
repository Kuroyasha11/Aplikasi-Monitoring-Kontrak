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


    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("barchart", am4charts.XYChart);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.data = [{
                    name: "Gudang",
                    datas: <?php echo json_encode($gudang); ?>
                },
                {
                    name: "Layanan",
                    datas: <?php echo json_encode($contract); ?>
                },
                {
                    name: "Kontrak",
                    datas: <?php echo json_encode($user); ?>
                },
                {
                    name: "Depo Container",
                    datas: <?php echo json_encode($service); ?>
                },
                {
                    name: "Pelanggan",
                    datas: <?php echo json_encode($gudang); ?>
                },
            ];

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.dataFields.category = "name";
            categoryAxis.renderer.minGridDistance = 40;
            categoryAxis.fontSize = 11;

            var count = JSON.parse("{{ json_encode($gudang) }}")
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            // valueAxis.max = 100;
            valueAxis.strictMinMax = true;
            valueAxis.renderer.minGridDistance = 50;
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
            series.dataFields.categoryX = "name";
            series.dataFields.valueY = "datas";
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
