@extends('adminlte::page')

@section('title', 'Materiales')

@section('content_header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@section('content')
<br>
<div class="card">
    <div class="card-body">

 <!--alertas -->

@if (Session::has('message'))
<br>

@if(Session::get('message')== "El Material se Agrego Corectamente")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@endif

  <div class="row">
    <div class="col-12">
   <h3>Materiales</h3>
  </div>
  </div>

  <div class="row">
  <div class="col-12">
    <button class="btn butt" style="width: 15%;float: right;"  data-toggle="modal" data-target="#agregarMat">Agregar</button>
  </div>
</div>
<br>

<div class="table-responsive">
    <table class="table" style="width: 100%">
        <thead class="thead-light">
          <tr>
            <th style="text-align: center;">Nombre</th>
            <th style="text-align: center;">Costo</th>
            <th style="text-align: center;">Unidades</th>
            <th style="text-align: center;">Uso por unidad</th>
            <th style="text-align: center;">Costo por uso</th>
          </tr>
        </thead>
        <tbody>
@foreach ($materiales as $material)
<tr class="marca">
    <td style="text-align: center;">{{$material->Nombre}}</td>
    <td style="text-align: center;">{{$material->Costo}}</td>
    <td style="text-align: center;">{{$material->Unidades}}</td>
    <td style="text-align: center;">{{$material->Uso_de_unidad}}</td>
    <td style="text-align: center;">{{$material->Costo_por_uso}}</td>
</tr>
@endforeach
        </tbody>
      </table>

</div>

<!-- Modal -->
<div class="modal fade" id="agregarMat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar un Nuevo Material</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{Route('save_mate')}}" method="POST">
            @csrf
        <div class="modal-body">

<div class="row">
    <div class="col-md-12">
<input type="text" name="nombre" class="form-control" style="border-color: orange" placeholder="Nombre">
    </div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<input type="number" name="costo" id="costo" class="form-control" style="border-color: orange" min="0" step="0.01" placeholder="Costo" onchange="operacion();">
</div>
<div class="col-md-6">
<input type="number" name="unidades" id="unidades" class="form-control" style="border-color: orange" min="0" step="0.01" placeholder="Unidades" onchange="operacion();">
</div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
    <input type="number" name="uso_unidad" id="uso_unidad" class="form-control" style="border-color: orange" min="0" step="0.01" placeholder="Uso por unidad" onchange="operacion();">
    </div>
    <div class="col-md-6">
    <input type="number" name="costo_uso" id="costo_uso" class="form-control" style="border-color: orange" min="0" step="0.01" placeholder="Costo por uso" readonly>
    </div>
    </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button class="btn butt">Agregar</button>
        </div>
    </form>
      </div>
    </div>
  </div>


    </div>
</div>


@stop

@section('css')

<style>
    .butt{

        border-radius:10px;
        color:white;
        background:rgba(255, 166, 0, 0.986);
    }
    .marca{
        transition: 1s;
    }
    .marca:hover{
        background: #797d8b80;
        transition: 1s;
    }
</style>

@stop

@section('js')

<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script>
    //funcion de la tabla de boostrap tenga paginador y buscador
  $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });
  });


function operacion(){
try {
    var costo=parseFloat(document.getElementById("costo").value),
        uni=parseFloat(document.getElementById("unidades").value),
        uso=parseFloat(document.getElementById("uso_unidad").value);
if(costo && uni && uso){
    var costouso=(costo/uni/uso);
document.getElementById("costo_uso").value=costouso.toFixed(2);
}else{
    document.getElementById("costo_uso").value=0;
}
} catch (error) {
}}

//jquery para desvanecer el mensage
$(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
</script>

@stop
