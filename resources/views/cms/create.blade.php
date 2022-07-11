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


        <form action="/dashboard/collateral-management-services" method="post">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}" autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="hargadasar">Tarif Harga</label>
                <input type="number" id="hargadasar" name="hargadasar"
                    class="form-control @error('hargadasar') is-invalid @enderror" value="{{ old('hargadasar') }}"
                    required>
                @error('hargadasar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Buat</button>
                <a href="/dashboard/collateral-management-services" class="btn btn-warning"><i class="bi bi-arrow-left"></i>
                    Kembali</a>
            </div>
        </form>
    </div>
@endsection
