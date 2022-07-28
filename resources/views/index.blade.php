@extends('layouts.main')

@section('container')
    @can('admin')
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
                        name: "Depo Container",
                        datas: <?php echo json_encode($depo); ?>
                    },
                    {
                        name: "Collateral Management Service",
                        datas: <?php echo json_encode($cms); ?>
                    },
                    {
                        name: "Logistic",
                        datas: <?php echo json_encode($logistic); ?>
                    },
                    {
                        name: "Kontrak",
                        datas: <?php echo json_encode($contract); ?>
                    },
                    {
                        name: "Pelanggan",
                        datas: <?php echo json_encode($user); ?>
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
    @else
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/assets/image/pelanggan.png"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $datacontract->author->name }}</h3>

                        <p class="text-muted text-center">{{ $datacontract->author->email }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Pelanggan PT BGR Palembang</b>
                            </li>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <h5> Data Kontrak
                                    Pelanggan</h5>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <!-- /.user-block -->
                                    <!-- Jenis Layanan -->
                                    @if ($datacontract->warehouse_id == 1)
                                        <h6>Jenis Layanan : Gudang</h6>
                                    @elseif($datacontract->depo_id == 1)
                                        <h6>Jenis Layanan : Depo Container</h6>
                                    @elseif($datacontract->c_m_s_id == 1)
                                        <h6>Jenis Layanan : Collateral Management Service (CMS)</h6>
                                    @elseif($datacontract->logistic_id == 1)
                                        <h6>Jenis Layanan : Logistik</h6>
                                    @endif

                                    <!-- Manajemen -->
                                    @if ($datacontract->manajemen == 1)
                                        <h6>Include Manajamen BGR :Include</h6>
                                    @else
                                        <h6>Include Manajemen BGR : Tidak Include</h6>
                                    @endif

                                    <!-- Nama Gudang -->
                                    @if ($datacontract->warehouse_id == 1)
                                        <h6>Nama Gudang : {{ $datacontract->warehouse->nama }}</h6>
                                    @elseif($datacontract->depo_id == 1)
                                        <h6>Nama Gudang : {{ $datacontract->depo->nama }}</h6>
                                    @elseif($datacontract->c_m_s_id == 1)
                                        <h6>Nama Gudang : {{ $datacontract->CMS->nama }}</h6>
                                    @elseif($datacontract->logistic_id == 1)
                                        <h6>Nama Gudang : {{ $datacontract->logistic->nama }}</h6>
                                    @endif

                                    <!-- Harga -->
                                    <h6>Harga Sewa : @IDR($datacontract->harga) </h6>

                                    <!-- Luas Sewa -->
                                    <h6>Luas Sewa / Lingkup Pekerjaan : {{ $datacontract->luassewa }} (M<sup>2</sup>)</h6>

                                    <!-- Peruntukan Gudang -->
                                    @if ($datacontract->perutukan == null)
                                        <h6>Peruntukan Gudang : -</h6>
                                    @else
                                        <h6>Peruntukan Gudang : {{ $datacontract->peruntukan }}</h6>
                                    @endif

                                    <!-- Tanggal Mulai Sewa -->
                                    <h6>Tanggal Mulai Sewa :
                                        {{ \Carbon\Carbon::parse($datacontract->tglmulai)->isoFormat('DD MMMM Y') }}</h6>

                                    <!-- Tanggal Selesai Sewa -->
                                    <h6>Tanggal Selesai Sewa :
                                        {{ \Carbon\Carbon::parse($datacontract->tglakhir)->isoFormat('DD MMMM Y') }}</h6>

                                    <!-- Status Kontrak -->
                                    @php
                                        $today = \Carbon\Carbon::now();
                                        $tglstart = \Carbon\Carbon::parse($datacontract->tglmulai);
                                        $tglfrom = \Carbon\Carbon::parse($datacontract->tglkonfirmasi);
                                        $tglto = \Carbon\Carbon::parse($datacontract->tglakhir);
                                    @endphp

                                    @if ($today >= $tglstart && $today <= $tglfrom)
                                        <h6>Status Kontrak : <a href="#" class="btn btn-primary">Kontrak</a> </h6>
                                    @elseif($today >= $tglfrom && $today <= $tglto)
                                        <h6>Status Kontrak : <a href="#" class="btn btn-warning">Masa Tenggang</a></h6>
                                    @elseif ($today > $tglto && $today <= $tglto->addDays(30))
                                        <div class="d-grid">
                                            <h6>Status Kontrak : <a href="#" class="btn btn-danger">Denda 1 Bulan</a>
                                            </h6>
                                            <h6>Denda : <a href="#" class="btn btn-success mt-2">@IDR($datacontract->harga * 2)</a>
                                            </h6>
                                        </div>
                                    @elseif ($today > $tglto->addDays(30) && $today <= $tglto->addDays(60))
                                        <div class="d-grid">
                                            <h6>Status Kontrak : <a href="#" class="btn btn-danger">Denda 2 Bulan</a>
                                            </h6>
                                            <h6>Denda : <a href="#" class="btn btn-success mt-2">@IDR($datacontract->harga * 3)</a>
                                            </h6>
                                        </div>
                                    @elseif ($today > $tglto->addDays(60) && $today <= $tglto->addDays(90))
                                        <div class="d-grid">
                                            <h6>Status Kontrak : <a href="#" class="btn btn-danger">Denda 3 Bulan</a>
                                            </h6>
                                            <h6>Denda : <a href="#" class="btn btn-success mt-2">@IDR($datacontract->harga * 4)</a>
                                            </h6>
                                        </div>
                                    @elseif ($datacontract->selesai = true)
                                        <h6>Status Kontrak : <a href="" class="btn btn-success">Selesai</a></h6>
                                    @endif
                                    <hr>
                                    <p>
                                        *Untuk perpanjangan atau perubahan kontrak silahkan hubungi admin.
                                    </p>
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        @endcan
    @endsection
