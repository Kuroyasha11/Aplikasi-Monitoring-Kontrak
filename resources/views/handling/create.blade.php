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


        <form action="/dashboard/handling" method="post">
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
            <select name="hargadasar" class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="10000">@IDR(10000)</option>
                <option value="20000">@IDR(20000)</option>
                <option value="0">Lainnya</option>
            </select>
            <div class="form-group">
                <label for="lainnya">Tarif Harga</label>
                <input type="number" id="lainnya" name="lainnya"
                    class="form-control @error('lainnya') is-invalid @enderror" value="{{ old('lainnya') }}" required>
                @error('hargadasar')
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
            <div class="d-flex">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Buat</button>
                <a href="/dashboard/handling" class="btn btn-warning"><i class="bi bi-arrow-left"></i>
                    Kembali</a>
            </div>
        </form>
    </div>
@endsection
