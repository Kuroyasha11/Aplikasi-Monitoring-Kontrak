@extends('layouts.main')

@section('container')
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

        <div class="card-header">
            @if (Request::is('dashboard/contract'))
                <div class="d-flex justify-content-start">
                    <a href="/dashboard/contract/create" class="btn btn-success"><i class="bi bi-plus-square"></i> Tambah</a>
                    {{-- {{ $storage->onEachSide(5)->links() }} --}}
                    <a href="/dashboard/contract/print" class="btn btn-danger mx-2"><i class="bi bi-printer-fill"></i>
                        Print</a>
                </div>
            @else
                <div class="d-flex justify-content-end">
                    <a href="/dashboard/contract" class="btn btn-success my-3"><i class="bi bi-arrow-90deg-left"></i>
                        Kembali</a>
                </div>
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="{{ Request::is('dashboard/contract') ? 'tabel-biasa' : 'tabel-print' }}"
                    class="table table-bordered table-hover">
                    <thead>
                        <tr align="CENTER">
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Nama</th>
                            <th>Mulai Sewa</th>
                            <th>Akhir Sewa</th>
                            <th>Status</th>
                            @if (Request::is('dashboard/contract'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contract->count())
                            @foreach ($contract as $item)
                                <tr>
                                    <td align="CENTER"><b>{{ $contract->firstItem() - 1 + $loop->iteration }}</b></th>
                                    <td>{{ $item->author->name }}</td>
                                    <td>{{ $item->service->nama }}</td>
                                    <td>
                                        @if ($item->warehouse_id && !$item->depo_id && !$item->c_m_s_id && !$item->logistic_id)
                                            {{ $item->warehouse->nama }}
                                        @elseif(!$item->warehouse_id && $item->depo_id && !$item->c_m_s_id && !$item->logistic_id)
                                            {{ $item->depo->nama }}
                                        @elseif(!$item->warehouse_id && !$item->depo_id && $item->c_m_s_id && !$item->logistic_id)
                                            {{ $item->CMS->nama }}
                                        @elseif(!$item->warehouse_id && !$item->depo_id && !$item->c_m_s_id && $item->logistic_id)
                                            {{ $item->logistic->nama }}
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->tglmulai)->isoFormat('DD MMMM Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tglakhir)->isoFormat('DD MMMM Y') }}</td>

                                    <td align="CENTER">
                                        @php
                                            $today = \Carbon\Carbon::now();
                                            $tglstart = \Carbon\Carbon::parse($item->tglmulai);
                                            $tglfrom = \Carbon\Carbon::parse($item->tglkonfirmasi);
                                            $tglto = \Carbon\Carbon::parse($item->tglakhir);
                                            $sebulan = \Carbon\Carbon::parse($item->tglakhir)->addDays(30);
                                            $duobulan = \Carbon\Carbon::parse($item->tglakhir)->addDays(60);
                                            $tigobulan = \Carbon\Carbon::parse($item->tglakhir)->addDays(90);
                                        @endphp

                                        <div class="d-grid">
                                            @if ($today >= $tglstart && $today <= $tglfrom)
                                                @if ($item->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-primary">Kontrak</a>
                                                @endif
                                            @elseif($today >= $tglfrom && $today <= $tglto)
                                                @if ($item->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-warning">Masa Tenggang</a>
                                                @endif
                                            @elseif ($today > $tglto && $today <= $sebulan)
                                                @if ($item->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda 1 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 2)</a>
                                                @endif
                                            @elseif ($today > $sebulan && $today <= $duobulan)
                                                @if ($item->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda 2 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 3)</a>
                                                @endif
                                            @elseif ($today > $duobulan && $today <= $tigobulan)
                                                @if ($item->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda 3 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 4)</a>
                                                @endif
                                            @elseif ($today > $tigobulan)
                                                @if ($item->selesai == 1)
                                                    <a href="#" class="btn btn-success">Selesai</a>
                                                @else
                                                    <a href="#" class="btn btn-danger">| Denda Maksimal 3 Bulan |</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 4)</a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    @if (Request::is('dashboard/contract'))
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                @if ($today >= $tglstart && $today <= $tglfrom)
                                                    @if ($item->selesai == 1)
                                                    @else
                                                    @endif
                                                @elseif($today >= $tglfrom && $today <= $tglto)
                                                    @if ($item->selesai == 1)
                                                    @else
                                                        <!-- Button trigger modal edit-->
                                                        <button type="button" class="btn btn-warning mx-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i> Perpanjang
                                                        </button>
                                                    @endif
                                                @elseif ($today > $tglto && $today <= $sebulan)
                                                    @if ($item->selesai == 1)
                                                    @else
                                                        <!-- Button trigger modal edit-->
                                                        <button type="button" class="btn btn-warning mx-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i> Perpanjang
                                                        </button>
                                                    @endif
                                                @elseif ($today > $sebulan && $today <= $duobulan)
                                                    @if ($item->selesai == 1)
                                                    @else
                                                        <!-- Button trigger modal edit-->
                                                        <button type="button" class="btn btn-warning mx-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i> Perpanjang
                                                        </button>
                                                    @endif
                                                @elseif ($today > $duobulan && $today <= $tigobulan)
                                                    @if ($item->selesai == 1)
                                                    @else
                                                        <!-- Button trigger modal edit-->
                                                        <button type="button" class="btn btn-warning mx-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i> Perpanjang
                                                        </button>
                                                    @endif
                                                @elseif ($today > $tigobulan)
                                                    @if ($item->selesai == 1)
                                                    @else
                                                        <!-- Button trigger modal edit-->
                                                        <button type="button" class="btn btn-warning mx-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i> Perpanjang
                                                        </button>
                                                    @endif
                                                @endif
                                                <form action="/dashboard/contract/{{ $item->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger m-1"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="bi bi-x-circle"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>

                                <!-- Modal EDIT-->
                                <div class="modal fade" id="edit{{ $item->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Ubah Kontrak
                                                    {{ $item->namapelanggan }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/dashboard/contract/{{ $item->id }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="mb-3 col-lg-5">
                                                        <label for="tglakhir" class="form-label">Perpanjang Sewa</label>
                                                        <input type="date" name="tglakhir"
                                                            class="form-control @error('tglakhir') is-invalid @enderror"
                                                            id="tglakhir"
                                                            value="{{ old('tglakhir', $item->tglakhir) }}">
                                                        @error('tglakhir')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
                                                            cols="30" rows="10">{{ old('keterangan', $item->keterangan) }}</textarea>
                                                        @error('keterangan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-check-lg"></i>
                                                    Ubah</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- NOTIF --}}
                                <div class="toast-container position-static">
                                    <div class="toast-container top-0 end-0 p-3">

                                        <input type="hidden" id="toastbtn{{ $item->id }}"
                                            value="{{ $item->id }}">

                                        @if ($today >= $tglfrom && $today <= $tglto)
                                            @if ($item->selesai == 1)
                                            @else
                                                <div id="toast{{ $item->id }}" class="toast text-bg-danger"
                                                    role="alert" aria-live="assertive" aria-atomic="true">
                                                    <div class="toast-header">
                                                        <strong class="me-auto">Pemberitahuan Kontrak
                                                            {{ $item->author->name }}</strong>
                                                        <small class="text-muted"></small>
                                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="toast-body">
                                                        Kontrak akan habis dalam
                                                        {{ \Carbon\Carbon::parse($item->tglakhir)->diffForHumans() }}
                                                    </div>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {

                                                        const toastLiveExample = document.getElementById('toast{{ $item->id }}')


                                                        let toastbtn{{ $item->id }} = $('#toastbtn{{ $item->id }}').val()

                                                        if (toastbtn{{ $item->id }} == {{ $item->id }}) {
                                                            const toast = new bootstrap.Toast(toastLiveExample)

                                                            toast.show()
                                                        }

                                                    });
                                                </script>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <p class="text-center fs-4">Tidak ada daftar kontrak</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
