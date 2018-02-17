@extends('layouts.app')

@section('title')
    {{ucfirst(str_replace(['-', '_'], ' ', $tipo))}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('planos.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-header">
                        {{ ucwords(str_replace(['-', '_'], ' ', $tipo)) }}
                        <a href="{{ route($tipo.'.create') }}" class="btn btn-xs btn-primary pull-right">
                            Adicionar {{ str_replace(['-', '_'], ' ', $tipo) }}
                        </a>

                    </div>

                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                @section('table')
                                    <th>Registro</th>
                                    <th>Opções</th>
                                @show
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection


@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

    <script>
        $("#motora_UTI").mask("##0.00", {reverse: true});
        $("#motora_APT").mask("##0.00", {reverse: true});
        $("#resp_UTI").mask("##0.00", {reverse: true});
        $("#resp_APT").mask("##0.00", {reverse: true});
    </script>
@endpush
