@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Tambah Data Obat</h3>
        <hr>

        <h6>Tambah Data Obat</h6>
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

            <form action="{{ 'aksi_tambah_obat' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control" id="nama_obat"
                        aria-describedby="emailHelp" value="{{ old('nama_obat') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('satuan') }}">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1">Harga Beli</label>
                    <input type="text" name="harga_beli" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('harga_beli') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Harga Jual</label>
                    <input type="text" name="harga_jual" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('harga_jual') }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Stok</label>
                    <input type="text" name="stok" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ old('stok') }}">
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batall" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
    </div>
@endsection
