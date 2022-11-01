@extends('adminlte::page')

@section('title', 'DadaDent')

@section('content_header')

@section('content')


<div class="card-body">
<div style="text-align: center">
<img src="{{asset('img/LOGO.png')}}" width="35%" height="35%">
</div>

<div style="text-align: center; margin-top: 20px" >
    <img src="{{asset('img/dada.png')}}" width="23%" height="23%">
    </div>

    <div class="row" style="margin-top:20px">
        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <button class="btn btn btn-warning" style="width: 100%;">PDF Materiales</button>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-6">
                 <button class="btn btn btn-warning" style="width: 100%">PDF Procedimientos</button>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>



</div>

@stop

@section('css')

@stop

@section('js')

@stop
