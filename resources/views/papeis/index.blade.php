@extends('layouts.app')

@section('title')
    {{ucfirst(str_replace(['-', '_'], ' ', $tipo))}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">


                </div>

                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped" style="width: 100%">
                        @section('table')
                        @show
                    </table>
                </div>
            </div>
        </div>
    </div>&nbsp;
@endsection
