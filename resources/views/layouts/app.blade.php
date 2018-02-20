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
                            <img src="{{ asset(auth()->user()->avatar) }}" class="user-image">
                            <span class="hidden-xs valign-middle inline-block" style="line-height: 1">
                                {{ auth()->user()->name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset(auth()->user()->avatar) }}" class="img-circle">

                                <p>
                                    {{ auth()->user()->name }}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('perfil') }}" class="btn btn-default btn-flat">Meus Dados</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sair</a>
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