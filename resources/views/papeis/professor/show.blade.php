@extends('layouts.app')

@section('title')
    {{ ucfirst(str_replace(['-', '_'], ' ', $usuario->perfil->tipo))}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <table class="table">
                    <tr>
                        <th>Nome</th>
                        <td>{{$usuario->perfil->usuario->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$usuario->perfil->usuario->email}}</td>
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