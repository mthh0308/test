@extends('layout.template')

@section('container')
    <div class="container">
        <h3>Halaman Edit Data Pasien</h3>
        <hr>

        <h6>Edit Data Pasien</h6>
    </div>
    <div class="card">
        <div class="card-body">
            @foreach ($pasien as $dw)
                <form action="/aksi_edit_pasien/{{ $dw->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">No Rekam Medis</label>
                        <input type="text" name="nocm" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->nocm }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->nama_pasien }}">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                            aria-describedby="emailHelp" value="{{ old('tempat_lahir', $dw->tempat_lahir) }}">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                            value="{{ old('tgl_lahir', $dw->tgl_lahir) }}">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="floatingInput">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
                            <option>{{ old('jenis_kelamin', $dw->jenis_kelamin) }}</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="mt-3">No Hp</label>
                        <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $dw->no_hp }}">
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Edit</button>
                    <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
                </form>
            @endforeach
        </div>
    </div>
@endsection
