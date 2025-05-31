@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Pasien Perawatan</h3>
            <hr>
            <h6>Data Pasien Perawatan</h6>
        </div>
    </div>
    <div class="container">
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'perawat')
            <a href="/ekspooortpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
        @endif
        <a href="/pemeriksaanperawat" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>
    <!-- Filter Tanggal -->

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/pemeriksaanperawat" method="get">
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
            <div class="table-responsive ms-2 me-2" style="overflow-x: auto;">
                <table class="table table-sm mt-3" style="min-width: 1200px;">            
                    <thead class="table-primary" id="records">
                        <tr align="center">
                            <th cscope="row">No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>No Hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pasien as $index => $w)
                            <tr>
                                <td scope="row">{{ $index + $pasien->firstItem() }}</td>
                                <td>{{ $w->nocm }}</td>
                                <td>{{ $w->nama_pasien }}</td>
                                <td>{{ $w->tempat_lahir }}</td>
                                <td>{{ $w->tgl_lahir }}</td>
                                <td>{{ $w->jenis_kelamin }}</td>
                                <td>{{ $w->no_hp }}</td>
                                <td>
                                    <span class="badge {{ $w->status_periksa == 'Sudah diperiksa' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $w->status_periksa }}
                                    </span>
                                </td>
                                
                                <td>
                                    <a href="/inputpemeriksaanperawat/{{ $w->id }}" type="button"
                                        class="btn btn-warning">Input Vital Sign</a>
                                    <a href="/detailpemeriksaanperawat/{{ $w->id }}" type="button"
                                        class="btn btn-warning">Detail</a>
                                    @if (auth()->user()->role == 'admin')
                                        <a href="#" type="button" class="btn btn-danger hapus"
                                            data-id="{{ $w->id }}" data-nama="{{ $w->nama_pasien }}">Hapus</a>
                                </td>
                        @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('append-script')
    {{-- Hapus Data Perawatan --}}
    <script>
        $('.hapus').click(function() {
            var restoid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');


            swal({
                    title: "Apakah Yakin ?",
                    text: "Data dengan nama " + nama + " akan dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/hapuss/" + restoid + ""
                        swal("Data berhasil dihapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus!");
                    }
                });

        });
    </script>
@endpush
