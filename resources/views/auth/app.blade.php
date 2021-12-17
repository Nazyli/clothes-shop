<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <title>JOLA</title>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row box-1 mb-5">
                    <div class="col-12 col-md-6 shadow-sm box-2">
                        <h4 class="text-center text-white mt-5">Get’s Started</h4>
                        <div class="text-white mt-5">
                            <div class="features owl-theme owl-carousel">
                                <div> <img src="{{ asset('img/Artboard11.png') }}" />
                                    <h4>99% Customer Satisfaction</h4>
                                    <p>Based on paid invoices</p>
                                </div>
                                <div> <img src="https://img.icons8.com/clouds/200/000000/group.png" />
                                    <h4>99% Customer Satisfaction</h4>
                                    <p>Based on paid invoices</p>
                                </div>
                                <div> <img
                                        src="https://img.icons8.com/bubbles/200/000000/lady-with-a-security-shield.png" />
                                    <h4>99% Customer Satisfaction</h4>
                                    <p>Based on paid invoices</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 shadow-sm bg-white box-3">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

</body>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
<script>
    @if (session('success'))
        $(document).ready(showNotif('success', '{{ session('success') }}'));
    @endif
    @if (session('error'))
        $(document).ready(showNotif('error', '{{ session('error') }}'));
    @endif
</script>

</html>
