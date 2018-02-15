@extends('layouts.base')

@section('body')
    <header class="main-header">
        <a href="/" class="logo">
            ORTO
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs valign-middle inline-block" style="line-height: 1">

                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">


                                <p>

                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Meus Dados</a>
                                </div>
                                <div class="pull-right">
                                    <form id="logout-form" action="#" method="post">
                                        {{ csrf_field() }}
                                        <button class="btn btn-default btn-flat" id = "sair">Sair</button>
                                    </form>
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
            <h1>@yield('title', 'ORTO')</h1>
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