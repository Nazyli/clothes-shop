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
                    <h1>LETS CREATE YOUR OWN STYLE</h1>
                    <h2>Fashion is life-enhancing and we always bring out the stars in yourself</h2>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started scrollto">SHOP NOW</a>
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
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                    atque vitae
                    autem.</p>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box box-1 d-flex align-items-center">
                        <div class="clearfix">
                            <h4><a class="text-black" href="">New <br> Collection</a></h4>
                            <p class="text-black">Shop Now <i class="bi bi-chevron-right"></i></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 " data-aos="zoom-in" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-12 mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box box-2">
                                <h4><a href="">Custom <br>
                                        Clothes</a></h4>
                                <p>Shop Now <i class="bi bi-chevron-right"></i></p>

                            </div>
                        </div>

                        <div class="col-md-12 mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box box-3">
                                <h4><a href="">Lorem <br> Ipsum</a></h4>
                                <p>Shop Now <i class="bi bi-chevron-right"></i></p>
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
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                    atque vitae
                    autem.</p>
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
                                class="portfolio-lightbox preview-link" title="{{ $row->name }}"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                    class="bx bx-link"></i></a>
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
                            <img src="{{ asset('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                rhoncus. Accusantium
                                quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/testimonials-2.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                cillum eram malis
                                quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/testimonials-3.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                veniam duis minim
                                tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/testimonials-4.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                fugiat minim velit
                                minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore
                                illum veniam.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('img/testimonials/testimonials-5.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                veniam enim culpa
                                labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi
                                cillum quid.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

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
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                    atque vitae
                    autem.</p>
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
