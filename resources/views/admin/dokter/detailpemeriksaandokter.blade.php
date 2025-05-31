@extends('layout.template')

@section('container')
<div class="container">
    <h4>Detail Pemeriksaan Dokter</h4>
    <hr>
    {{-- <h5>Pasien: {{ $pasien->nama_pasien }}</h5> --}}

    {{-- @foreach ($pasien as $dr) --}}
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="nocm" class="form-label mt-2"><b>Data Pasien</b></label>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nocm" class="form-label">No Rekam Medis</label>
                    <input type="text" name="nocm" class="form-control" id="nocm" value="{{ $pasien->nocm }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" id="nama_pasien" value="{{ $pasien->nama_pasien }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ $pasien->tempat_lahir }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" value="{{ $pasien->tgl_lahir }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="no_hp" class="form-label">No Hp</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $pasien->no_hp }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="nocm" class="form-label mt-2"><b>Vital Sign</b></label>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tglperiksa" class="form-label">Tanggal diperiksa Perawat</label>
                    <input type="text" name="tglperiksa" class="form-control" id="tglperiksa" value="{{ $vitalsign->tglperiksa }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="beratbadan" class="form-label">Berat Badan</label>
                    <input type="text" name="beratbadan" class="form-control" id="beratbadan" value="{{ $vitalsign->beratbadan }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tinggibadan" class="form-label">Tinggi Badan</label>
                    <input type="text" name="tinggibadan" class="form-control" id="tinggibadan" value="{{ $vitalsign->tinggibadan }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="suhu" class="form-label">Suhu</label>
                    <input type="text" name="suhu" class="form-control" id="suhu" value="{{ $vitalsign->suhu }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nadi" class="form-label">Nadi</label>
                    <input type="text" name="nadi" class="form-control" id="nadi" value="{{ $vitalsign->nadi }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pernafasan" class="form-label">Pernafasan</label>
                    <input type="text" name="pernafasan" class="form-control" id="pernafasan" value="{{ $vitalsign->pernafasan }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tekanandarah" class="form-label">Tekanan Darah</label>
                    <input type="text" name="tekanandarah" class="form-control" id="tekanandarah" value="{{ $vitalsign->tekanandarah }}" readonly>
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}

    <div class="container">
        <div class="card">
            <div class="col-md-12 mb-1 ms-2">
                <label for="nocm" class="form-label mt-2"><b>Resume Medis</b></label>
            </div>
            <div class="table-responsive ms-2 me-2" style="overflow-x: auto;">
                <table class="table table-sm" style="min-width: 1200px;">            
                    <thead class="table-primary" id="records">
                        <tr>
                            <th>Tanggal Periksa</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($resumemedis as $resume)
                        <tr>
                            <td>{{ $resume->tglperiksadokter }}</td>
                            <td>{{ $resume->keluhan }}</td>
                            <td>{{ $resume->diagnosa }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
