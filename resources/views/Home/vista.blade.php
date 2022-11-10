@extends('adminlte::page')

@section('title', 'DadaDent')

@section('content_header')

@section('content')


<div class="card-body">
<div style="text-align: center">
<img src="{{asset('img/LOGO.png')}}" width="35%" height="auto">
</div>

<div style="text-align: center; margin-top: 20px" >
    <img src="{{asset('img/dada.png')}}" width="23%" height="auto">
    </div>

    <div class="row" style="margin-top:20px">
        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-6">
                    <button class="btn" style="width: 100%; border-radius:10px; color:white; background-color: #D6802E;" data-toggle="modal" data-target="#pdf_materiales">PDF Materiales</button>
                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-6">
                 <button class="btn" style="width: 100%; border-radius:10px; color:white; background-color: #D6802E;" data-toggle="modal" data-target="#pdf_procedimientos">PDF Procedimientos</button>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>

</div>

<!-- modal de pdf materiales-->
<div class="modal fade" id="pdf_materiales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PDF Materiales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; SI NO SE DESCARGO PRECIONA EL BOTON!</p>
                <a class="btn btn-success" target="_blank" href="{{url('/pdf_materiales')}}" >¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="{{url('/pdf_materiales')}}" style="width:100%; height: 600px;" >
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- modal de pdf procedimientos-->
<div class="modal fade" id="pdf_procedimientos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PDF Procedimientos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; SI NO SE DESCARGO PRECIONA EL BOTON!</p>
                <a class="btn btn-success" target="_blank" href="{{url('/pdf_procedimientos')}}" >¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="{{url('/pdf_procedimientos')}}" style="width:100%; height: 600px;" >
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>
@stop

@section('css')

@stop

@section('js')

<script type="text/javascript">

    //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        document.getElementById("no_se_mira").style.display="block";
    }else{
        document.getElementById("no_se_mira").style.display="none";
    }
</script>
@stop
