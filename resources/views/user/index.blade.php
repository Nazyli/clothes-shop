@extends('user.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Selamat Datang</h1>
                        <h6 class="mt-2 text-primary"> <i class="fas fa-minus mr-2"></i> Aplikasi Penjualan Baju
                        </h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">User</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-primary disabled">
                            <span class="info-box-icon"><i class="fas fa-map-marked-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Transaksi</span>
                                <span class="info-box-number">
                                    - Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <a href="#" class="text-light">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-teal">
                            <span class="info-box-icon"><i class="fas fa-drumstick-bite"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Transaksi Berhasil</span>
                                <span class="info-box-number">
                                    - Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="#" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-maroon">
                            <span class="info-box-icon"><i class="far fa-images"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Transaksi Tertunda</span>
                                <span class="info-box-number">
                                    - Data
                                </span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <a href="#" class="text-light">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                
        </section>
    </div>
@endsection
