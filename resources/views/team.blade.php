@extends('layouts.app')
@php
$data = [
    [
        'name' => 'Ali Mahmud',
        'title' => 'Warehouseman Metrodata Elektronik,Tbk',
        'position' => 'HIBSTER',
        'img' => 'img/testimonials/ali.jpeg',
        'linkedin' => 'https://www.linkedin.com/in/ali-mahmud-40a91620a/',
    ],
    [
        'name' => 'Diny Brilianti',
        'title' => 'Admin and Moderator Digital Literacy KOMINFO',
        'position' => 'HUSTLER',
        'img' => 'img/testimonials/diny.jpeg',
        'linkedin' => 'https://www.linkedin.com/in/diny-brilianti-a6397b21a/',
    ],
    [
        'name' => 'Evry Nazyli Ciptanto',
        'title' => 'Backend Developer',
        'position' => 'HACKER',
        'img' => 'img/testimonials/evry.jpg',
        'linkedin' => 'https://www.linkedin.com/in/evrynazyli/',
    ],
    [
        'name' => 'Farid Muhari',
        'title' => 'Freelance Engineer',
        'position' => 'HUSTLER',
        'img' => 'img/testimonials/farid.jpeg',
        'linkedin' => 'https://www.linkedin.com/in/farid-muhari-377251204/',
    ],
    [
        'name' => 'Raga Murtadha Muthahari',
        'title' => 'UI UX Designer',
        'position' => 'HIBSTER',
        'img' => 'img/testimonials/raga.jpeg',
        'linkedin' => 'https://www.linkedin.com/in/ragamrtdha/',
    ],
    [
        'name' => 'Rafif Mulia Reswara',
        'title' => 'Web Back-End Developer',
        'position' => 'HACKER',
        'img' => 'img/testimonials/rafif.jpeg',
        'linkedin' => 'https://www.linkedin.com/in/rafif-mulia/',
    ],
];
@endphp
@section('content')


    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Team</h2>
                <h3>Our Hardworking <span>Team</span></h3>
                <p>This is a great team, we have managed to build this app</p>
            </div>

            <div class="row">
                @foreach ($data as $i)
                    <div class="col-lg-4 col-md-4 d-flex align-items-center mx-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset($i['img']) }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href="{{ asset($i['linkedin']) }}"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $i['name'] }}</h4>
                                <span style="padding: 0;
                                margin: 0 0 6px 0;
                                text-transform: uppercase;
                                display: block;
                                font-weight: 600;
                                font-family: "Poppins", sans-serif;
                                color: #222222;">{{ $i['position'] }}</span>
                                <span>{{ $i['title'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection
