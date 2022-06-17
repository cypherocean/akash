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
           
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning - {{ auth()->user()->name }}</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <!-- <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                
                            </select> -->
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
      
            @include('admin.layout.footer')
         
        </div>
     
    </div>

    @include('admin.layout.scripts')    
</body>

</html>