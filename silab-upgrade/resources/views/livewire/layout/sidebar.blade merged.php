<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ url('public/img/silab-logo.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('public/img/silab-dark.svg') }}" alt="" height="25">
                </span>
            </a>
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ url('public/img/silab-logo.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('public/img/silab.svg') }}" alt="" height="25">
                </span>
            </a>
            <button type="button" class="p-0 btn btn-sm fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('dashboard') }} --}}
                        {{-- {{ $data['npage'] == 0 ? ' active' : '' }} --}}
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Beranda</span>
                    </a>
                </li>

                {{-- @if(Auth::user()->can('staff-list') || Auth::user()->can('role-list') || Auth::user()->can('permission-list') || Auth::user()->can('jurusan-list') || Auth::user()->can('satuan-list') || Auth::user()->can('barang-list') || Auth::user()->can('lab-list')) --}}
                <li class="nav-item sub-menu">
                    <a class="nav-link menu-link" href="#sidebarMaster" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaster">
                        {{-- {{ in_array($data['npage'], [1, 2, 3, 90, 98, 99, 89]) ? ' active' : '' }} --}}
                        <i class="ri-apps-2-line"></i> <span data-key="t-master">Master</span> <span class="caret"></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaster">
                        {{-- {{ in_array($data['npage'], [1, 2, 3, 90, 98, 99, 89]) ? ' show' : '' }} --}}
                        <ul class="nav nav-collapse">
                            {{-- @can('staff-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('staff.index') }} --}}
                                    {{-- {{ $data['npage'] == 1 ? ' active' : '' }} --}}
                                    <span data-key="t-staff">Pegawai</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('role-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('roles.index') }} --}}
                                    {{-- {{ $data['npage'] == 2 ? ' active' : '' }} --}}
                                    <span data-key="t-staff">Role</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('permission-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('permission.index') }} --}}
                                    {{-- {{ $data['npage'] == 3 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Permission</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('jurusan-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('jurusan.index') }} --}}
                                    {{-- {{ $data['npage'] == 90 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Jurusan</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('satuan-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('satuan.index') }} --}}
                                    {{-- {{ $data['npage'] ==  98 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Satuan</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('barang-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('barang.index') }} --}}
                                    {{-- {{ $data['npage'] == 99 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Barang</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('lab-list') --}}
                            <li>
                                <a href="">
                                    {{-- {{ route('laboratorium.index') }} --}}
                                    {{-- {{ $data['npage'] == 89 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Laboratorium</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}

                {{-- @if(Auth::user()->can('tahunajaran-list') || Auth::user()->can('minggu-list') || Auth::user()->can('semester-list') || Auth::user()->can('matakuliah-list') || Auth::user()->can('setmatakuliah-list') || Auth::user()->can('setpengampu-list')) --}}
                <li class="nav-item">
                    <a class="nav-link menu-link#sidebarAkademik" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAkademik">
                        {{-- {{ in_array($data['npage'], [91, 92, 93, 94, 96, 97]) ? ' active' : '' }}" href=" --}}
                        <i class="mdi mdi-school-outline"></i> <span data-key="t-master">Akademik</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAkademik">
                        {{-- {{ in_array($data['npage'], [91, 92, 93, 94, 96, 97]) ? ' show' : '' }} --}}
                        <ul class="nav nav-collapse flex-column">
                            {{-- @can('tahunajaran-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('tahunajaran.index') }} --}}
                                    {{-- {{ $data['npage'] == 96 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Tahun Ajaran</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('minggu-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('minggu.index') }} --}}
                                    {{-- {{ $data['npage'] == 97 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Minggu Akademik</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('semester-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('semester.index') }} --}}
                                    {{-- {{ $data['npage'] == 91 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Semester</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('matakuliah-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('matakuliah.index') }} --}}
                                    {{-- {{ $data['npage'] == 92 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Matakuliah</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('setmatakuliah-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('maproditer.index') }} --}}
                                    {{-- {{ $data['npage'] == 93 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Matakuliah Semester</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('setpengampu-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('pengampu.index') }} --}}
                                    {{-- {{ $data['npage'] == 94 ? ' active' : '' }} --}}
                                    <span data-key="t-penelitian">Pengampu Matakuliah</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}

                {{-- @can('pengajuan-alat-bahan-list') --}}
                <li class="nav-item">
                    <a class ="nav-link menu-link" href="">
                        {{-- {{ route('pengajuanalat.index') }} --}}
                        {{-- {{ $data['npage'] == 95 ? ' active' : '' }} --}}
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Usulan Bahan Praktikum</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('review-pangajuan-alat-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('reviewPengajuan.index') }} --}}
                        {{-- {{ $data['npage'] == 4 ? ' active' : '' }} --}}
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Usulan Bahan Praktikum</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('deliver-pangajuan-alat-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('deljulat.index') }} --}}
                        {{-- {{ $data['npage'] == 88 ? ' active' : '' }} --}}
                        <i class="las la-truck"></i> <span data-key="t-dashboards">Deliver Pengajuan Alat ACC</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('stok-in-pengadaan-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('pengadaanStokin.index') }} --}}
                        {{-- {{ $data['npage'] == 87 ? ' active' : '' }} --}}
                        <i class="ri-folder-transfer-line"></i> <span data-key="t-dashboards">Stok-In Pengadaan</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('inventaris-bahan-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('invBahan.index') }} --}}
                        {{-- {{ $data['npage'] == 86 ? ' active' : '' }} --}}
                        <i class="bx bx-columns"></i> <span data-key="t-dashboards">Inventaris Bahan </span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('inventaris-alat-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('invAlat.index') }} --}}
                        {{-- {{ $data['npage'] == 83 ? ' active' : '' }} --}}
                        <i class="bx bx-briefcase-alt-2"></i> <span data-key="t-dashboards">Inventaris Alat </span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('kesiapan-praktek-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('kestek.index') }} --}}
                        {{-- {{ $data['npage'] == 85 ? ' active' : '' }} --}}
                        <i class="mdi mdi-application-cog-outline"></i> <span data-key="t-dashboards">Kesiapan Bahan Praktikum</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('bonalat-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('bonalat.index') }} --}}
                        {{-- {{ $data['npage'] == 84 ? ' active' : '' }} --}}
                        <i class="mdi mdi-clipboard-clock-outline"></i> <span data-key="t-dashboards">Bon Alat Praktikum</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('penggantian-praktek-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('penggantianPraktek.index') }} --}}
                        {{-- {{ $data['npage'] == 82 ? ' active' : '' }} --}}
                        <i class="mdi mdi-calendar-collapse-horizontal"></i> <span data-key="t-dashboards">Penggantian Jadwal</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('kehilangan-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('kehilangan.index') }} --}}
                        {{-- {{ $data['npage'] == 81 ? ' active' : '' }} --}}
                        <i class="mdi mdi-audio-input-xlr"></i> <span data-key="t-dashboards">Berita Acara Kerusakan / Hilang</span>
                    </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('serma-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('serma.index') }} --}}
                        {{-- {{ $data['npage'] == 80 ? ' active' : '' }} --}}
                        <i class="mdi mdi-handshake-outline"></i> <span data-key="t-dashboards">Serah Terima Hasil & Sisa Praktek</span>
                    </a>
                </li>
                {{-- @endcan --}}
                {{-- @can('ijinLBS-list') --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('ijinLBS.index') }} --}}
                        {{-- {{ $data['npage'] == 79 ? ' active' : '' }} --}}
                        <i class="mdi mdi-office-building-cog-outline"></i> <span data-key="t-dashboards">Ijin Penggunaan LBS</span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </div>
    </div>
</div>
