@extends('layout.template')

@section('container')
    <div class="container">
        <h4>Halaman Pemeriksaan Perawat</h4>
    </div>
    @foreach ($pasien as $dr)
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="nocm" class="form-label mt-2"><b>Data Pasien</b></label>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nocm" class="form-label">No Rekam Medis</label>
                    <input type="text" name="nocm" class="form-control" id="nocm" value="{{ $dr->nocm }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" id="nama_pasien" value="{{ $dr->nama_pasien }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ $dr->tempat_lahir }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" value="{{ $dr->tgl_lahir }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="no_hp" class="form-label">No Hp</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $dr->no_hp }}" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('aksi_input_vitalsign/' . $dr->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <label for="nocm" class="form-label mt-2"><b>Vital Sign</b></label>
                    </div>
                    <input type="hidden" name="id_pasien" value="{{ $dr->id }}">
                    <div class="col-md-3">
                        <label for="tgl_periksa">Tanggal Periksa</label>
                        <input type="datetime-local" name="tglperiksa" class="form-control" id="tglperiksa"
                            value="{{ old('tglperiksa') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputEmail1">Berat Badan</label>
                        <input type="text" name="beratbadan" class="form-control" id="beratbadan"
                            aria-describedby="emailHelp" value="{{ old('beratbadan') }}" autofocus>
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputEmail1">Tinggi Badan</label>
                        <input type="text" name="tinggibadan" class="form-control" id="tinggibadan" aria-describedby="emailHelp" value="{{ old('tinggibadan') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputEmail1">Tekanan Darah</label>
                        <input type="text" name="tekanandarah" class="form-control" id="tekanandarah"
                            aria-describedby="emailHelp" value="{{ old('tekanandarah') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputEmail1">Suhu</label>
                        <input type="text" name="suhu" class="form-control" id="suhu"
                            aria-describedby="emailHelp" value="{{ old('suhu') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputEmail1">Nadi</label>
                        <input type="text" name="nadi" class="form-control" id="nadi"
                            aria-describedby="emailHelp" value="{{ old('nadi') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="exampleInputEmail1">Pernafasan</label>
                        <input type="text" name="pernafasan" class="form-control" id="pernafasan"
                            aria-describedby="emailHelp" value="{{ old('pernafasan') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
        @endforeach
    </div>
@endsection
