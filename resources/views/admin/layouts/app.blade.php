@php
function isActiveLink($text)
{
    if (\Request::is($text) or \Request::is($text . '/*')) {
        return 'active text-light';
    } else {
        return null;
    }
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Aplikasi Penjualan Baju</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/shop.png') }}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-admin.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-orange text-sm border-bottom-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">
                        Aplikasi Penjualan Baju
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="dropdown user user-menu">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{ Auth::user()->pathImg() }}" class="user-image-sm" alt="User Image">
                        <span class="hidden-xs">
                             {{ Auth::user()->getFullName() }}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ Auth::user()->pathImg() }}" class="img-circle" alt="User Image">
                            <p>
                                 {{ Auth::user()->getFullName() }} -
                                Administrator
                                <small>Member since -
                                    {{ date('d F Y', strtotime(Auth::user()->created_at)) }}
                                </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="float-left">
                                <a href="{{ url('admin/profile') }}" class="btn btn-primary btn-sm">Profile</a>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();"
                                    class="btn btn-danger btn-sm">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar main-sidebar-custom sidebar-light-orange elevation-4">
            <a href="{{ url('/') }}" class="brand-link text-sm navbar-orange">
                <img src="{{ asset('img/shop.png') }}" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light text-light">J O L A</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/shop.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ url('admin/home') }}" class="d-block">Administrator</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent"
                        data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('admin/home') }}" class="nav-link {{ isActiveLink('admin/home') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.confirm') }}" class="nav-link {{ isActiveLink('admin/orders/confirm') }}">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Need Confirm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.purchase') }}" class="nav-link {{ isActiveLink('admin/orders/purchase') }}">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Purchase History
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/goods') }}" class="nav-link {{ isActiveLink('admin/goods') }}">
                                <i class="nav-icon fas fa-tshirt"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Master Data</li>

                        <li class="nav-item">
                            <a href="{{ url('admin/faq') }}" class="nav-link {{ isActiveLink('admin/faq') }}">
                                <i class="nav-icon fas fa-question"></i>
                                <p>
                                    Master Faq
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/category') }}" class="nav-link {{ isActiveLink('admin/category') }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Master Category
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/payment') }}" class="nav-link {{ isActiveLink('admin/payment') }}">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Master Payment
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/role') }}" class="nav-link {{ isActiveLink('admin/role') }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Master Role
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">Account</li>
                        <li class="nav-item">
                            <a href="{{ url('admin/user') }}" class="nav-link {{ isActiveLink('admin/user') }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Membership
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/profile') }}" class="nav-link {{ isActiveLink('admin/profile') }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    My Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/about') }}" class="nav-link {{ isActiveLink('admin/about') }}">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    About
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')


        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Develop By <a href="about">Mahasiswa</a> &copy; STT NF
                <script>
                    document.write(new Date().getFullYear());
                </script> ~ Aplikasi Penjualan Baju
            </strong>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/localization/messages_id.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('js/style-admin.js') }}"></script>
    @yield('js')
    <script>
        @if (session('success'))
            $(document).ready(showNotif('success', '{{ session('success') }}'));
        @endif
        @if (session('error'))
            $(document).ready(showNotif('error', '{{ session('error') }}'));
        @endif
    </script>
</body>

</html>
