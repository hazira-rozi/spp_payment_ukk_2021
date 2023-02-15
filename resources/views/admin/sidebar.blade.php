<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-money-bill"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSPP" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>SPP</span>
        </a>
        <div id="collapseSPP" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data SPP:</h6>
                <a class="collapse-item" href="{{route('spp.create')}}">Tambah Data</a>
                <a class="collapse-item" href="{{route('spp.index')}}">Lihat Data</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePetugas" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Petugas</span>
        </a>
        <div id="collapsePetugas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Petugas:</h6>
                <a class="collapse-item" href="{{route('staff.create')}}">Tambah Data</a>
                <a class="collapse-item" href="{{route('staff.index')}}">Lihat Data</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSiswa" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Siswa</span>
        </a>
        <div id="collapseSiswa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Siswa:</h6>
                <a class="collapse-item" href="{{route('siswa.create')}}">Tambah Data</a>
                <a class="collapse-item" href="{{route('siswa.index')}}">Lihat Data</a>
            </div>
        </div>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelas" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-school"></i>
            <span>Kelas</span>
        </a>
        <div id="collapseKelas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Kelas:</h6>
                <a class="collapse-item" href="{{route('kelas.create')}}">Tambah Data</a>
                <a class="collapse-item" href="{{route('kelas.index')}}">Lihat Data</a>
            </div>

        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembayaran" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Pembayaran</span>
        </a>
        <div id="collapsePembayaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Pembayaran:</h6>
                <a class="collapse-item" href="{{route('pembayaran.create')}}">Tambah Data</a>
                <a class="collapse-item" href="{{route('pembayaran.index')}}">Lihat Data</a>
                <a class="collapse-item" href="{{url('pembayaran/studentPaymentHistory')}}">Riwayat Pembayaran</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('logout')}}"  aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    

</ul>
<!-- End of Sidebar -->