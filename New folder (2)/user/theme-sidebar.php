        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../index3.html" class="brand-link">
                <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PRAKTIKUM FTI UNISKA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION["username"]; ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Penggajian
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="gaji.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Penggajian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="rekap-gaji.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Gaji</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="riwayat-gaji.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Riwayat Gaji</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="slip-gaji.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Slip Gaji</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="lokasi.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lokasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="jabatan.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jabatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="bagian.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bagian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="karyawan.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Karyawan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>