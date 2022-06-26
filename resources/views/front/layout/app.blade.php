<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>@yield('title') - Akash Associates</title>

    
    <link href="{{ asset('front/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    @include('front.layout.styles')

</head>

<body>


  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
  <!-- ======= Header ======= -->
  @include('front.layout.header')


  <main id="main">
@yield('content')
   
    @include('front.layout.contact')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
@include('front.layout.footer')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@include('front.layout.scripts')

</body>

</html>