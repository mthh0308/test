@extends('layout.template')

@section('container')
    <div class="container">
        <h4>Halaman Pemeriksaan Dokter</h4>
    </div>
    
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                @foreach ($pasien as $dr)
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
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="nocm" class="form-label mt-2"><b>Vital Sign</b></label>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tglperiksa" class="form-label">Tanggal diperiksa Perawat</label>
                    <input type="text" name="tglperiksa" class="form-control" id="tglperiksa" value="{{ $dr->tglperiksa }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beratbadan" class="form-label">Berat Badan</label>
                    <input type="text" name="beratbadan" class="form-control" id="beratbadan" value="{{ $dr->beratbadan }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tinggibadan" class="form-label">Tinggi Badan</label>
                    <input type="text" name="tinggibadan" class="form-control" id="tinggibadan" value="{{ $dr->tinggibadan }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="suhu" class="form-label">Suhu</label>
                    <input type="text" name="suhu" class="form-control" id="suhu" value="{{ $dr->suhu }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nadi" class="form-label">Nadi</label>
                    <input type="text" name="nadi" class="form-control" id="nadi" value="{{ $dr->nadi }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pernafasan" class="form-label">Pernafasan</label>
                    <input type="text" name="pernafasan" class="form-control" id="pernafasan" value="{{ $dr->pernafasan }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tekanandarah" class="form-label">Tekanan Darah</label>
                    <input type="text" name="tekanandarah" class="form-control" id="tekanandarah" value="{{ $dr->tekanandarah }}" readonly>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('aksi_input_resumemedis/' . $dr->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <label for="nocm" class="form-label mt-2"><b>Resume Medis</b></label>
                    </div>
                    <input type="hidden" name="id_pasien" value="{{ $dr->id }}">
                    <div class="col-md-4">
                        <label for="tglperiksadokter">Tanggal Periksa</label>
                        <input type="datetime-local" name="tglperiksadokter" class="form-control" id="tglperiksadokter"
                            value="{{ old('tglperiksadokter') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="exampleInputEmail1">Keluhan</label>
                        <textarea type="text" name="keluhan" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="7" value="{{ old('keluhan') }}"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="exampleInputEmail1">Diagnosa</label>
                        <textarea type="text" name="diagnosa" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" rows="7" value="{{ old('diagnosa') }}"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
        
    </div>
@endsection
