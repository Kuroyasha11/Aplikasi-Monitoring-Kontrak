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

        <form action="/dashboard/contract/{{ $request->id }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="form-select">Jenis Layanan</label>
                <select name="service_id" id="service_id" class="form-select" required>
                    <option selected>Pilih Salah Satu</option>
                    @foreach ($layanan as $item)
                        @if (old('service_id', $request->service_id) == $item->id)
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
                        @checked(old('manajemen', $request->manajemen) == 0)>
                    <label class="form-check-label" for="manajemen">
                        Include Manajemen BGR
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="1" type="radio" name="manajemen" id="manajemen"
                        @checked(old('manajemen', $request->manajemen) == 1)>
                    <label class="form-check-label" for="manajemen">
                        Tidak Include Manajemen BGR
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" name="namapelanggan" class="form-control @error('namapelanggan') is-invalid @enderror"
                    id="namapelanggan" placeholder="Nama Pelanggan"
                    value="{{ old('namapelanggan', $request->namapelanggan) }}" required>
                @error('namapelanggan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="form-select">Nama (Gudang,Kantor, dan lain-lain)</label>
                <select name="warehouse_id" id="pilihan" class="form-select">
                    <option selected>Pilih Salah Satu</option>
                    @foreach ($gudang as $item)
                        @if (old('warehouse_id', $request->warehouse_id) == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                    <option>Lainnya</option>
                </select>
                <input type="text" name="namamitra" id="teks"
                    class="form-control @error('namamitra') is-invalid @enderror" id="namamitra"
                    placeholder="Nama (Gudang,Kantor, dan lain-lain)"
                    value="{{ old('namamitra', $request->namamitra) }}">
                @error('namamitra')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <hr>
            </div>
            <div class="mb-3">
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="lainnya"
                    placeholder="Nama Gudang" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Tarif Harga Sewa (Rp/M<sup>2</sup>)</label>
                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                    id="harga" value="{{ old('harga', $request->harga) }}" required>
                @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="luassewa" class="form-label">Luas Sewa / Lingkup Pekerjaan (M<sup>2</sup>) </label>
                <input type="text" name="luassewa" class="form-control @error('luassewa') is-invalid @enderror"
                    id="luassewa" value="{{ old('luassewa', $request->luassewa) }}" required>
                @error('luassewa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="peruntukan" class="form-label">Peruntukan Gudang</label>
                <input type="text" name="peruntukan" class="form-control @error('peruntukan') is-invalid @enderror"
                    id="peruntukan" value="{{ old('peruntukan', $request->peruntukan) }}">
                @error('peruntukan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 col-lg-2">
                <label for="tglmulai" class="form-label">Mulai Sewa</label>
                <input type="date" name="tglmulai" class="form-control @error('tglmulai') is-invalid @enderror"
                    id="tglmulai" value="{{ old('tglmulai', $request->tglmulai) }}">
                @error('tglmulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control  @error('keterangan') is-invalid @enderror" placeholder="Keterangan" id="keterangan"
                    name="keterangan" style="height: 100px">{{ old('keterangan', $request->keterangan) }}</textarea>
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

    <script>
        $(document).ready(function() {
            let edit = $('#service_id').find(':selected').text()

            if (edit == 'Gudang') {
                $('#pilihan').show();
            } else {
                $('#pilihan').hide();
            }
            $('#teks').hide();
            $('#lainnya').hide();
        });

        $('#service_id').change(function(e) {
            e.preventDefault();
            let data = $('#service_id').find(':selected').text()

            if (data == 'Gudang') {
                $('#pilihan').val('');
                $('#pilihan').show();
                $('#teks').val('');
                $('#teks').hide();
            } else {
                $('#pilihan').val('');
                $('#pilihan').hide();
                $('#teks').val('');
                $('#teks').show();
            }
        });

        $('#pilihan').change(function(e) {
            e.preventDefault();
            let data = $('#pilihan').find(':selected').text()

            if (data == 'Lainnya') {
                $('#lainnya').val('');
                $('#lainnya').show();
            } else {
                $('#lainnya').val('');
                $('#lainnya').hide();
            }
        });
    </script>
@endsection
