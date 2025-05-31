@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Detail Pemeriksaan Pasien</h3>
        </div>
    </div>
    <div class="container">
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'perawat' || auth()->user()->role == 'dokter')
            <a href="/EKSPORTpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
        @endif
        <a href="/detailpemeriksaanpasien" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>
    <!-- Filter Tanggal -->

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/detailpemeriksaanpasien" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama Pasien">
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- End Search -->
    </div>
    <div class="container">
        <div class="card">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-sm" style="min-width: 1200px;">            
                    <thead class="table-primary" id="records">
                        <tr align="center">
                            <th cscope="row">No</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>JK</th>
                            <th>No Hp</th>
                            <th>Tgl Periksa</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>TD</th>
                            <th>Suhu</th>
                            <th>Nadi</th>
                            <th>Pernafasan</th>
                            <th>Tgl Periksa Dokter</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tgl Resep</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($periksaperawat as $index => $pw)
                        <tr>
                            <td scope="row">{{ $index + $periksaperawat->firstItem() }}</td>
                            <td>{{ $pw->nocm }}</td>
                            <td>{{ $pw->nama_pasien }}</td>
                            <td>{{ $pw->tempat_lahir }}</td>
                            <td>{{ $pw->tgl_lahir }}</td>
                            <td>{{ $pw->jenis_kelamin }}</td>
                            <td>{{ $pw->no_hp }}</td>
                            <td>{{ $pw->tgl_periksa }}</td>
                            <td>{{ $pw->beratbadan }}</td>
                            <td>{{ $pw->tinggibadan }}</td>
                            <td>{{ $pw->tekanandarah }}</td>
                            <td>{{ $pw->suhu }}</td>
                            <td>{{ $pw->nadi }}</td>
                            <td>{{ $pw->pernafasan }}</td>
                            <td>{{ $pw->tglperiksadokter }}</td>
                            <td>{{ $pw->keluhan }}</td>
                            <td>{{ $pw->diagnosa }}</td>
                            <td>{{ $pw->tglresep }}</td>
                            <td>{{ $pw->nama_obat }}</td>
                            <td>{{ $pw->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection