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
            <table id="tabel-biasa" class="table table-bordered table-hover">
                <thead>
                    <tr align="CENTER">
                        <th>No</th>
                        <th>Layanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama (Gudang, Kantor, dan lain-lain)</th>
                        <th>Mulai Sewa</th>
                        <th>Akhir Sewa</th>
                        <th>Keterangan</th>
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
                                        $tanggal = $item->tglakhir;
                                        $date = new DateTime($tanggal);
                                        $date_minus = $date->modify('+13 days')->format('Y-m-d');
                                        $tgldenda = \Carbon\Carbon::parse($item->tglakhir);
                                        $tglhariini = \Carbon\Carbon::now();
                                    @endphp

                                    @if ($tglhariini >= $tgldenda->addDays(13))
                                        @if ($tglhariini >= $tgldenda->addDays(30))
                                            @if ($tglhariini >= $tgldenda->addDays(60))
                                                @if ($tglhariini >= $tgldenda->addDays(90))
                                                    <a href="#" class="btn btn-danger">Lewat 90</a>
                                                @else
                                                    <a href="#" class="btn btn-danger" id="toast">Lewat 60</a>
                                                @endif
                                            @else
                                                <a href="{{ url('/send-mail') }}" class="btn btn-danger">Lewat 30</a>
                                            @endif
                                        @else
                                            <a href="#" class="btn btn-danger" id="toast">Lewat
                                                13</a>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-primary">Belum</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/dashboard/contract/{{ $item->id }}/edit"
                                            class="btn btn-warning m-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="/dashboard/contract/{{ $item->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger m-1" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-x-circle"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="toast-container position-static">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted">just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                See? Just like this.
            </div>
        </div>
    </div>
    {{-- <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast1" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div> --}}

    <script>
        $(document).ready(function() {

            const toastLiveExample = document.getElementById('liveToast')


            let toast = $('#toast').show()

            if (toast) {
                const toast = new bootstrap.Toast(toastLiveExample)

                toast.show()
            }

        });
    </script>

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
