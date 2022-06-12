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

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </thead>
            <tbody>
                ...
            </tbody>
        </table>
    </div>
@endsection
