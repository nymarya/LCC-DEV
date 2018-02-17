@extends('papeis.index')

@section('table')
    @forelse($pacientes as $paciente)
        <td class="col-md-8"> {{$paciente->registro}}</td>
        <td class="col-md-4">
            <a class="btn btn-primary">
                Opções
            </a>
        </td>
    @empty
    Nenhum paciente cadastrado.
    @endforelse
@show

