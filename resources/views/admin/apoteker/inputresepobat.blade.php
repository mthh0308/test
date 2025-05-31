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
                <div class="col-md-2 mb-3">
                    <label for="nocm" class="form-label">No Rekam Medis</label>
                    <input type="text" name="nocm" class="form-control" id="nocm" value="{{ $dr->nocm }}" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" id="nama_pasien" value="{{ $dr->nama_pasien }}" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ $dr->tempat_lahir }}" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" value="{{ $dr->tgl_lahir }}" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="no_hp" class="form-label">No Hp</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $dr->no_hp }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="nocm" class="form-label mt-2"><b>Vital Sign</b></label>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="tglperiksa" class="form-label">Tanggal diperiksa Perawat</label>
                    <input type="text" name="tglperiksa" class="form-control" id="tglperiksa" value="{{ $dr->tglperiksa }}" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="beratbadan" class="form-label">BB</label>
                    <input type="text" name="beratbadan" class="form-control" id="beratbadan" value="{{ $dr->beratbadan }}" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="tinggibadan" class="form-label">TB</label>
                    <input type="text" name="tinggibadan" class="form-control" id="tinggibadan" value="{{ $dr->tinggibadan }}" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="suhu" class="form-label">Suhu</label>
                    <input type="text" name="suhu" class="form-control" id="suhu" value="{{ $dr->suhu }}" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="nadi" class="form-label">Nadi</label>
                    <input type="text" name="nadi" class="form-control" id="nadi" value="{{ $dr->nadi }}" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="tekanandarah" class="form-label">TD</label>
                    <input type="text" name="tekanandarah" class="form-control" id="tekanandarah" value="{{ $dr->tekanandarah }}" readonly>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="pernafasan" class="form-label">Pernafasan</label>
                    <input type="text" name="pernafasan" class="form-control" id="pernafasan" value="{{ $dr->pernafasan }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="nocm" class="form-label mt-2"><b>Resume Medis</b></label>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea name="keluhan" class="form-control" cols="6" id="keluhan" readonly>{{ $dr->keluhan }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" class="form-control" id="diagnosa" readonly>{{ $dr->diagnosa }}</textarea>
                </div>
                                
            </div>
                @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('aksi_input_resep/' . $dr->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <label for="nocm" class="form-label mt-2"><b>Input Resep</b></label>
                    </div>
                    <input type="hidden" name="id_pasien" value="{{ $dr->id }}">
                    <div class="col-md-3">
                        <label for="tglresep">Tanggal Resep</label>
                        <input type="datetime-local" name="tglresep" class="form-control" id="tglresep"
                            value="{{ old('tglresep') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="id_obat">Nama Obat</label>
                        <select name="id_obat" class="form-select" id="id_obat" required>
                            <option value="">-- Pilih Obat --</option>
                            @foreach($obat as $o)
                                <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah"
                        aria-describedby="emailHelp" value="{{ old('jumlah') }}" autofocus>
                    </div>                    
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save2"></i> Simpan</button>
                <a type="button" href="/batal" class="btn btn-info mt-3">Batal</a>
            </form>
        </div>
        
    </div>
@endsection
