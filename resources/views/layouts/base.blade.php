<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="FisioCentro" name="description">
    <meta content="Kathleen e Italo" name="author">
    <meta content="Fisioterapia" name="keywords">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FisioCENTRO') | {{ config('app.name', 'FisioCENTRO') }}</title>

    <!-- Styles -->
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('/css/skin-red.min.css')}}">
@stack('stylesheets')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="skin-red fixed">
<div id="app" class="wrapper">
    @yield('body')
</div>

<!-- Scripts -->
<script src="{{asset('/js/app.js')}}"></script>
<script src="{{ asset ("/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
@stack('scripts')
</body>
</html>
