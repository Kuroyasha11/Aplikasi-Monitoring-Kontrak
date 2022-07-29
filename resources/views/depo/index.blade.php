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
                <!-- Button trigger modal create-->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="bi bi-plus-square"></i> Tambah
                </button>
                {{-- {{ $request->onEachSide(5)->links() }} --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel-biasa" class="table table-bordered table-hover">
                <thead>
                    <tr align="CENTER">
                        <th>No</th>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($request->count())
                        @foreach ($request as $item)
                            <tr>
                                <td align="CENTER"><b>{{ $request->firstItem() - 1 + $loop->iteration }}</b></th>
                                <td>{{ $item->nama }}</td>
                                <td align="CENTER">
                                    @if ($item->aktif == 1)
                                        <span class="badge rounded-pill text-bg-success">Tersedia</span>
                                    @elseif ($item->aktif == 0)
                                        <span class="badge rounded-pill text-bg-primary">Disewakan</span>
                                    @endif
                                </td>
                                <td>{{ $item->Keterangan }}</td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <!-- Button trigger modal edit-->
                                        <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $item->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <form action="/dashboard/depo/{{ $item->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
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
                                            <h5 class="modal-title" id="staticBackdropLabel">Ubah {{ $item->nama }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/dashboard/depo/{{ $item->id }}" method="post">
                                                @method('put')
                                                @csrf
                                                {{-- <div class="form-group">
                                                    <label for="aktif">Status</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            id="aktif" name="aktif" @checked(old('aktif', $item->aktif) == 1)>
                                                        <label class="form-check-label" for="aktif">
                                                            Aktif
                                                        </label>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" id="nama" name="nama"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        value="{{ old('nama', $item->nama) }}" autofocus required>
                                                    @error('nama')
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
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i>
                                                Ubah</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <p class="text-center fs-4">Tidak ada daftar {{ $title }}</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    {{-- Modal CREATE --}}
    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/depo" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                autofocus required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
                                cols="30" rows="10" value="{{ old('keterangan') }}"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
