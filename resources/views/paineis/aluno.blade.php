<div class="row">
    <div class="col-md-12">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-green">
                <h3 class="widget-user-username no-margin">Turmas Virtuais</h3>
            </div>
            @if(count(\App\Facades\Perfil::recuperar()->turmas))
                <div class="box-footer no-padding">
                    <table class="table no-margin table-bordered">
                        <tbody><tr>
                            <th>Disciplina</th>
                            <th>Prova</th>
                        </tr>

                        @foreach(\App\Facades\Perfil::recuperar()->turmas as $diario)
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
</div>