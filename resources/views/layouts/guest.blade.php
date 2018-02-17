<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="O Sistema de Gestão Acadêmica da Rede de Escolas Técnicas do SUS (RET-SUS)." name="description">
    <meta content="Laboratório de Inovação Tecnológica em Saúde" name="author">
    <meta content="retsus,ufrn,lais,academico,sistema,gestao,escolar" name="keywords">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RET-SUS') | {{ config('app.name', 'RET-SUS') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    @stack('stylesheets')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

    @yield('content')



<!-- Scripts -->
<script src="/js/app.js"></script>
@stack('scripts')
</html>
