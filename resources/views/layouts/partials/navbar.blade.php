<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard.index') }}" class="nav-link"></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="nav-link" style="background-color: transparent; border: none;"
                    onclick="return confirm('Anda yakin ingin keluar?')">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Keluar
                </button>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
