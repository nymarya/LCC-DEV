@extends('layouts.base')

@section('body')
    <header class="main-header">
        <a href="/" class="logo">
            <b>Fisio</b>CENTRO
        </a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

@section('sidebar')
    <aside class="main-sidebar">
        <section class="sidebar">
            @include('layouts.menu')
        </section>
    </aside>
@show

<div class="content-wrapper">
    @if(isset($success)) <p class="bg-success">{{ $success }}</p> @endif
    @include("partials.system_alerts")
    <section class="content-header">
        @section('header')
            <h1>@yield('title', 'FisioCENTRO')</h1>
        @show
    </section>

    <section class="content">
        @if(config('app.debug'))
            <div class="callout bg-black text-yellow">
                <h5>O Sistema está rodando em ambiente de desenvolvimento</h5>
            </div>
        @endif
        @yield('content')
    </section>
</div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <strong>Versão</strong> 0.0.1
        </div>
    </footer>
@endsection
@push('scripts')

@endpush