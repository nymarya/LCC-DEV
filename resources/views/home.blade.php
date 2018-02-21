@extends('layouts.app')

@section('content')
    @include('paineis.' . \App\Facades\Perfil::tipo())
@endsection