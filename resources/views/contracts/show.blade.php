@extends('layouts.main')

@section('container')
    {{-- Kondisi Tanggal --}}
    @php
    $today = \Carbon\Carbon::now();
    $tglstart = \Carbon\Carbon::parse($contract->tglmulai);
    $tglfrom = \Carbon\Carbon::parse($contract->tglkonfirmasi);
    $tglto = \Carbon\Carbon::parse($contract->tglakhir);
    $sebulan = \Carbon\Carbon::parse($contract->tglakhir)->addDays(30);
    $duobulan = \Carbon\Carbon::parse($contract->tglakhir)->addDays(60);
    $tigobulan = \Carbon\Carbon::parse($contract->tglakhir)->addDays(90);
    @endphp

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

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/assets/image/pelanggan.png"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $contract->author->name }}</h3>

                        <p class="text-muted text-center">{{ $contract->author->email }}</p>

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
                                    @if ($contract->warehouse_id == 1)
                                        <h6>Jenis Layanan : Gudang</h6>
                                    @elseif($contract->depo_id == 1)
                                        <h6>Jenis Layanan : Depo Container</h6>
                                    @elseif($contract->c_m_s_id == 1)
                                        <h6>Jenis Layanan : Collateral Management Service (CMS)</h6>
                                    @elseif($contract->logistic_id == 1)
                                        <h6>Jenis Layanan : Logistik</h6>
                                    @endif

                                    <!-- Manajemen -->
                                    @if ($contract->manajemen == 1)
                                        <h6>Include Manajamen BGR :Include</h6>
                                    @else
                                        <h6>Include Manajemen BGR : Tidak Include</h6>
                                    @endif

                                    <!-- Nama Gudang -->
                                    @if ($contract->warehouse_id == 1)
                                        <h6>Nama Gudang : {{ $contract->warehouse->nama }}</h6>
                                    @elseif($contract->depo_id == 1)
                                        <h6>Nama Gudang : {{ $contract->depo->nama }}</h6>
                                    @elseif($contract->c_m_s_id == 1)
                                        <h6>Nama Gudang : {{ $contract->CMS->nama }}</h6>
                                    @elseif($contract->logistic_id == 1)
                                        <h6>Nama Gudang : {{ $contract->logistic->nama }}</h6>
                                    @endif

                                    <!-- Harga -->
                                    <h6>Harga Sewa : @IDR($contract->harga) </h6>

                                    <!-- Luas Sewa -->
                                    <h6>Luas Sewa / Lingkup Pekerjaan : {{ $contract->luassewa }} (M<sup>2</sup>)</h6>

                                    <!-- Peruntukan Gudang -->
                                    @if ($contract->perutukan == null)
                                        <h6>Peruntukan Gudang : -</h6>
                                    @else
                                        <h6>Peruntukan Gudang : {{ $contract->peruntukan }}</h6>
                                    @endif

                                    <!-- Tanggal Mulai Sewa -->
                                    <h6>Tanggal Mulai Sewa :
                                        {{ \Carbon\Carbon::parse($contract->tglmulai)->isoFormat('DD MMMM Y') }}</h6>

                                    <!-- Tanggal Akhir Sewa -->
                                    <h6>Tanggal Akhir Sewa :
                                        {{ \Carbon\Carbon::parse($contract->tglakhir)->isoFormat('DD MMMM Y') }}</h6>

                                    {{-- Tanggal Kontrak Diselesaikan --}}
                                    @if ($contract->tglselesai)
                                        <h6>Tanggal Kontrak Diselesaikan :
                                            {{ \Carbon\Carbon::parse($contract->tglselesai)->isoFormat('DD MMMM Y') }}
                                        </h6>
                                    @endif

                                    <!-- Status Kontrak -->
                                    <div class="d-flex">
                                        <h6>
                                            Status Kontrak :
                                            @if ($today >= $tglstart && $today <= $tglfrom)
                                                @if ($contract->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-primary">Kontrak</a>
                                                    @php
                                                        $totalharga = 0;
                                                    @endphp
                                                @endif
                                            @elseif($today >= $tglfrom && $today <= $tglto)
                                                @if ($contract->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-warning">Masa Tenggang</a>
                                                    @php
                                                        $totalharga = 0;
                                                    @endphp
                                                @endif
                                            @elseif ($today > $tglto && $today <= $sebulan)
                                                @if ($contract->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda 1 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($contract->harga * 2)</a>
                                                    @php
                                                        $totalharga = $contract->harga * 2;
                                                    @endphp
                                                @endif
                                            @elseif ($today > $sebulan && $today <= $duobulan)
                                                @if ($contract->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda 2 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($contract->harga * 3)</a>
                                                    @php
                                                        $totalharga = $contract->harga * 3;
                                                    @endphp
                                                @endif
                                            @elseif ($today > $duobulan && $today <= $tigobulan)
                                                @if ($contract->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda 3 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($contract->harga * 4)</a>
                                                    @php
                                                        $totalharga = $contract->harga * 4;
                                                    @endphp
                                                @endif
                                            @elseif ($today > $tigobulan)
                                                @if ($contract->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda Maksimal 3 Bulan
                                                        |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($contract->harga * 4)</a>
                                                    @php
                                                        $totalharga = $contract->harga * 4;
                                                    @endphp
                                                @endif
                                            @endif
                                        </h6>
                                    </div>

                                    {{-- Total Harga --}}
                                    @if ($contract->totalharga)
                                        <h6>Total Harga : <strong>@IDR($contract->totalharga)</strong></h6>
                                    @endif
                                    <hr>
                                    {{-- Tombol Perpanjangan --}}
                                    <div class="d-flex justify-content-start">
                                        @if ($contract->selesai == 0)
                                            @if ($today >= $tglstart && $today <= $tglfrom)
                                                @if ($contract->selesai == 1)
                                                @else
                                                @endif
                                            @elseif($today >= $tglfrom && $today <= $tglto)
                                                @if ($contract->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $contract->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $tglto && $today <= $sebulan)
                                                @if ($contract->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $contract->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $sebulan && $today <= $duobulan)
                                                @if ($contract->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $contract->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $duobulan && $today <= $tigobulan)
                                                @if ($contract->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $contract->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $tigobulan)
                                                @if ($contract->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $contract->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @endif
                                            <form action="/dashboard/contract/selesai/{{ $contract->id }}" method="post">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" value="{{ $today }}" name="tglselesai">
                                                <input type="hidden" value="1" name="selesai">

                                                <input type="hidden" value="{{ $totalharga }}" name="totalharga">

                                                <button class="btn btn-success mx-2"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi"></i> Selesai
                                                </button>
                                            </form>
                                        @endif
                                        <form action="/dashboard/contract/{{ $contract->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger mx-2" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-x-circle"></i> Delete
                                            </button>
                                        </form>
                                    </div>
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
        </div>
    </div>

    <!-- Modal EDIT-->
    <div class="modal fade" id="edit{{ $contract->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Kontrak
                        {{ $contract->namapelanggan }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/contract/{{ $contract->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="mb-3 col-lg-5">
                            <label for="tglakhir" class="form-label">Perpanjang Sewa</label>
                            <input type="date" name="tglakhir"
                                class="form-control @error('tglakhir') is-invalid @enderror" id="tglakhir"
                                value="{{ old('tglakhir', $contract->tglakhir) }}">
                            @error('tglakhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
                                cols="30" rows="10">{{ old('keterangan', $contract->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i>
                        Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
