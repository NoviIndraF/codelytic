<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Codelytic</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/landingpage/landingpage/img/favicon.png" rel="icon">
  <link href="assets/landingpage/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/landingpage/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/landingpage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/landingpage/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/landingpage/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/landingpage/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/landingpage/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/landingpage/css/style.css" rel="stylesheet">
</head>

<body>

  @include('landingpage.layouts.header')
  @include('landingpage.layouts.banner')

  <main id="main">
    @include('landingpage.layouts.features')
    @include('landingpage.layouts.features_detail')
    @include('landingpage.layouts.galleries')
  </main><!-- End #main -->

  @include('landingpage.layouts.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/landingpage/vendor/aos/aos.js"></script>
  <script src="assets/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/landingpage/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/landingpage/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/landingpage/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/landingpage/js/main.js"></script>

</body>

</html>