    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WEB - 8</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('page/home') ? 'active' : '' }}" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>
            <!-- Divider -->

            <!-- Nav Item - Ticket -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('page/tiket') ? 'active' : '' }}" href="{{ url('page/tiket') }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Ticket</span></a>
            </li>
            <!-- Divider -->

            <!-- Nav Item - Ticket -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('page/transaksi') ? 'active' : '' }}" href="{{ url('page/transaksi') }}">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
    </div>
