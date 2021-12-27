<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>JOLA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link href="{{ asset('img/logo.png') }}" rel="apple-touch-icon">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('css/style-user.css') }}" rel="stylesheet">
    <style>
        #notif-cart .badge {
            position: relative;
            top: -10px;
            right: 0px;
            background-color: #ff9f43;
            border-radius: 50%;
            color: #fff;
            font-weight: bold;
        }

    </style>

</head>

<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-start">

            <a href="/" class="logo"><img src="{{ asset('img/logo.png') }}" alt=""></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="{{ url('/#hero') }}">Home</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/#promo') }}">Promo</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/#collection') }}">Collection</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/#testimonials') }}">Testimonials</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/#clients') }}">Brand</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('products') }}">Catalog</a></li>
                    <li><a class="nav-link scrollto " href="{{ url('/faq#faq') }}">FAQ</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/team#team') }}">Team</a></li>
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @else
                    @php $totalCart = App\Models\Cart::where("user_id", Auth::user()->id)->get()->count(); @endphp
                        <li class="dropdown">
                            <a href="#"><span>
                                    {{ Auth::user()->first_name }}</span>
                                    @if( $totalCart > 0)
                                <div id="notif-cart">
                                    <label class="badge">{{  $totalCart }}</label>
                                </div>
                                @endif
                            </a>
                            <ul>
                                <li>
                                    @if (auth()->user()->role_id == 1)
                                        <a href="{{ url('admin/profile') }}" style="max-width: 200px">Profile</a>
                                    @elseif (auth()->user()->role_id == 2)
                                        <a href="{{ url('user/profile') }}">Profile </a>
                                    @else
                                        <a href="#">Profile</a>
                                    @endif
                                </li>

                                @if (auth()->user()->role_id == 2)
                                    <li>
                                        <a href="{{ route('transaction.cart') }}">Cart
                                            <span class="badge" style="background-color: #ff9f43;
                                            border-radius: 50%;
                                            color: #fff;">{{ $totalCart }}</span>
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif

                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
            </div>
        </header>

        <main id="main">
            @yield('content')
        </main>

        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <a href="/" class="mb-3"><img src="{{ asset('img/logo.png') }}" alt=""
                                    class="img-fluid"></a>
                            <p>
                                Jl Jend Sudirman Kav 52-53 <br>
                                Ged Artha Graha Basement 1 <br>
                                Senayan JAK, Dki Jakarta <br>
                                <strong>Phone:</strong> +6285735906222<br>
                                <strong>Website:</strong> jola.nazyli.com<br>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Information</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/') }}">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Cara Custome Pakaian</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Cara Mengukur Pakaian</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Syarat dan Ketentuan</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/faq#faq') }}">FAQ</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Membership</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Partner / Reseller</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Social Networks</h4>
                            <strong>PT JOLA MEMBANGUN INDONESIA</strong>
                            <p>Depok</p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </footer>

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/purecounter/purecounter.js') }}"></script>
        <script src="{{ asset('vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min-landing.js') }}"></script>
        <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('js/main-user.js') }}"></script>
        @yield('js')
        <script>
            function showNotif(status, message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr[status](message);
            };
            @if (session('success'))
                $(document).ready(showNotif('success', '{{ session('success') }}'));
            @endif
            @if (session('error'))
                $(document).ready(showNotif('error', '{{ session('error') }}'));
            @endif
        </script>
    </body>

    </html>
