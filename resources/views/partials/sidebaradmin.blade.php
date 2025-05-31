<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard -->

        <li class="nav-heading">Pages</li>

        <!-- Home -->
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="/" target="_blank">
                <i class="ri-home-3-line"></i>
                <span>Go to Home</span>
            </a>
        </li> --}}
        <!-- End Home -->

        @if (auth()->check())
            <!-- Data User (Admin Only) -->
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('useradmin') ? '' : 'collapsed' }}" href="/useradmin">
                        <i class="ri-file-user-line"></i>
                        <span>Data Pegawai</span>
                    </a>
                </li>
            @endif
            <!-- End Data User -->

            <!-- Data Pasien -->
            @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'dokter' || auth()->user()->role == 'perawat' || auth()->user()->role == 'loket'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pasien') ? '' : 'collapsed' }}" href="/pasien">
                        <i class="ri-ancient-gate-line"></i>
                        <span>Data Pasien</span>
                    </a>
                </li>
            @endif
            <!-- End Data Pasien -->


            <!-- Data Obat -->
            @if (in_array(auth()->user()->role, ['admin', 'apoteker']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('obat') ? '' : 'collapsed' }}"
                        href="/obat">
                        <i class="ri-hotel-line"></i>
                        <span>Data Obat</span>
                    </a>
                </li>
            @endif
            <!-- End Data Obat -->

            <!-- Data Transaksi Perawatan -->
            @if (in_array(auth()->user()->role, ['admin', 'perawat']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pemeriksaanperawat') ? '' : 'collapsed' }}" href="/pemeriksaanperawat">
                        <i class="ri-restaurant-line"></i>
                        <span>Pemeriksaan Perawat</span>
                    </a>
                </li>
            @endif
            <!-- End Data Transaksi Perawatan -->

            <!-- Data Transaksi Dokter -->
            @if (in_array(auth()->user()->role, ['admin', 'dokter']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pemeriksaandokter') ? '' : 'collapsed' }}" href="/pemeriksaandokter">
                        <i class="ri-calendar-todo-fill"></i>
                        <span>Pemeriksaan Dokter</span>
                    </a>
                </li>
            @endif
            <!-- End Data Transaksi Dokter -->

            <!-- Data Transaksi Apoteker -->
            @if (in_array(auth()->user()->role, ['admin', 'apoteker']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('resepobat') ? '' : 'collapsed' }}" href="/resepobat">
                        <i class="ri-coins-line"></i>
                        <span>Farmasi</span>
                    </a>
                </li>
            @endif
            <!-- Data Transaksi Apoteker -->

            <!-- Data Detail Pemeriksaan Pasien -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('detailpemeriksaanpasien') ? '' : 'collapsed' }}" href="/detailpemeriksaanpasien">
                    <i class="ri-coins-line"></i>
                    <span>Detail Pemeriksaan Pasien</span>
                </a>
            </li>
            <!-- End Data Detail Pemeriksaan Pasien -->

            
        @endif
    </ul>
</aside>
<!-- End Sidebar -->
