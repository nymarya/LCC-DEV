@extends('layouts.app')

@section('title')
    Responder prova
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="#" method="post">
                {{ csrf_field() }}
                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        @foreach(\App\Models\Questao::take(10)->get() as $questao)
                        <div class="form-group">
                            <label>PERGUNTA?</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Option one is this and that&mdash;be sure to include why it's great
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option two can be something else and selecting it will deselect option one
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Option one is this and that&mdash;be sure to include why it's great
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option two can be something else and selecting it will deselect option one
                                </label>
                            </div>
                        </div>
                            @endforeach
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="#" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a realização da prova?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection
