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

@if(Session::get('message')== "El Material se actualizo Corectamente")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Session::get('message')== "El Material se Elimino Corectamente")
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
  <div class="col-12" style="text-align: right;">
    <button class="btn butt" data-toggle="modal" data-target="#agregarMat">Agregar</button>
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
<tr class="marca" onclick="pasar_id({{$material->id}});">
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
    <div class="col-md-12" style="margin-bottom: 20px;">
<input type="text" name="nombre" class="form-control" style="border-color: orange" placeholder="Nombre">
    </div>
</div>
<div class="row">
<div class="col-md-6" style="margin-bottom: 20px;">
<input type="number" name="costo" id="costo" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Costo" onchange="operacion();" onkeyup="operacion();">
</div>
<div class="col-md-6" style="margin-bottom: 20px;">
<input type="number" name="unidades" id="unidades" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Unidades" onchange="operacion();" onkeyup="operacion();">
</div>
</div>
<div class="row">
    <div class="col-md-6" style="margin-bottom: 20px;">
    <input type="number" name="uso_unidad" id="uso_unidad" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Uso por unidad" onchange="operacion();" onkeyup="operacion();">
    </div>
    <div class="col-md-6" style="margin-bottom: 20px;">
    <input type="number" name="costo_uso" id="costo_uso" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Costo por uso" readonly>
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

  <!--menu de opciones de la tabla-->
  <div id="menu_opciones" class="visible_off " style=" padding: 25px; background-color: #66697569;">

    <button type="button" class="close" style="margin-right: -17px; margin-top: -20px;" onclick="cerrar_menu();">
       <i class="fas fa-times fa-xs"></i>
    </button>
  <button class="btn btn-warning form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#eliminar_mate" onclick="date_mat();">
    Eliminar
  </button>
  <br>
  <button type="button" class="btn btn-info form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#editar_mate" onclick="update_mat()">
    Editar
  </button>

</div>

<!-- modal de eliminar material-->
<div class="modal fade" id="eliminar_mate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar Material</h5>
        </div>
        <form action="{{Route('mate_delete')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              <label style="font-family: cursive; font-size: 30px; display:flex; justify-content: center;align-items: center; height: 100%;">¿Quieres Eliminar el Material?</label><br>
                <div style="text-align: center;">
                    <label style="font-family: cursive; font-size: 30px;" id="labeleliminar"></label>
                     </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_mate" id="id_mate">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger" >Eliminar</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- modal de editar material-->
<div class="modal fade" id="editar_mate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
        </div>
        <form action="{{route('mate_update')}}" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                <input type="text" name="nombre" id="nombre" class="form-control" style="border-color: orange" placeholder="Nombre">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6" style="margin-bottom: 20px;">
                <input type="number" name="costo" id="costoE" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Costo" onchange="operacion2();" onkeyup="operacion2();">
                </div>
                <div class="col-md-6" style="margin-bottom: 20px;">
                <input type="number" name="unidades" id="unidadesE" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Unidades" onchange="operacion2();" onkeyup="operacion2();">
                </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 20px;">
                    <input type="number" name="uso_unidad" id="uso_unidadE" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Uso por unidad" onchange="operacion2();" onkeyup="operacion2();">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 20px;">
                    <input type="number" name="costo_uso" id="costo_usoE" class="form-control" style="border-color: orange" pattern="^[0-9]" min="0" step="0.01" placeholder="Costo por uso" readonly>
                    </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_mate2" id="id_mate2">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" >Editar</button>
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
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] { -moz-appearance:textfield; }
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
    .visible_on{
        display: block;
        position: fixed;
        background: white;
        border-radius: 15px;
        width: auto;
    }
    .visible_off{
        display: none;
    }
    .paginate_button{
    position:sticky;
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

function operacion2(){
try {
    var costo=parseFloat(document.getElementById("costoE").value),
        uni=parseFloat(document.getElementById("unidadesE").value),
        uso=parseFloat(document.getElementById("uso_unidadE").value);
if(costo && uni && uso){
    var costouso=(costo/uni/uso);
document.getElementById("costo_usoE").value=costouso.toFixed(2);
}else{
    document.getElementById("costo_usoE").value=0;
}
} catch (error) {
}}

//jquery para desvanecer el mensage
$(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});

//cuadro de opciones
var id_material=null;
    function pasar_id($id_tr) {

        id_material=$id_tr;
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        menu_opciones.style.top=coordenadas_y-50+"px";
        menu_opciones.style.left=coordenadas_x-50+"px";
        menu_opciones.classList.add("visible_on");
        menu_opciones.classList.remove("visible_off");
      //alert($id_tr);
    }
    menu_opciones.addEventListener("mouseleave",function(){
          menu_opciones.classList.remove("visible_on");
          menu_opciones.classList.add("visible_off");
    });
    function cerrar_menu(){
        menu_opciones.classList.remove("visible_on");
        menu_opciones.classList.add("visible_off");
    }

  function date_mat(){
    $.ajax({
  url: "{{url('/search_material')}}"+'/'+id_material,
  dataType: "json",
  //context: document.body
}).done(function(datosMat) {

  if(datosMat==null){
    document.getElementById("labeleliminar").innerHTML=null;
    document.getElementById("id_mate").value=null;
  }else{
    document.getElementById("labeleliminar").innerHTML=datosMat.Nombre;
    document.getElementById("id_mate").value=datosMat.id;
  }
});
  }

 function update_mat(){
    $.ajax({
  url: "{{url('/search_material')}}"+'/'+id_material,
  dataType: "json",
  //context: document.body
}).done(function(datosMat) {

  if(datosMat==null){
    document.getElementById("nombre").value=null;
    document.getElementById("costoE").value=null;
    document.getElementById("unidadesE").value=null;
    document.getElementById("uso_unidadE").value=null;
    document.getElementById("costo_usoE").value=null;
    document.getElementById("id_mate2").value=null;
  }else{
    document.getElementById("nombre").value=datosMat.Nombre;
    document.getElementById("costoE").value=datosMat.Costo;
    document.getElementById("unidadesE").value=datosMat.Unidades;
    document.getElementById("uso_unidadE").value=datosMat.Uso_de_unidad;
    document.getElementById("costo_usoE").value=datosMat.Costo_por_uso;
    document.getElementById("id_mate2").value=datosMat.id;
  }
});
 }

</script>

@stop
