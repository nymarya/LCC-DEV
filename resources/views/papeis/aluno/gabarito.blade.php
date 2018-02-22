@extends('layouts.app')

@section('title')
    Resultado prova
@endsection

@section('content')
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> LifeCycleCANVAS
                    <small class="pull-right">Date: 22/02/2018</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <strong>{{\App\Facades\Perfil::recuperar()->usuario->nome}}</strong><br>
                    Email: {{\App\Facades\Perfil::recuperar()->usuario->email}}<br>
                    {{\App\Facades\Perfil::papel()->turmas->first()->codigo}}<br>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Questão</th>
                        <th>Resposta certa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Bloco::where('prova_id',\App\Facades\Perfil::papel()
                    ->turmas->first()
                    ->provas->first()->id)->get() as $bloco)
                        <tr>
                            <td>{{$bloco->questao->questao}}</td>
                            <td>
                                @foreach($bloco->questao->alternativas as $alternativa)
                                    @if($alternativa->correta)
                                        {{$alternativa->alternativa}}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Acertos:</p>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Você acertou X questões!
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Resultado final:</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Acertos:</th>
                            <td>$250.30</td>
                        </tr>
                        <tr>
                            <th>Taxa de acertos:</th>
                            <td>80%</td>
                        </tr>
                        <tr>
                            <th>Resultado:</th>
                            <td>APROVADO</td>
                        </tr>

                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-success pull-right"> Voltar
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Gerar PDF
                </button>
            </div>
        </div>
    </section>
@endsection

