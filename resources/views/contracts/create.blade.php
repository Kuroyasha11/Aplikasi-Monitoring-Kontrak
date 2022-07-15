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
            <div class="form-group">
                <label for="layanan">Jenis Layanan</label>
                <select name="jenislayanan" id="layanan" class="form-control select" required>
                    <option value="">Pilih Salah Satu</option>
                    <option value="Warehouse">Warehouse</option>
                    <option value="Depo Container">Depo Container</option>
                    <option value="Collateral Management Services (CMS)">Collateral Management Services (CMS)</option>
                    <option value="Project Logistics">Project Logistics</option>
                    <option>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <textarea name="jenislayanan" class="form-control" rows="3" placeholder="Lainnya..." id="lainnya"></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="manajemen" id="flexRadioDefault1" value="Include">
                <label class="form-check-label" for="flexRadioDefault1">
                    Include Manajemen BGR
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="manajemen" id="flexRadioDefault2"
                    value="Tidak Include">
                <label class="form-check-label" for="flexRadioDefault2">
                    Tidak Include Manajemen BGR
                </label>
            </div>
            <br>
            <div class="form-group">
                <label for="namagudang">Nama Gudang</label>
                <input type="text" id="namagudang" name="namagudang"
                    class="form-control @error('namagudang') is-invalid @enderror" value="{{ old('namagudang') }}"
                    required>
                @error('namagudang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="namapelanggan">Nama Pelanggan</label>
                <input type="text" id="namapelanggan" name="namapelanggan"
                    class="form-control @error('namapelanggan') is-invalid @enderror" value="{{ old('namapelanggan') }}"
                    required>
                @error('namapelanggan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga">Tarif Harga Sewa (Rp/M<sup>2</sup>)</label>
                <input type="number" id="harga" name="harga"
                    class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="luassewa">Luas Sewa / Lingkup Pekerjaan (M<sup>2</sup>) </label>
                <input type="text" id="luassewa" name="luassewa"
                    class="form-control @error('luassewa') is-invalid @enderror" value="{{ old('luassewa') }}" required>
                @error('luassewa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="peruntukan">Peruntukan Gudang</label>
                <input type="text" id="peruntukan" name="peruntukan"
                    class="form-control @error('peruntukan') is-invalid @enderror" value="{{ old('peruntukan') }}"
                    required>
                @error('peruntukan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="tglmulai">Tanggal Mulai Sewa</label>
                <input type="date" id="tglmulai" name="tglmulai"
                    class="form-control @error('tglmulai') is-invalid @enderror" value="{{ old('tglmulai') }}" required>
                @error('tglmulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Keterangan</label>
                <textarea class="form-control  @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}"
                    placeholder="Keterangan" id="keterangan" name="keterangan" style="height: 100px"></textarea>
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
            $('#lainnya').hide();
        });

        $('#layanan').change(function(e) {
            e.preventDefault();
            let data = $('#layanan').find(':selected').text()

            if (data == 'Lainnya') {
                $('#lainnya').show();
                $('#lainnya').attr('name', 'jenislayanan');
                $('#layanan').removeAttr('name');
            } else {
                $('#lainnya').removeAttr('name');
                $('#lainnya').val('');
                $('#lainnya').hide();
                $('#layanan').attr('name', 'jenislayanan');
            }
        });
    </script>
@endsection
