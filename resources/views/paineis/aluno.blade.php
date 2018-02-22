<div class="row">
    <div class="col-md-6">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-green">
                <h3 class="widget-user-username no-margin">Turmas Virtuais</h3>
            </div>
            @if(count(\App\Facades\Perfil::papel()->turmas))
                <div class="box-footer no-padding">
                    <table class="table no-margin table-bordered">
                        <tbody><tr>
                            <th>Disciplina</th>
                            <th>Prova</th>
                        </tr>

                        @foreach(\App\Facades\Perfil::papel()->turmas as $diario)
                            <tr>
                                <td><a href="{{ route('turmas.show', $diario->id) }}">
                                        <h5 class="no-margin">{{ $diario->codigo }}</h5>
                                    </a>
                                </td>
                                <td><a href="#">
                                        <h5 class="no-margin">Iniciar</h5>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="box-body">
                    Não há registros disponíveis.
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-blue">
                <h3 class="widget-user-username no-margin">Provas</h3>
            </div>
            @if(count(\App\Models\Nota::where('aluno_id',\App\Facades\Perfil::papel()->id)->get()))
                <div class="box-footer no-padding">
                    <table class="table no-margin table-bordered">
                        <tbody><tr>
                            <th>Turma</th>
                            <th>Nota</th>

                        </tr>
                        @foreach(\App\Models\Nota::where('aluno_id',\App\Facades\Perfil::papel()->id)->get() as $nota)
                            <tr>
                                <td>{{$nota->prova->turma->codigo}}
                                </td>
                                <td>{{$nota->nota}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="box-body">
                    Não há registros disponíveis.
                </div>
            @endif
        </div>
    </div>
</div>