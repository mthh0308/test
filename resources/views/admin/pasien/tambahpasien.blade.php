@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Pasien</h3>
        <hr>

        <h6>Tambah Data Pasien</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ 'aksi_tambah_pasien' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nocm">No Rekam Medis</label>
                    <input type="hidden" name="nocm" class="form-control" id="nocm"
                        aria-describedby="emailHelp" value="{{ old('nocm') }}" autofocus>
                </div>
                <div class="mb-3 mt-3">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" id="nama_pasien"
                        aria-describedby="emailHelp" value="{{ old('nama_pasien') }}" autofocus>
                </div>
                <div class="mb-3 mt-3">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" aria-describedby="emailHelp"
                        value="{{ old('tempat_lahir') }}">
                </div>
                <div class="mb-3 mt-3">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                        value="{{ old('tgl_lahir') }}">
                </div>
                <div class="mb-3 mt-3">
                    <label for="floatingInput">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" aria-label="Default select example" required>
                        <option>-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1">No Hp</label>
                    <textarea type="text" name="no_hp" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="7" value="{{ old('no_hp') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/cancel" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('append-script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/custom1.js') }}"></script>
    <script src="{{ asset('assets/js/custom-1.js') }}"></script>
@endpush
