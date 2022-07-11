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


        <form action="/dashboard/depo-container/{{ $depo->id }}" method="post">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $depo->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="hargadasar">Tarif Harga(Rp/M2)</label>
                <input type="number" id="hargadasar" name="hargadasar"
                    class="form-control @error('hargadasar') is-invalid @enderror"
                    value="{{ old('hargadasar', $depo->hargadasar) }}" required>
                @error('hargadasar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Keterangan</label>
                <textarea class="form-control  @error('keterangan') is-invalid @enderror"
                    value="{{ old('keterangan', $depo->keterangan) }}" placeholder="Keterangan" id="keterangan" name="keterangan"
                    style="height: 100px"></textarea>
                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Ubah</button>
                <a href="/dashboard/depo-container" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
@endsection
