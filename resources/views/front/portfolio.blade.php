@extends('front.layout.app')

@section('title')
Index
@endsection

@section('styles')
@endsection

@section('header_section')
<li><a href="{{ route('home') }}" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Home</span></a></li>
<li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
<li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
@endsection

@section('content')
<section id="portfolio" class="portfolio section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Portfolio</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                    <img src="{{ asset('front/assets/img/portfolio/portfolio-1.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 1</h4>
                        <p>Category 1</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 portfolio-item filter-app">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae dolore cum minus quis deserunt illo officiis voluptates excepturi molestiae ea eveniet enim quia voluptatibus corrupti libero autem, magnam aliquam reiciendis. Impedit autem dolore totam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae dolore cum minus quis deserunt illo officiis voluptates excepturi molestiae ea eveniet enim quia voluptatibus corrupti libero autem, magnam aliquam reiciendis. Impedit autem dolore totam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae dolore cum minus quis deserunt illo officiis voluptates excepturi molestiae ea eveniet enim quia voluptatibus corrupti libero autem, magnam aliquam reiciendis. Impedit autem dolore totam.</p>
            </div>
        </div>

    </div>
</section><!-- End Portfolio Section -->
@endsection

@section('scripts')
@endsection