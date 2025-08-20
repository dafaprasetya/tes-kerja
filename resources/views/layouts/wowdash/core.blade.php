<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logo/Logo_IKI-besar.png') }}" sizes="16x16">

  <link rel="stylesheet" href="{{ asset('foodking/assets/css/font-awesome.css') }}">

  <!-- remix icon font css  -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/remixicon.css') }}">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/bootstrap.min.css') }} ">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/apexcharts.css') }}">
  <!-- Data Table css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/dataTables.min.css') }}">
  <!-- Text Editor css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/editor-katex.min.css') }}">
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/editor.atom-one-dark.min.css') }}">
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/editor.quill.snow.css') }}">
  <!-- Date picker css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/flatpickr.min.css') }}">
  <!-- Calendar css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/full-calendar.css') }}">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/jquery-jvectormap-2.0.5.css') }}">
  <!-- Popup css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/magnific-popup.css') }}">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/slick.css') }}">
  <!-- prism css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/prism.css') }}">
  <!-- file upload css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/file-upload.css') }}">

  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/lib/audioplayer.css') }}">
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('wowdash/assets/css/style.css') }}">

</head>
<body>

  @yield('body')


  <!-- jQuery library js -->
  <script src="{{ asset('wowdash/assets/js/lib/jquery-3.7.1.min.js') }}"></script>
  <!-- Bootstrap js -->
  <script src="{{ asset('wowdash/assets/js/lib/bootstrap.bundle.min.js') }}"></script>
  <!-- Apex Chart js -->
  <script src="{{ asset('wowdash/assets/js/lib/apexcharts.min.js') }}"></script>
  <!-- Data Table js -->
  <script src="{{ asset('wowdash/assets/js/lib/dataTables.min.js') }}"></script>
  <!-- Iconify Font js -->
  <script src="{{ asset('wowdash/assets/js/lib/iconify-icon.min.js') }}"></script>
  <!-- jQuery UI js -->
  <script src="{{ asset('wowdash/assets/js/lib/jquery-ui.min.js') }}"></script>
  <!-- Vector Map js -->
  <script src="{{ asset('wowdash/assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
  <script src="{{ asset('wowdash/assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- Popup js -->
  <script src="{{ asset('wowdash/assets/js/lib/magnifc-popup.min.js') }}"></script>
  <!-- Slick Slider js -->
  <script src="{{ asset('wowdash/assets/js/lib/slick.min.js') }}"></script>
  <!-- prism js -->
  <script src="{{ asset('wowdash/assets/js/lib/prism.js') }}"></script>
  <!-- file upload js -->
  <script src="{{ asset('wowdash/assets/js/lib/file-upload.js') }}"></script>
  <!-- audioplayer -->
  <script src="{{ asset('wowdash/assets/js/lib/audioplayer.js') }}"></script>

  <!-- main js -->
  <script src="{{ asset('wowdash/assets/js/app.js') }}"></script>

  {{-- <script src="{{ asset('wowdash/assets/js/homeOneChart.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
