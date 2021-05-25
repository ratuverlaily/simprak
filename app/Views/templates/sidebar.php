<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-school"></i>
            <!-- <i class="fab fa-accusoft"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">E-SIMPRAG<br /></div>
    </a>

    <hr class="sidebar-divider">
    <div class="sidebar-brand-text mx-3 text-white text-center"><small>APLIKASI SIMULASI <br /> PRAKTIKUM GAMES</small></div>

    <!-- Divider Guru-->
    <hr class="sidebar-divider my-0">
    <button type="button" class="btn btn-warning btn-sm">
        <?= session()->get('kelas'); ?>
    </button>
    <br />

    <!-- Divider Guru-->
    <hr class="sidebar-divider my-0">

    <?php
    $request = service('request');
    $statusUri = $request->uri->getSegment(1);
    ?>

    <?php if (session()->get('level') == 1) { ?>

        <!-- Divider siswa -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            SISWA
        </div>

        <!-- Nav Item - Nilai Praktikum-->

        <li class="nav-item <?php if ($statusUri == "praktikum") {
                                $statusnilai = $request->uri->getSegment(2);
                                if ($statusnilai == "nilai") {
                                    echo 'active';
                                }
                            } ?>">
            <a class="nav-link" href="<?= base_url('praktikum/nilai'); ?>">
                <i class="fas fa-star"></i>
                <span>Hasil Praktikum</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item <?php if ($statusUri == "kelas") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('kelas'); ?>">
                <i class="fas fa-school"></i>
                <span>Daftar Kelas</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item <?php if ($statusUri == "sekolah") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('sekolah'); ?>">
                <i class="fas fa-school"></i>
                <span>Daftar Sekolah</span>
            </a>
        </li>

        <!-- Nav Item - Identitas Siswa-->
        <li class="nav-item <?php if ($statusUri == "identitas") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('identitas/photo'); ?>">
                <i class="fas fa-cog"></i>
                <span>Pengaturan Data Siswa</span>
            </a>
        </li>

        <!-- Nav Item - Daftar siswa-->
        <li class="nav-item <?php if ($statusUri == "murid") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('murid'); ?>">
                <i class="fas fa-list"></i>
                <span>Daftar siswa</span>
            </a>
        </li>

    <?php } ?>


    <?php if (session()->get('level') == 2) { ?>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if ($statusUri == "dashboard") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item <?php if ($statusUri == "praktikum") {
                                $statusnilai = $request->uri->getSegment(3);
                                if ($statusnilai == "nilai" || $statusnilai == "detail") {
                                    echo 'active';
                                }
                            } ?>">
            <a class="nav-link" href="<?= base_url('praktikum/guru/nilai'); ?>">
                <i class="fas fa-star"></i>
                <span>Hasil Praktikum</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item <?php if ($statusUri == "kelas") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('kelas'); ?>">
                <i class="fas fa-school"></i>
                <span>Aktivasi Kelas</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item <?php if ($statusUri == "sekolah") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('sekolah'); ?>">
                <i class="fas fa-school"></i>
                <span>Daftar Sekolah</span>
            </a>
        </li>

        <!-- Nav Item - Identitas Siswa-->
        <li class="nav-item <?php if ($statusUri == "identitas") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('identitas/photo'); ?>">
                <i class="fas fa-cog"></i>
                <span>Pengaturan Data Guru</span>
            </a>
        </li>

        <!-- Nav Item - Daftar siswa-->
        <li class="nav-item <?php if ($statusUri == "murid") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" href="<?= base_url('murid'); ?>">
                <i class="fas fa-list"></i>
                <span>Daftar siswa</span>
            </a>
        </li>

    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading
    <div class="sidebar-heading">
        FITUR CHAT
    </div>

    Nav Item - CHAT
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-envelope"></i>
            <span>Chat</span>
        </a>
    </li> 

    <hr class="sidebar-divider">-->

    <!-- Heading -->
    <div class="sidebar-heading">
        Logout
    </div>

    <!-- Nav Item - LOGOUT-->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout'); ?>">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Logout</span>
        </a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>