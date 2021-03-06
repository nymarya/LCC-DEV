@extends('layouts.app')

@section('title')
    Cadastrar prova
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        ucfirst(str_replace(['-', '_'], ' ', explode(".", Route::currentRouteName())[0])) => route(explode(".", Route::currentRouteName())[0] . '.index'),
        'Cadastrar prova' => route(Route::currentRouteName()),
       ],
   ])
@endsection

@push('stylesheets')
    <link href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet" />

@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route('provas.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-body">
                        <div class="required form-group{{ $errors->has('turma_id') ? ' has-error' : '' }}">
                            <label for="turma_id">Turma</label>
                            <select class="form-control" name="turma_id">
                                <option value="" {{ ! old('turma_id') ? ' selected' : '' }}>Selecione uma
                                    opção
                                </option>
                                @foreach($turmas as $turma)
                                    <option value="{{$turma->id}}">{{$turma->codigo}}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('turma_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('turma_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required form-group{{ $errors->has('questao') ? ' has-error' : '' }}">

                            @foreach($assuntos as $assunto)
                                <label for="questoes">Questões de {{$assunto->assunto}}</label>
                                <select class="multiple-select form-control select2-input" name="questoes['{{$assunto->id}}'][]" id="questoes" multiple="multiple">

                                @foreach ($assunto->questoes as $questao)
                                    <option value="{{ $questao->id }}">{{ $questao->questao }}</option>
                                @endforeach
                                </select>

                            @endforeach

                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('professores.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação do usuario?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection

@push('scripts')
<script src="{{asset('plugins/jquery.min.js')}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('plugins/select2/js/i18n/pt-BR.js') }}"></script>
<script src="{{asset('plugins/moment.js')}}"></script>

<script>
    $(document).ready(function () {
        $('.multiple-select').select2({
            tags: true,
            tokenSeparators: [',', ' ', ';'],
            width: '100%'
        });
    });
</script>

@yield('script')
@endpush
