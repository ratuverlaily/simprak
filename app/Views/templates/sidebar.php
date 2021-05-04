<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fab fa-accusoft"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-SIMPRAG<br /></div>
    </a>

    <!-- Divider Guru-->
    <hr class="sidebar-divider my-0">
    <button type="button" class="btn btn-warning btn-sm">
        <?= session()->get('kelas'); ?>
    </button>
    <br />

    <!-- Divider Guru-->
    <hr class="sidebar-divider my-0">

    <?php if (session()->get('level') == 1) { ?>

        <!-- Divider siswa -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            SISWA
        </div>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('praktikum/nilai'); ?>">
                <i class="fas fa-star"></i>
                <span>Hasil Praktikum</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('kelas'); ?>">
                <i class="fas fa-school"></i>
                <span>Daftar Kelas</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('sekolah'); ?>">
                <i class="fas fa-school"></i>
                <span>Daftar Sekolah</span>
            </a>
        </li>

        <!-- Nav Item - Identitas Siswa-->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('identitas/photo'); ?>">
                <i class="fas fa-cog"></i>
                <span>Pengaturan Data Siswa</span>
            </a>
        </li>

        <!-- Nav Item - Daftar siswa-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('kelas/siswa'); ?>">
                <i class="fas fa-list"></i>
                <span>Daftar siswa</span>
            </a>
        </li>

    <?php } ?>


    <?php if (session()->get('level') == 2) { ?>
        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('praktikum/guru/nilai'); ?>">
                <i class="fas fa-star"></i>
                <span>Hasil Praktikum</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('kelas'); ?>">
                <i class="fas fa-school"></i>
                <span>Aktivasi Kelas</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Praktikum-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('sekolah'); ?>">
                <i class="fas fa-school"></i>
                <span>Daftar Sekolah</span>
            </a>
        </li>

        <!-- Nav Item - Identitas Siswa-->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('identitas/photo'); ?>">
                <i class="fas fa-cog"></i>
                <span>Pengaturan Data Guru</span>
            </a>
        </li>

        <!-- Nav Item - Daftar siswa-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('kelas/siswa'); ?>">
                <i class="fas fa-list"></i>
                <span>Daftar siswa</span>
            </a>
        </li>

    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        FITUR CHAT
    </div>

    <!-- Nav Item - CHAT-->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-envelope"></i>
            <span>Chat</span>
        </a>
    </li>

    <hr class="sidebar-divider">

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