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
                <a href="/dashboard/storage/create" class="btn btn-success"><i class="bi bi-plus-square"></i> Tambah</a>
                {{-- {{ $storage->onEachSide(5)->links() }} --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel-biasa" class="table table-bordered table-hover">
                <thead>
                    <tr align="CENTER">
                        <th>No</th>
                        <th>NAMA GUDANG</th>
                        <th>Tarif Harga (Meter/Bulan)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($storage->count())
                        @foreach ($storage as $item)
                            <tr>
                                <td align="CENTER"><b>{{ $storage->firstItem() - 1 + $loop->iteration }}</b></th>
                                <td>{{ $item->nama }}</td>
                                <td align="RIGHT">@IDR($item->hargadasar)</td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="/dashboard/storage/{{ $item->id }}/edit" class="btn btn-warning"><i
                                                class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="/dashboard/storage/{{ $item->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-x-circle"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <p class="text-center fs-4">Tidak ada daftar gudang</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection
