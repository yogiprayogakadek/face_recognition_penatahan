<aside class="side-mini-panel with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="iconbar">
        <div>
            <div class="mini-nav">
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <a class="nav-link {{ auth()->user()->role == 'admin' ? 'sidebartoggler' : '' }}" id="headerCollapse"
                        href="javascript:void(0)">
                        <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                    </a>
                </div>
                <ul class="mini-nav-ul" data-simplebar>

                    <!-- --------------------------------------------------------------------------------------------------------- -->
                    <!-- Pegawai -->
                    <!-- --------------------------------------------------------------------------------------------------------- -->

                    <li class="mini-nav-item single-menu" id="dashboard">
                        <a href="{{ route('dashboard') }}" data-bs-toggle="tooltip"
                            data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                            <iconify-icon icon="solar:tuning-square-2-line-duotone" class="fs-7"></iconify-icon>
                        </a>
                    </li>

                    {{-- <li>
                        <span class="sidebar-divider lg"></span>
                    </li> --}}

                    @can('access-admin-menu')
                        <li class="mini-nav-item" id="mini-2">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                data-bs-placement="right" data-bs-title="Pegawai">
                                <iconify-icon icon="solar:user-hands-outline" class="fs-7"></iconify-icon>
                            </a>
                        </li>
                        <li class="mini-nav-item" id="mini-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                data-bs-placement="right" data-bs-title="Aturan Kehadiran">
                                <iconify-icon icon="solar:settings-linear" class="fs-7"></iconify-icon>
                            </a>
                        </li>

                        <li class="mini-nav-item" id="mini-1">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                data-bs-placement="right" data-bs-title="Face Encoding">
                                <iconify-icon icon="solar:face-scan-square-bold" class="fs-7"></iconify-icon>
                            </a>
                        </li>
                    @endcan

                    @cannot('access-admin-menu')
                        <li class="mini-nav-item single-menu" id="face">
                            <a href="{{ route('face.create', auth()->user()->pegawai->id) }}" data-bs-toggle="tooltip"
                                data-bs-custom-class="custom-tooltip" data-bs-placement="right"
                                data-bs-title="Tambah/Update Face Encoding">
                                <iconify-icon icon="solar:face-scan-square-bold" class="fs-7"></iconify-icon>
                            </a>
                        </li>
                    @endcannot

                    <li class="mini-nav-item single-menu" id="kehadiran">
                        <a href="{{ route('kehadiran.index') }}" data-bs-toggle="tooltip"
                            data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Absensi">
                            <iconify-icon icon="solar:tuning-square-2-line-duotone" class="fs-7"></iconify-icon>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="sidebarmenu">
                <div class="brand-logo d-flex align-items-center nav-logo">
                    <a href="../main/index.html" class="text-nowrap logo-img">
                        <img src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/logos/logo.svg"
                            alt="Logo" />
                    </a>

                </div>
                @can('access-admin-menu')
                    <!-- ---------------------------------- -->
                    <!-- Pegawai -->
                    <!-- ---------------------------------- -->
                    <nav class="sidebar-nav" id="menu-right-mini-2" data-simplebar>
                        <ul class="sidebar-menu" id="sidebarnav">
                            <!-- ---------------------------------- -->
                            <!-- Pegawai -->
                            <!-- ---------------------------------- -->
                            <li class="nav-small-cap">
                                <span class="hide-menu">Pegawai</span>
                            </li>
                            <!-- ---------------------------------- -->
                            <!-- Pegawai -->
                            <!-- ---------------------------------- -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" id="list-pegawai" href="{{ route('pegawai.index') }}"
                                    aria-expanded="false">
                                    <iconify-icon icon="solar:user-id-linear"></iconify-icon>
                                    <span class="hide-menu">List Pegawai</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('pegawai.create') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:user-plus-broken"></iconify-icon>
                                    <span class="hide-menu">Tambah Pegawai</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('pegawai.showRestore') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:refresh-bold-duotone"></iconify-icon>
                                    <span class="hide-menu">Restore Pegawai</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- ---------------------------------- -->
                    <!-- Rules -->
                    <!-- ---------------------------------- -->
                    <nav class="sidebar-nav" id="menu-right-mini-3" data-simplebar>
                        <ul class="sidebar-menu" id="sidebarnav">
                            <!-- ---------------------------------- -->
                            <!-- Rules -->
                            <!-- ---------------------------------- -->
                            <li class="nav-small-cap">
                                <span class="hide-menu">Rules</span>
                            </li>
                            <!-- ---------------------------------- -->
                            <!-- Rules -->
                            <!-- ---------------------------------- -->
                            <li class="sidebar-item">
                                <a class="sidebar-link" id="list-rule" href="{{ route('rule.index') }}"
                                    aria-expanded="false">
                                    <iconify-icon icon="solar:settings-bold"></iconify-icon>
                                    <span class="hide-menu">List Rule</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('rule.create') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:add-circle-bold"></iconify-icon>
                                    <span class="hide-menu">Tambah Rule</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('rule.showRestore') }}" aria-expanded="false">
                                    <iconify-icon icon="solar:refresh-bold-duotone"></iconify-icon>
                                    <span class="hide-menu">Restore Rule</span>
                                </a>
                            </li>
                        </ul>
                    </nav>


                    <!-- ---------------------------------- -->
                    <!-- Face Encoding -->
                    <!-- ---------------------------------- -->
                    <nav class="sidebar-nav" id="menu-right-mini-1" data-simplebar>
                        <ul class="sidebar-menu" id="sidebarnav">
                            <!-- ---------------------------------- -->
                            <!-- Face Encoding -->
                            <!-- ---------------------------------- -->
                            <li class="nav-small-cap">
                                <span class="hide-menu">Face Encoding</span>
                            </li>
                            <!-- ---------------------------------- -->
                            <!-- Face Encoding -->
                            <!-- ---------------------------------- -->
                            {{-- @can('access-admin-menu') --}}
                            <li class="sidebar-item">
                                <a class="sidebar-link" id="list-face" href="{{ route('face.index') }}"
                                    aria-expanded="false">
                                    <iconify-icon icon="solar:face-scan-square-broken"></iconify-icon>
                                    <span class="hide-menu">List Face Encoding</span>
                                </a>
                            </li>
                            {{-- @endcan --}}

                            <li class="sidebar-item">
                                <a class="sidebar-link" id="create-face"
                                    href="{{ route('face.create', auth()->user()->pegawai->id) }}" aria-expanded="false">
                                    <iconify-icon icon="solar:add-circle-bold"></iconify-icon>
                                    <span class="hide-menu">Tambah/Update</span>
                                </a>
                            </li>

                            {{-- <li class="sidebar-item">
                                                <a class="sidebar-link" href="{{ route('face.showRestore') }}" aria-expanded="false">
                                                    <iconify-icon icon="solar:refresh-bold-duotone"></iconify-icon>
                                                    <span class="hide-menu">Restore Face Encoding</span>
                                                </a>
                                            </li> --}}
                        </ul>
                    </nav>
                @endcan
            </div>
        </div>
    </div>
</aside>
