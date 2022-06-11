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
        <p>
            DUIT KU HANYA @IDR(0), AKU MISKIN!!
        </p>
        <p>
            DUIT KU HANYA @IDR(100000), AKU MISKIN!!
        </p>
        <p>
            DUIT KU HANYA @IDR(10000000), AKU MISKIN!!
        </p>
    </div>
@endsection
