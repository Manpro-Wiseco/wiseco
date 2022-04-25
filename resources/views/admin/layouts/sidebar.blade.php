<!-- sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="{{ asset('assetsAdmin') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Wiseco</span>
        </a>
    </div>
    <hr class="horizontal light mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main" style="height: 60vh">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white nav-link <?php if (url()->current() == route('admin.dashboard')) {echo 'bg-gradient-primary';} ?>" href="{{ route('admin.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (url()->current() == route('admin.table.index')) {echo 'bg-gradient-primary';} ?>" href="{{ route('admin.table.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">account_box</i>
                    </div>
                    <span class="nav-link-text ms-1">Tabel Pengguna</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (url()->current() == route('admin.umkm.index')) {echo 'bg-gradient-primary';} ?>" href="{{ route('admin.umkm.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">store</i>
                    </div>
                    <span class="nav-link-text ms-1">Tabel UMKM</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (url()->current() == route('admin.ticket.index')) {echo 'bg-gradient-primary';} ?>" href="{{ route('admin.ticket.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">credit_card</i>
                    </div>
                    <span class="nav-link-text ms-1">Tiket</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (url()->current() == route('admin.ticketcategory.index')) {echo 'bg-gradient-primary';} ?>" href="{{ route('admin.ticketcategory.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Kategori Tiket</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 mb-3">logout</i>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input type="submit" value="Log Out" class=" btn bg-gradient-primary p-2">
                    </form>
                </a>
            </li>
        </ul>
    </div>
</aside>
