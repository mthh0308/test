@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Edit Data Obat</h3>
        <hr>

        <h6>Edit Data Obat</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @foreach ($obat as $dp)
                <form action="/aksi_edit_obat/{{ $dp->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dp->nama_obat }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Satuan</label>
                        <input type="text" name="satuan" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dp->satuan }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Harga Beli</label>
                        <textarea type="text" name="harga_beli" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" rows="7">{{ $dp->harga_beli }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Harga Jual</label>
                        <input type="text" name="harga_jual" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dp->harga_jual }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Stok</label>
                        <input type="text" name="stok" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dp->stok }}">
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Edit</button>
                    <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
                </form>
            @endforeach
        </div>
    </div>
@endsection
