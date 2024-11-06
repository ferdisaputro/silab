<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};

?>

<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            {{-- <a href="index.html" class="logo">
                <img
                src="{{ url('public/img/silab.svg') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
                />
            </a> --}}
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        {{-- {{ route('dashboard') }} --}}
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Beranda</span>
                    </a>
                </li>
                {{-- @if(Auth::user()->can('staff-list') || Auth::user()->can('role-list') || Auth::user()->can('permission-list') || Auth::user()->can('jurusan-list') || Auth::user()->can('satuan-list') || Auth::user()->can('barang-list') || Auth::user()->can('lab-list')) --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMaster" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaster">
                        <i class="ri-apps-2-line"></i> <span data-key="t-master">Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaster">
                        <ul class="nav nav-sm flex-column">
                            {{-- @can('staff-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('staff.index') }} --}}
                                    <span data-key="t-staff">Pegawai</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('role-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('roles.index') }} --}}
                                    <span data-key="t-staff">Role</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('permission-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('permission.index') }} --}}
                                    <span data-key="t-penelitian">Permission</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('jurusan-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('jurusan.index') }} --}}
                                    <span data-key="t-penelitian">Jurusan</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('satuan-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('satuan.index') }} --}}
                                    <span data-key="t-penelitian">Satuan</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('barang-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('barang.index') }} --}}
                                    <span data-key="t-penelitian">Barang</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('lab-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('laboratorium.index') }} --}}
                                    <span data-key="t-penelitian">Laboratorium</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}

                {{-- @if(Auth::user()->can('tahunajaran-list') || Auth::user()->can('minggu-list') || Auth::user()->can('semester-list') || Auth::user()->can('matakuliah-list') || Auth::user()->can(' kelas-list') || Auth::user()->can('jadwal-list')) --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAcademic" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAcademic">
                        <i class="ri-book-2-line"></i> <span data-key="t-academic">Akademik</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAcademic">
                        <ul class="nav nav-sm flex-column">
                            {{-- @can('tahunajaran-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('tahunajaran.index') }} --}}
                                    <span data-key="t-tahunajaran">Tahun Ajaran</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('minggu-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('minggu.index') }} --}}
                                    <span data-key="t-minggu">Minggu</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('semester-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('semester.index') }} --}}
                                    <span data-key="t-semester">Semester</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('matakuliah-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('matakuliah.index') }} --}}
                                    <span data-key="t-matakuliah">Mata Kuliah</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('kelas-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('kelas.index') }} --}}
                                    <span data-key="t-kelas">Kelas</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('jadwal-list') --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="">
                                    {{-- {{ route('jadwal.index') }} --}}
                                    <span data-key="t-jadwal">Jadwal</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}
            </ul>
        </div>
    </div>
</div>
