<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
    <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="index.html" class="logo">
                <img
                    src="assets/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"
                />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar" style="height: 2rem;">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler" style="height: 2rem;">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt" style="height: 2rem;"></i>
            </button>
        </div>
    <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('beranda')? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('beranda') }}">
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#master">
                        <i class="fa-solid fa-cubes"></i>
                        <p>Master</p>
                        <span class="caret"></span>
                    </a>
                    <div 
                            class="collapse 
                            {{ 
                                request()->routeIs('pegawai')? 
                                'show' : '' 
                            }}" 
                            id="master">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('pegawai')? 'active' : '' }}">
                                <a href="{{ route('pegawai') }}">
                                    <span class="sub-item text-wrap">Pegawai</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item text-wrap">Role</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item text-wrap">Permission</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item text-wrap">Jurusan</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item text-wrap">Satuan</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item text-wrap">Barang</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item text-wrap">Laboratorium</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#akademik">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <p>Akademik</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="akademik">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/pegawai.html">
                                    <span class="sub-item text-wrap">Tahun Ajaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item text-wrap">Minggu Akademik</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item text-wrap">Semester</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item text-wrap">Matakuliah</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item text-wrap">Matakuliah Semester</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item text-wrap">Pengampu Matakuliah</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#inventory-management">
                        <i class="fas fa-boxes"></i>
                        <p class="text-wrap">Inventory Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="inventory-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#forms">
                                    <p class="text-wrap sub-item">Stok-In Pengadaan</p>
                                </a>
                            </li>
                            <li>
                                <a href="#forms">
                                    <p class="text-wrap sub-item">Inventaris Bahan</p>
                                </a>
                            </li>
                            <li>
                                <a href="#forms">
                                    <p class="text-wrap sub-item">Inventaris Alat</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#usulan-pengajuan">
                        <i class="fas fa-envelope-open-text"></i>
                        <p class="text-wrap">Usulan / Pengajuan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="usulan-pengajuan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#forms">
                                    <p class="text-wrap sub-item">Usulan Bahan Praktikum</p>
                                </a>
                            </li>
                            <li>
                                <a href="#forms">
                                    <p class="text-wrap sub-item">Deliver Pengajuan Alat ACC</p>
                                </a>
                            </li>
                            <li>
                                <a href="#forms">
                                    <p class="text-wrap sub-item">Usulan Bahan Praktikum</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fa-solid fa-square-check"></i>
                        <p class="text-wrap">Deliver Pengajuan Alat ACC</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fa-solid fa-list-check"></i>
                        <p class="text-wrap">Kesiapan Bahan Praktikum</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <p class="text-wrap">Bon Alat Praktikum</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p class="text-wrap">Penggantian Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fa-solid fa-newspaper"></i>
                        <p class="text-wrap">Berita Acara Kerusakan / <br> Hilang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        <p class="text-wrap">Serah Terima Hasil & <br> Sisa Praktik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p class="text-wrap">Ijin Penggunaan LBS</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
