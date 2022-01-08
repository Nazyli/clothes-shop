@extends('layouts.app')

@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('img/hero.png') }}" class="img-fluid center-block d-block mx-auto"
                        style="max-width: 400px; " />
                </div>
                <div class="col-md-6">
                    <h1>BAJU STYLISH BODY STYLISH</h1>
                    <h2>Kamu akan mendapatkan hal yang kamu sukai atau kamu impikan disini. Kepoin yuk produk Fashion
                        terbaru dan berkualitas dari kami.</h2>
                    <div class="d-flex">
                        <a href="{{ route('products') }}" class="btn-get-started scrollto">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
            <div class="row">

                <div class="col-md-6 col-lg-3 mb-2 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="row d-flex align-items-center">
                            <div class="col-3">
                                <div class="icon"><i class="fa fa-trophy"></i></div>
                            </div>
                            <div class="col-9 mt-2">
                                <h4 class="title"><a href="">JAMINAN KUALITAS PRODUK</a></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-2 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="row d-flex align-items-center">
                            <div class="col-3">
                                <div class="icon"><i class="fa fa-clock-o"></i></div>
                            </div>
                            <div class="col-9 mt-2">
                                <h4 class="title"><a href="">GARANSI PRODUK 1 TAHUN</a></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-2 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="row d-flex align-items-center">
                            <div class="col-3">
                                <div class="icon"><i class="fa fa-truck"></i></div>
                            </div>
                            <div class="col-9 mt-2">
                                <h4 class="title"><a href="">JAMINAN TEPAT WAKTU</a></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-2 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="row d-flex align-items-center">
                            <div class="col-3">
                                <div class="icon"><i class="fa fa-money"></i></div>
                            </div>
                            <div class="col-9 mt-2">
                                <h4 class="title"><a href="">GARANSI UANG KEMBALI</a></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="promo" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <h3>Check our <span>Services</span></h3>
                <p>Find Your Favorite Clothes Here!</p>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box box-1 d-flex align-items-center">
                        <div class="clearfix">
                            <a href="{{ url('products') }}">
                                <h4 style="color:#2d3436;">New <br> Collection</h4>
                                <p style="color:#2d3436;">Shop Now <i class="bi bi-chevron-right"></i></p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 " data-aos="zoom-in" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-12 mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box box-2">
                                <a href="{{ route('products') }}">
                                    <h4 class="text-light">Custom <br>
                                        Clothes</h4>
                                    <p>Shop Now <i class="bi bi-chevron-right"></i></p>
                                </a>

                            </div>
                        </div>

                        <div class="col-md-12 mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box box-3">
                                <a href="{{ url('faq') }}">
                                    <h4 class="text-light">Any<br> Question ?</h4>
                                    <p>Click here <i class="bi bi-chevron-right"></i></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>

    <section id="collection" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Products</h2>
                <h3>Best Seller <span>Products</span></h3>
                <p>Enjoy your vacation in amazing clothes and great comfort at an affordable price</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($categorys as $row)
                            <li data-filter=".filter-{{ strtolower($row->name) }}">{{ $row->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                @foreach ($goods as $row)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower($row->category->name) }}">
                        <img src="{{ $row->masterFileUpload()->pathImg() }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $row->name }}</h4>
                            <p>@currency($row->minPrice())</p>
                            <a href="{{ $row->masterFileUpload()->pathImg() }}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="{{ $row->name }}"><i
                                    class="bx bx-plus"></i></a>
                            <a href="{{ route('products.detail', $row->id) }}" class="details-link"
                                title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="text-center">
                <a href="{{ route('products') }}" class="btn-get-started scrollto">View All Collection</a>
            </div>

        </div>
    </section>

    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="zoom-in">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/evry.jpg') }}" class="testimonial-img" alt="">
                            <h3>Evry Nazyli Ciptanto</h3>
                            <h4>Backend Developer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Everything was perfect and exactly what we wanted on this website
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/raga.jpeg') }}" class="testimonial-img" alt="">
                            <h3>Raga Murtadha Muthahari</h3>
                            <h4>UI UX Designer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Love your goods good quality year after year and I tell everyone to shop at SIMCLOTH
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/rafif.jpeg') }}" class="testimonial-img" alt="">
                            <h3>Rafif Mulia Reswara</h3>
                            <h4>Web Back-End Developer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Super soft t-shirts at such a great price, i&apos;d have to pay 2 or 3 times more at
                                SIMCLOTH
                                for this quality
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/ali.jpeg') }}" class="testimonial-img" alt="">
                            <h3>Ali Mahmud</h3>
                            <h4>Warehouseman Metrodata Elektronik,Tbk</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Clothing products at SIMCLOTH are very good and of good quality, i very proud for SIMCLOTH
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/farid.jpeg') }}" class="testimonial-img" alt="">
                            <h3>Farid Muhari</h3>
                            <h4>Freelance Engineer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                I like shopping at SIMCLOTH because the website is very easy for customers to understand
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/diny.jpeg') }}" class="testimonial-img" alt="">
                            <h3>Diny Brilianti</h3>
                            <h4>Admin and Moderator Digital Literacy KOMINFO</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Very fast response & helpful service, SIMCLOTH is best recommend
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>

    <section id="clients" class="clients section-bg">
        <div class="container" data-aos="zoom-in">

            <div class="section-title">
                <h2>Latest Brand</h2>
                <h3>Popular <span>Brand</span></h3>
                <p>Our products are also available from several well-known brands</p>
            </div>

            <div class="row">

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/clients/adidas.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/clients/chanel.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/clients/h&M.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/clients/nike.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/clients/uniqlo.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/clients/zara.png') }}" class="img-fluid" alt="">
                </div>

            </div>

        </div>
    </section>

@endsection
