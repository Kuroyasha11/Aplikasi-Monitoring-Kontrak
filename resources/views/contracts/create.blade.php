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

        <form action="/dashboard/contract" method="post">
            @csrf
            <div class="mb-3">
                <label for="form-select">Jenis Layanan</label>
                <select name="service_id" id="service_id" class="form-select" required>
                    @foreach ($layanan as $item)
                        @if (old('service_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="d-flex mb-3">
                <div class="form-check mx-2">
                    <input class="form-check-input" value="0" type="radio" name="manajemen" id="manajemen"
                        @checked(old('manajemen') == 0)>
                    <label class="form-check-label" for="manajemen">
                        Include Manajemen BGR
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="1" type="radio" name="manajemen" id="manajemen"
                        @checked(old('manajemen') == 1)>
                    <label class="form-check-label" for="manajemen">
                        Tidak Include Manajemen BGR
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Pelanggan</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="Nama Pelanggan" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Pelanggan</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" placeholder="Email Pelanggan" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="form-select">Nama</label>
                <select name="warehouse_id" id="warehouse_id" class="form-select">
                    @foreach ($gudang as $item)
                        @if (old('warehouse_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                    <option>Lainnya</option>
                </select>
                <select name="depo_id" id="depo_id" class="form-select">
                    @foreach ($depo as $item)
                        @if (old('depo_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                    <option>Lainnya</option>
                </select>
                <select name="c_m_s_id" id="c_m_s_id" class="form-select">
                    @foreach ($cms as $item)
                        @if (old('c_m_s_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                    <option>Lainnya</option>
                </select>
                <select name="logistic_id" id="logistic_id" class="form-select">
                    @foreach ($logistic as $item)
                        @if (old('logistic_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                    <option>Lainnya</option>
                </select>
                <hr>
            </div>
            <div class="mb-3">
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="lainnya"
                    placeholder="Lainnya" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Tarif Harga Sewa (Rp/M<sup>2</sup>)</label>
                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                    id="harga" value="{{ old('harga') }}" placeholder="Tarif Harga Sewa" required>
                @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="luassewa" class="form-label">Luas Sewa / Lingkup Pekerjaan (M<sup>2</sup>) </label>
                <input type="text" name="luassewa" class="form-control @error('luassewa') is-invalid @enderror"
                    id="luassewa" value="{{ old('luassewa') }}" placeholder="Luas Sewa / Lingkup Pekerjaan" required>
                @error('luassewa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="peruntukan" class="form-label">Peruntukan Gudang</label>
                <input type="text" name="peruntukan" class="form-control @error('peruntukan') is-invalid @enderror"
                    id="peruntukan" placeholder="Peruntukan Gudang" value="{{ old('peruntukan') }}">
                @error('peruntukan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 col-lg-2">
                <label for="tglmulai" class="form-label">Mulai Sewa</label>
                <input type="date" name="tglmulai" class="form-control @error('tglmulai') is-invalid @enderror"
                    id="tglmulai" value="{{ old('tglmulai') }}">
                @error('tglmulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 col-lg-2">
                <label for="tglakhir" class="form-label">Selesai Sewa</label>
                <input type="date" name="tglakhir" class="form-control @error('tglakhir') is-invalid @enderror"
                    id="tglakhir" value="{{ old('tglakhir') }}">
                @error('tglakhir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control  @error('keterangan') is-invalid @enderror" placeholder="Keterangan" id="keterangan"
                    name="keterangan" style="height: 100px">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Buat</button>
                <a href="/dashboard/contract" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>

    <script src="/javascript/contract-create.js"></script>
@endsection
