@extends('layout.template')

@section('container')
    <div class="card">
        <div class="card-body mt-3">
            <h3>Halaman Data Obat</h3>
            <hr>
            <h6>Data Obat</h6>
        </div>
    </div>
    <div class="container">
        <a href="tambahobat" class="btn btn-primary btn-sm"><i class="bi bi-folder-plus"></i> Tambah Data</a>
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'apoteker')
            <a href="/ekspoortpdf" target="_blank" class="btn btn-danger btn-sm"><i class="bi bi-file-pdf"></i> Export PDF</a>
            <a href="/eksportexcell" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-file-excel"></i> Export
                Excel</a>
        @endif
        <a href="/obat" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i> Refresh</a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar row g-3 d-flex flex-row-reverse mb-3">
        <div class="col-auto">
            <form class="search-form" action="/obat" method="get">
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" name="search" id="exampleFormControlInput1"
                        placeholder="Ketik Nama Obat">
                </div>
            </form>
        </div>
    </div>
    <!-- End Search -->

    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table">
                        <thead class="table-info" id="records">
                            <tr align="center">
                                <th cscope="row">No</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($obat as $index => $p)
                                <tr>
                                    <td scope="row">{{ $index + $obat->firstItem() }}</td>
                                    <td>{{ $p->nama_obat }}</td>
                                    <td>{{ $p->satuan }}</td>
                                    <td>{{ $p->harga_beli }}</td>
                                    <td>{{ $p->harga_jual }}</td>
                                    <td>{{ $p->stok }}</td>
                                    <td>
                                        <a href="/editobat/{{ $p->id }}" type="button"
                                            class="btn btn-warning">Edit</a>
                                        @if (auth()->user()->role == 'admin')
                                            <a href="#" type="button" class="btn btn-danger hapus"
                                                data-id="{{ $p->id }}"
                                                data-nama="{{ $p->nama_obat }}">Hapus</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginasi -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-muted">Halaman {{ $obat->currentPage() }} dari
                            {{ $obat->lastPage() }}</span>
                    </div>
                    <div>
                        <nav aria-label="Halaman">
                            <ul class="pagination justify-content-end mb-0">
                                @if ($obat->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Sebelumnya</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $obat->previousPageUrl() }}">Sebelumnya</a>
                                    </li>
                                @endif

                                @foreach ($obat->getUrlRange(1, $obat->lastPage()) as $page => $url)
                                    @if ($page == $obat->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($obat->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $obat->nextPageUrl() }}">Selanjutnya</a>
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
    </div>
@endsection

@push('append-script')
    {{-- Hapus Data Obat --}}
    <script>
        $('.hapus').click(function() {
            var penginapanid = $(this).attr('data-id');
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
                        window.location = "/hapusss/" + penginapanid + ""
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
