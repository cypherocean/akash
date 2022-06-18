<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('admin.layout.meta')
    <title>@yield('title') - Akash Associates</title>
    @include('admin.layout.styles')
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        @include('admin.layout.header')
  
        @include('admin.layout.sidebar')
      
        <div class="page-wrapper">
           
            

            @yield('content')
      
            @include('admin.layout.footer')
         
        </div>
     
    </div>

    @include('admin.layout.scripts')    
</body>

</html>