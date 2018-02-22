@extends('layouts.app')

@section('title')
    Cadastrar oferta de turma
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        "Turmas" => route('turmas.index'),
        "Cadastrar oferta de turma"=> route('turmas.create'),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('turmas.store') }}" method="post">
                {{ csrf_field() }}
                <div class="alert alert-warning alert-dismissible hidden" id="codigoRepetido">
                    <strong >Código de oferta de turma já utilizado, insira outro</strong>
                </div>
                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        <div class="required form-group codigo {{ $errors->has('codigo') ? ' has-error' : '' }}">
                            <label for="codigo">Código da Turma</label>
                            <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" maxlength="255"
                                   class="form-control">
                            @if ($errors->has('codigo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('turmas.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação de turma?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection
@push('scripts')
<script src="{{ asset('plugins/select2/i18n/pt-BR.js') }}"></script>
<script>

    $(function () {
        //Codigo responsável por verificar se o que é digitado
        // é igual a algum outro dado do banco

        $('#codigo').on('input', function () {
            codigo = $('#codigo').val();
            $('.codigo').removeClass('has-error');

            $.ajax({
                url: '/turmas/json/',
            }).done(function (data) {
                var json = data.data;
                for(var key in json){
                    if(codigo == json[key].codigo){
                        $('.codigo').addClass('has-error');
                        $('#codigoRepetido').removeClass('hidden');
                    }else{
                        $('#codigoRepetido').addClass('hidden');
                    }
                }
            });
        });

    });
</script>
@endpush
