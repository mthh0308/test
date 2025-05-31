@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Pasien</h3>
            <hr>
            <h6>Data Pasien</h6>
        </div>
    </div>

    <div class="container">
        <a href="/tambahpasien" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'admin')
            <a href="/eksportpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/eksportexcel" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/pasien" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>

        {{-- Search Bar --}}
        <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
            <div class="col-auto">
                <form class="search-form" action="/pasien" method="get">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                        <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                            placeholder="Ketik Nama Pasien">
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Search --}}

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-primary" id="records">
                        <tr align="center">
                            <th cscope="row">No</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No Hp</th>
                            <th>Status Periksa Perawat</th>
                            <th>Status Periksa Dokter</th>
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
                                    <span class="badge {{ $w->status_perawat == 'Sudah diperiksa Perawat' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $w->status_perawat }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $w->status_dokter == 'Sudah diperiksa Dokter' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $w->status_dokter }}
                                    </span>
                                </td>                                
                                <td>
                                    <a href="/editpasien/{{ $w->id }}" type="button"
                                        class="btn btn-warning">Edit</a>
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
            <!-- Paginasi -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <span class="text-muted">Halaman {{ $pasien->currentPage() }} dari {{ $pasien->lastPage() }}</span>
                </div>
                <div>
                    <nav aria-label="Halaman">
                        <ul class="pagination justify-content-end mb-0">
                            @if ($pasien->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pasien->previousPageUrl() }}">Sebelumnya</a>
                                </li>
                            @endif

                            @foreach ($pasien->getUrlRange(1, $pasien->lastPage()) as $page => $url)
                                @if ($page == $pasien->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($pasien->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pasien->nextPageUrl() }}">Selanjutnya</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Selanjutnya</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            {{-- End Paginasi --}}
        </div>
    </div>
@endsection

@push('append-script')
    {{-- Hapus Data Wisata --}}
    <script>
        $('.hapus').click(function() {
            var wisataid = $(this).attr('data-id');
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
                        window.location = "/hapus/" + wisataid + ""
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
