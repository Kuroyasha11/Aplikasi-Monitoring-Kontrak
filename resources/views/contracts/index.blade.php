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
            <div class="d-flex justify-content-between">
                <a href="/dashboard/contract/create" class="btn btn-success"><i class="bi bi-plus-square"></i> Tambah</a>
                {{-- {{ $storage->onEachSide(5)->links() }} --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-biasa" class="table table-bordered table-hover">
                    <thead>
                        <tr align="CENTER">
                            <th>No</th>
                            <th>Layanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama (Gudang, Kantor, dan lain-lain)</th>
                            <th>Mulai Sewa</th>
                            <th>Akhir Sewa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contract->count())
                            @foreach ($contract as $item)
                                <tr>
                                    <td align="CENTER"><b>{{ $contract->firstItem() - 1 + $loop->iteration }}</b></th>
                                    <td>{{ $item->service->nama }}</td>
                                    <td>{{ $item->author->name }}</td>
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

                                    <td>
                                        {{-- {{ $item->keterangan }} --}}
                                        @php
                                            // $tanggal = $item->tglakhir;
                                            // $date = new DateTime($tanggal);
                                            // $date_minus = $date->modify('+13 days')->format('Y-m-d');
                                            // $tgldenda = \Carbon\Carbon::parse($item->tglakhir);
                                            // $tglhariini = \Carbon\Carbon::now();
                                            $today = \Carbon\Carbon::now();
                                            $tglstart = \Carbon\Carbon::parse($item->tglmulai);
                                            $tglfrom = \Carbon\Carbon::parse($item->tglkonfirmasi);
                                            $tglto = \Carbon\Carbon::parse($item->tglakhir);
                                        @endphp

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
                                        @elseif ($today > $tglto && $today <= $tglto->addDays(30))
                                            @if ($item->selesai == 1)
                                                <a href="#" class="btn btn-success">Selesai</a>
                                            @else
                                                <div class="d-grid">
                                                    <a href="#" class="btn btn-danger">Denda 1 Bulan</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 2)</a>
                                                </div>
                                            @endif
                                        @elseif ($today > $tglto->addDays(30) && $today <= $tglto->addDays(60))
                                            @if ($item->selesai == 1)
                                                <a href="#" class="btn btn-success">Selesai</a>
                                            @else
                                                <div class="d-grid">
                                                    <a href="#" class="btn btn-danger">Denda 2 Bulan</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 3)</a>
                                                </div>
                                            @endif
                                        @elseif ($today > $tglto->addDays(60) && $today <= $tglto->addDays(90))
                                            @if ($item->selesai == 1)
                                                <a href="#" class="btn btn-success">Selesai</a>
                                            @else
                                                <div class="d-grid">
                                                    <a href="#" class="btn btn-danger">Denda 3 Bulan</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 4)</a>
                                                </div>
                                            @endif
                                        @elseif ($today > $tglto->addDays(90))
                                            @if ($item->selesai == 1)
                                                <a href="#" class="btn btn-success">Selesai</a>
                                            @else
                                                <div class="d-grid">
                                                    <a href="#" class="btn btn-danger">Denda Maksimal 3 Bulan</a>
                                                    <a href="#" class="btn btn-success mt-2">@IDR($item->harga * 4)</a>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
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
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $tglto && $today <= $tglto->addDays(30))
                                                @if ($item->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $tglto->addDays(30) && $today <= $tglto->addDays(60))
                                                @if ($item->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $tglto->addDays(60) && $today <= $tglto->addDays(90))
                                                @if ($item->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                        <i class="bi bi-pencil-square"></i> Perpanjang
                                                    </button>
                                                @endif
                                            @elseif ($today > $tglto->addDays(90))
                                                @if ($item->selesai == 1)
                                                @else
                                                    <!-- Button trigger modal edit-->
                                                    <button type="button" class="btn btn-warning mx-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
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

    <div class="toast-container position-static">
        <div class="toast-container top-0 end-0 p-3">
            @foreach ($notif as $item)
                <input type="hidden" id="toastbtn{{ $item->id }}" value="{{ $item->id }}">
                @php
                    $today = \Carbon\Carbon::now();
                    $tglfrom = \Carbon\Carbon::parse($item->tglkonfirmasi);
                    $tglto = \Carbon\Carbon::parse($item->tglakhir);
                @endphp

                @if ($today >= $tglfrom && $today <= $tglto)
                    <div id="toast{{ $item->id }}" class="toast text-bg-danger" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Pemberitahuan Kontrak {{ $item->author->name }}</strong>
                            <small class="text-muted"></small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Kontrak akan habis dalam {{ \Carbon\Carbon::parse($item->tglakhir)->diffForHumans() }}
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
            @endforeach
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $('.toastsDefaultInfo').show(function() {
                $(document).Toasts('create', {
                    class: 'bg-info',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
        });
    </script> --}}

    {{-- <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $('.toastsDefaultInfo').show(function() {
                $(document).Toasts('create', {
                    class: 'bg-info',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
        });
    </script> --}}
@endsection
