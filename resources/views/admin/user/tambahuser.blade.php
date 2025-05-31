@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Pegawai</h3>
        <hr>

        <h6>Tambah Data Pegawai</h6>
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

            <form action="{{ 'tambahdatauser' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nik">NIP / NIK</label>
                    <input type="text" name="nik" class="form-control" id="nik" aria-describedby="emailHelp"
                        value="{{ old('nik') }}">
                </div>
                <div class="mb-3 mt-3">
                    <label for="nama">Name</label>
                    <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp"
                        value="{{ old('nama') }}">
                </div>
                <div class="mb-3">
                    <label for="floatingInput">Email</label>
                    <input type="email" class="form-control" name="email" id="floatingInput"
                        placeholder="name@example.com" required>
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 mt-3">
                    <label for="floatingInput">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" aria-label="Default select example" required>
                        <option>-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
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
                    <label for="no_hp">No Hp</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" aria-describedby="emailHelp"
                        value="{{ old('no_hp') }}">
                </div>
                <div class="">
                    <label for="floatingPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password"
                        required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="floatingInput">Level</label>
                    <select name="role" class="form-select" aria-label="Default select example" required>
                        <option>-- Pilih --</option>
                        <option value="admin">Admin</option>
                        <option value="loket">Loket Pendaftaran</option>
                        <option value="dokter">Dokter</option>
                        <option value="perawat">Perawat</option>
                        <option value="apoteker">Apoteker</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection
