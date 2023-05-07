<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Codelytic</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom Stylesheet -->
    <link href="/assets/dashboard/css/style.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="/assets/dashboard/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="/assets/dashboard/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div id="main-wrapper">
        @include('dashboard.layouts.header')
        @include('dashboard.layouts.sidebar')
        
        <div class="content-body">
            @yield('container')
        </div>
       
        @include('dashboard.layouts.footer')
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/assets/dashboard/plugins/common/common.min.js"></script>
    <script src="/assets/dashboard/js/custom.min.js"></script>
    <script src="/assets/dashboard/js/settings.js"></script>
    <script src="/assets/dashboard/js/gleek.js"></script>
    <script src="/assets/dashboard/js/styleSwitcher.js"></script>

     <!-- Chartjs -->
    <script src="/assets/dashboard/plugins/chart.js/Chart.bundle.min.js"></script>
    
    <!-- Circle progress -->
    <script src="/assets/dashboard//plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="/assets/dashboard//plugins/d3v3/index.js"></script>
    <script src="/assets/dashboard//plugins/topojson/topojson.min.js"></script>
    <script src="/assets/dashboard//plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="/assets/dashboard//plugins/raphael/raphael.min.js"></script>
    <script src="/assets/dashboard//plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="/assets/dashboard//plugins/moment/moment.min.js"></script>

    <!-- ChartistJS -->
    <script src="/assets/dashboard/plugins/chartist/js/chartist.min.js"></script>
    <script src="/assets/dashboard/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/assets/dashboard//js/dashboard/dashboard-1.js"></script>

</body>

</html>
