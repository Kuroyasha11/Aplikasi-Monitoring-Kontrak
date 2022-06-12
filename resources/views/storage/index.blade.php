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

        <table class="table table-responsive table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NAMA GUDANG</th>
                    <th scope="col">Tarif / Luas Meter</th>
                </tr>
            </thead>
            <tbody>
                @if ($storage->count())
                    @foreach ($storage as $item)
                        <tr>
                            <th scope="row" align="CENTER">{{ $storage->firstItem() - 1 + $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td align="RIGHT">{{ $item->hargadasar }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">
                            <p class="text-center fs-4">Tidak ada Paket</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
