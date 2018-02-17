@extends('layouts.app')

@section('title')
    {{ ucfirst(str_replace(['-', '_'], ' ', $usuario->perfil->tipo))}}
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        ucfirst(str_replace(['-', '_'], ' ', explode(".", Route::currentRouteName())[0])) => route(explode(".", Route::currentRouteName())[0] . '.index'),
        $usuario->perfil->usuario->nome => route(Route::currentRouteName(), $usuario->id),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <table class="table">
                    <tr>
                        <th>Nome</th>
                        <td>{{$usuario->perfil->usuario->nome}}</td>
                    </tr>
                    <tr>
                        <th>CPF</th>
                        <td>{{$usuario->perfil->usuario->cpf}}</td>
                    </tr>
                    <tr>
                        <th>RG</th>
                        <td>{{$usuario->perfil->usuario->rg}}</td>
                    </tr>
                    <tr>
                        <th>Data de nascimento</th>
                        <td>{{$usuario->perfil->usuario->data_nascimento->format('d/m/Y')}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$usuario->perfil->usuario->email}}</td>
                    </tr>
                    <tr>
                        <th>Telefone</th>
                        <td>{{$usuario->perfil->usuario->telefone}}</td>
                    </tr>
                    <tr>
                        <th>Passaporte</th>
                        <td>{{$usuario->perfil->usuario->passaporte}}</td>
                    </tr>
                </table>
                <div class="box-footer">
                    <a href="{{ route($usuario->getTable() . '.index') }}" class="btn btn-xs btn-primary pull-right">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection