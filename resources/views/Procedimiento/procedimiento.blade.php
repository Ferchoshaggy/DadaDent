@extends('adminlte::page')

@section('title', 'Procedimientos')

@section('content_header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
<br>
<div class="card">
    <div class="card-body">

@if (Session::has('message'))
<br>

@if(Session::get('message')== "Se Guardo Correctamente el Procedimiento")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Session::get('message')== "Se Actualizo Correctamente el Procedimiento")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Session::get('message')== "Se Elimino Correctamente el Procedimiento")
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
           <h3>Procedimientos</h3>
          </div>
          </div>

          <div class="row">
          <div class="col-12" style="text-align: right;">
            <button class="btn butt"  data-toggle="modal" data-target="#agregarProce" onclick="activar_select2_agregar();">Agregar</button>
          </div>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Inversión</th>
                    <th style="text-align: center;">Costo a publico</th>
                    <th style="text-align: center;">Utilidad</th>
                    <th style="text-align: center;">Porcentaje de ganancia</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($procedimientos as $procedimiento)
                    <tr class="marca" onclick="pasar_id({{$procedimiento->id}});">
                        <td style="text-align: center;">{{$procedimiento->nombre}}</td>
                        <td style="text-align: center;">${{$procedimiento->costo}}</td>
                        <td style="text-align: center;">${{$procedimiento->costo_publico}}</td>
                        <td style="text-align: center;">${{$procedimiento->costo_publico-$procedimiento->costo}}</td>
                        <td style="text-align: center;">{{$procedimiento->porcentaje}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

    </div>
</div>



<!-- Modal agregar-->
<div class="modal fade" id="agregarProce" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar un Nuevo Procedimiento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{url('/save_procedimiento')}}" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" style="border-color: #D6802E" placeholder="Nombre">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Inversión</label>

                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" class="form-control" placeholder="Inversión" name="costo" id="costo" readonly style="border-color: #D6802E;" >
                        </div>
                    
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Costo a Publico</label>

                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" class="form-control" placeholder="Costo a Publico" name="costo_public" id="costo_public" style="border-color: #D6802E;" onchange="costo_publico();" onkeyup="costo_publico();">
                        </div>
        
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Porcentaje de Ganancia</label>
                    <input type="text" name="porcentaje" id="porcentaje" class="form-control" placeholder="Porcentaje de Ganancia" readonly style="border-color: #D6802E;">
                    </div>
                </div>
                <br>
                <div style="background-color: #D9D9D9; border-radius:10px">
                    <label for="lista" style=" margin-left: 10px;">Lista de Materiales</label>
                    <div  style="padding: 20px;">

                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label >Material</label>
                                    <select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E;" name="material0" id="material0" data-costo="" onchange="sacar_costo(this);" required>
                                        <option disabled value="" selected>.:selecciona:.</option>
                                        @foreach($materiales as $material)
                                        <option value="{{$material->id}}" >{{$material->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label >Usos</label>
                                    <input type="number" class="form-control" name="cantidad0" id="cantidad0" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" onchange="costo_total();" onkeyup="costo_total();" required>
                                </div>
                                <div class="col-md-2" style="margin-bottom: 20px;">
                                    <button type="button" class="btn " style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; background-color: #2FB4D6; color: #fff; word-wrap: break-word;" onclick="mas_materiales();">Agregar</button>
                                </div>
                            </div>

                            <div id="listado_padre" style="overflow-y: auto; overflow-x: hidden;  width: 100%;" class="multiple">
                                
                            </div>

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <input type="hidden" name="numero_de_materiales" value="" id="numero_de_materiales">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button class="btn butt">Agregar</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal editar-->
<div class="modal fade" id="editarProce" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Procedimiento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{url('/update_procedimiento')}}" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <label>Nombre</label>
                <input type="text" name="nombre_edit" id="nombre_edit" class="form-control" style="border-color: #D6802E" placeholder="Nombre">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Inversión</label>

                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" class="form-control" placeholder="Inversión" name="costo_edit" id="costo_edit" readonly style="border-color: #D6802E;" >
                        </div>
                    
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Costo a Publico</label>

                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" class="form-control" placeholder="Costo a Publico" name="costo_public_edit" id="costo_public_edit" style="border-color: #D6802E;" onchange="costo_publico_edit();" onkeyup="costo_publico_edit();">
                        </div>
        
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Porcentaje de Ganancia</label>
                    <input type="text" name="porcentaje_edit" id="porcentaje_edit" class="form-control" placeholder="Porcentaje de Ganancia" readonly style="border-color: #D6802E;">
                    </div>
                </div>
                <br>
                <div style="background-color: #D9D9D9; border-radius:10px">
                    <label for="lista" style=" margin-left: 10px;">Lista de Materiales</label>
                    <div  style="padding: 20px;">

                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label >Material</label>
                                    <select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E;" name="material_edit0" id="material_edit0" data-costo="" onchange="sacar_costo_edit(this);" required>
                                        <option disabled value="" selected>.:selecciona:.</option>
                                        @foreach($materiales as $material)
                                        <option value="{{$material->id}}" >{{$material->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label >Usos</label>
                                    <input type="number" class="form-control" name="cantidad_edit0" id="cantidad_edit0" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" onchange="costo_total_edit();" onkeyup="costo_total_edit();" required>
                                </div>
                                <div class="col-md-2" style="margin-bottom: 20px;">
                                    <button type="button" class="btn " style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; background-color: #2FB4D6; color: #fff; word-wrap: break-word;" onclick="mas_materiales_edit();">Agregar</button>
                                </div>
                            </div>

                            <div id="listado_padre_edit" style="overflow-y: auto; overflow-x: hidden; width: 100%;" class="multiple">
                                
                            </div>

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_procedimiento" id="id_procedimiento">
                <input type="hidden" name="numero_de_materiales_edit" value="" id="numero_de_materiales_edit">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button class="btn btn-success">Editar</button>
            </div>
        </form>
      </div>
    </div>
  </div>


<!-- modal de eliminar procedimiento-->
<div class="modal fade" id="eliminar_procedimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar Procedimiento</h5>
        </div>
        <form action="{{url('/delete_procedimiento')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              <label style="font-family: cursive; font-size: 20px; display:flex; justify-content: center;align-items: center; height: 100%;">¿Quieres Eliminar el Procedimiento?</label><br>
                <div style="text-align: center;">
                    <label style="font-family: cursive; font-size: 25px;" id="labeleliminar"></label>
                     </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_procedimiento_delete" id="id_procedimiento_delete">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger" >Eliminar</button>
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
    <button class="btn btn-warning form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#eliminar_procedimiento" onclick="date_mat();">
        Eliminar
    </button>
    <br>
    <button type="button" class="btn btn-info form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#editarProce" onclick="activar_select2_editar();" >
        Editar
    </button>

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
        background-color: #D6802E;
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

    .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #D6802E !important;
        background-color: #D6802E;

    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white !important;
        
    }
    
    .select2-container--default .select2-selection--single {
        border: 1px solid #D6802E !important;
        color: white !important;
        
        background-color: #D6802E !important;
    }

    

    /*estos son para la flechita, se agrego otra ya que se ve mejor de color blanco*/
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      background-image: url(./img/f_abajo.png);
      background-color: transparent;
      background-size: contain;
      border: none !important;
      height: 20px !important;
      width: 20px !important;
      margin: auto !important;
      top: 8px !important;
      left: auto !important;
    }

    

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        transform: rotate(180deg) !important;
    }



</style>

@stop

@section('js')

<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- este es para el selected2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var allmat_ser=null;
    //funcion de la tabla de boostrap tenga paginador y buscador
  $(document).ready(function() {

    $.ajax({
      url: "{{url('/all_materiales')}}",
      dataType: "json",
      timeout : 80000,
      //context: document.body
    }).done(function(allmat) {

      if(allmat==null){
        allmat_ser=null;
      }else{
        allmat_ser=allmat;
      }
    });

    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });

    /*
    $('.js-example-basic-single').select2({
        dropdownParent: $('#agregarProce .modal-body')
    });

    $('.js-example-basic-single').select2({
        dropdownParent: $('#editarProce .modal-body')
    });
    */
    
  });

  function date_mat(){
    $.ajax({
      url: "{{url('/procedimiento_materialSearch')}}"+'/'+id_procedimiento,
      dataType: "json",
      timeout : 80000,
      //context: document.body
    }).done(function(materiales_pro) {

      if(materiales_pro==null){
        document.getElementById("labeleliminar").innerHTML=null;
        document.getElementById("id_procedimiento_delete").value=null;
      }else{
        document.getElementById("labeleliminar").innerHTML=materiales_pro[0].nombre;
        document.getElementById("id_procedimiento_delete").value=materiales_pro[0].id;
      }
    });
  }

  function activar_select2_agregar(){
    $('.js-example-basic-single').select2({
        dropdownParent: $('#agregarProce .modal-body')
    });
  }

  function activar_select2_editar(){

    $('.js-example-basic-single').select2({
        dropdownParent: $('#editarProce .modal-body')
    });

    llenar_datos();
  }

  //cuadro de opciones
    var id_procedimiento=null;
    function pasar_id($id_tr) {

        id_procedimiento=$id_tr;
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        document.getElementById("menu_opciones").style.top=coordenadas_y-50+"px";
        document.getElementById("menu_opciones").style.left=coordenadas_x-50+"px";
        document.getElementById("menu_opciones").classList.add("visible_on");
        document.getElementById("menu_opciones").classList.remove("visible_off");
      //alert($id_tr);
    }
    document.getElementById("menu_opciones").addEventListener("mouseleave",function(){
          document.getElementById("menu_opciones").classList.remove("visible_on");
          document.getElementById("menu_opciones").classList.add("visible_off");
    });
    function cerrar_menu(){
        document.getElementById("menu_opciones").classList.remove("visible_on");
        document.getElementById("menu_opciones").classList.add("visible_off");
    }

  //jquery para desvanecer el mensage
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });


  var j=1;
    function mas_materiales(){

        document.getElementById("listado_padre").style="overflow: hidden auto; width: 100%; max-height: 350px;";
        $("#listado_padre").append(

            '<div class="row" id="fila_hija'+j+'">'+
                '<div class="col-md-6" style="margin-bottom: 20px;">'+
                    '<label >Material</label>'+
                    '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%;" name="material'+j+'" id="material'+j+'"  onchange="sacar_costo(this);" data-costo="" required>'+
                        '<option disabled value="" selected>.:selecciona:.</option>'+
                        '@foreach($materiales as $material)'+
                        '<option value="{{$material->id}}" >{{$material->Nombre}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</div>'+
                '<div class="col-md-4" style="margin-bottom: 20px;">'+
                    '<label >Usos</label>'+
                    '<input type="number" class="form-control" name="cantidad'+j+'" id="cantidad'+j+'" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" onchange="costo_total();" onkeyup="costo_total();" required>'+
                '</div>'+
                '<div class="col-md-2" style="margin-bottom: 20px;">'+
                    '<button type="button" class="btn btn-danger eliminar_hijo" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; word-wrap: break-word;" id="'+j+'">Eliminar</button>'+
                '</div>'+
            '</div>'

        );
        j++;
        //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
        $('.js-example-basic-single').select2({
            dropdownParent: $('#agregarProce .modal-body')
        });

        document.getElementById("numero_de_materiales").value=j;
    }

    $(document).on('click', '.eliminar_hijo', function(){
        var id=$(this).attr("id"); 
        $('#fila_hija'+id+'').remove();
        document.getElementById("numero_de_materiales").value=j;
        costo_total();
    });

    function sacar_costo(select){

        if (select.value!=null && select.value!=0){


            $.ajax({
              url: "{{url('/search_material')}}"+'/'+select.value,
              dataType: "json",
              timeout : 80000,
            }).done(function(datosMat) {

              if(datosMat==null){
                alert("la base de datos esta fallando compa");
              }else{
               
                select.dataset.costo=datosMat.Costo_por_uso;

                for (var i = 0; i <j; i++) {

                    try{
                        var texto="material"+i;
                        if(document.getElementById("material"+i).value==select.value && select.id != texto){
                            select.value="";
                            select.dataset.costo=0; 
                            $("#"+select.id).val("").trigger('change');
                            alert("ya lo elegiste, para agregar mas solo incrementa los usos");
                            break;
                        }

                    
                    }catch (TypeError) {
                        console.log("no existe ese objeto con ese nombre");
                    }

                }
                costo_total();

                
              }
            });

        }

    }


    function costo_total(){
        var costo_total=null;
        var material=null;
        var costo=null;
        for (var i = 0; i <j; i++) {

            try{

                material=Number(document.getElementById("material"+i).dataset.costo);
                costo=Number(document.getElementById("cantidad"+i).value);
                costo_total+=(material*costo);
            
            }catch (TypeError) {
                console.log("no existe ese objeto con ese nombre");
            }

            
        }

        document.getElementById("costo").value=costo_total.toFixed(2);
        costo_publico();
    }

    function costo_publico(){
        var costo_1=document.getElementById("costo").value;
        var valor_input=document.getElementById("costo_public").value;
        if (costo_1<=0){
            document.getElementById("porcentaje").value=0+"%";
        }else{
            document.getElementById("porcentaje").value=(((valor_input*100)/costo_1)-100).toFixed(2)+"%";
        }
        
    }



    var j_2=1;


    function llenar_datos(){
        j_2=1;
        document.getElementById("listado_padre_edit").innerHTML="";
        $.ajax({
          url: "{{url('/procedimiento_materialSearch')}}"+'/'+id_procedimiento,
          dataType: "json",
          timeout : 80000,
        }).done(function(materiales_pro) {

          if(materiales_pro==null){
            alert("la base de datos esta fallando compa");
            document.getElementById("id_procedimiento").value=null;
          }else{
            document.getElementById("id_procedimiento").value=id_procedimiento;
            for (var i = 0; i <materiales_pro[1].length; i++) {

                if (i==0){

                    document.getElementById("nombre_edit").value=materiales_pro[0].nombre;
                    document.getElementById("costo_edit").value=materiales_pro[0].costo;
                    document.getElementById("costo_public_edit").value=materiales_pro[0].costo_publico;
                    document.getElementById("porcentaje_edit").value=materiales_pro[0].porcentaje;
                    document.getElementById("cantidad_edit0").value=materiales_pro[1][0].usos;
                    $("#material_edit0").val(materiales_pro[1][0].id_material).trigger('change');
                    //document.getElementById("material_edit0").value=;
                    



                }else{
                    document.getElementById("listado_padre_edit").style="overflow: hidden auto; width: 100%; max-height: 350px;";
                    $("#listado_padre_edit").append(

                        '<div class="row" id="fila_hija_edit'+j_2+'">'+
                            '<div class="col-md-6" style="margin-bottom: 20px;">'+
                                '<label >Material</label>'+
                                '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%;" name="material_edit'+j_2+'" id="material_edit'+j_2+'"  onchange="sacar_costo_edit(this);" data-costo="" required>'+
                                    '<option disabled value="" selected>.:selecciona:.</option>'+
                                    '@foreach($materiales as $material)'+
                                    '<option value="{{$material->id}}" >{{$material->Nombre}}</option>'+
                                    '@endforeach'+
                                '</select>'+
                            '</div>'+
                            '<div class="col-md-4" style="margin-bottom: 20px;">'+
                                '<label >Usos</label>'+
                                '<input type="number" class="form-control" name="cantidad_edit'+j_2+'" id="cantidad_edit'+j_2+'" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" onchange="costo_total_edit();" onkeyup="costo_total_edit();" required value="'+materiales_pro[1][i].usos+'">'+
                            '</div>'+
                            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                                '<button type="button" class="btn btn-danger eliminar_hijo_edit" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; word-wrap: break-word;" id="'+j_2+'">Eliminar</button>'+
                            '</div>'+
                        '</div>'

                    );
                    $("#material_edit"+i).val(materiales_pro[1][i].id_material).trigger('change');

                    j_2++;

                    //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
                    $('.js-example-basic-single').select2({
                        dropdownParent: $('#editarProce .modal-body')
                    });
                    document.getElementById("numero_de_materiales_edit").value=j_2;



                }


                //
            }
            //este solo lo agrego por si existe la primera consulta de todos los materiales, esto con fin de que no falle el ajax 
            if (allmat_ser!=null){
                costo_total_edit();
            }
            
          }
        });

    }


    function mas_materiales_edit(){

        document.getElementById("listado_padre_edit").style="overflow: hidden auto; width: 100%; max-height: 350px;";
        $("#listado_padre_edit").append(

            '<div class="row" id="fila_hija_edit'+j_2+'">'+
                '<div class="col-md-6" style="margin-bottom: 20px;">'+
                    '<label >Material</label>'+
                    '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%;" name="material_edit'+j_2+'" id="material_edit'+j_2+'"  onchange="sacar_costo_edit(this);" data-costo="" required>'+
                        '<option disabled value="" selected>.:selecciona:.</option>'+
                        '@foreach($materiales as $material)'+
                        '<option value="{{$material->id}}" >{{$material->Nombre}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</div>'+
                '<div class="col-md-4" style="margin-bottom: 20px;">'+
                    '<label >Usos</label>'+
                    '<input type="number" class="form-control" name="cantidad_edit'+j_2+'" id="cantidad_edit'+j_2+'" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" onchange="costo_total_edit();" onkeyup="costo_total_edit();" required>'+
                '</div>'+
                '<div class="col-md-2" style="margin-bottom: 20px;">'+
                    '<button type="button" class="btn btn-danger eliminar_hijo_edit" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; word-wrap: break-word;" id="'+j_2+'">Eliminar</button>'+
                '</div>'+
            '</div>'

        );
        j_2++;
        //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
        $('.js-example-basic-single').select2({
            dropdownParent: $('#editarProce .modal-body')
        });

        document.getElementById("numero_de_materiales_edit").value=j_2;
    }

    $(document).on('click', '.eliminar_hijo_edit', function(){
        var id=$(this).attr("id"); 
        $('#fila_hija_edit'+id+'').remove();
        document.getElementById("numero_de_materiales_edit").value=j_2;
        costo_total_edit();
    });



    function sacar_costo_edit(select) {
        if (allmat_ser==null){
            sacar_costo_edit_forma_1(select);
        }else{
            sacar_costo_edit_forma_2(select);
        }
    }

    function sacar_costo_edit_forma_2(select) {
        if (select.value!=null && select.value!=0){

            for (var i = 0; i<=allmat_ser.length; i++) {
                if(allmat_ser[i].id==select.value){
                    select.dataset.costo=allmat_ser[i].Costo_por_uso;
                    break;
                }
            }
               

            for (var i = 0; i <j_2; i++) {

                    try{
                        var texto="material_edit"+i;
                        if(document.getElementById("material_edit"+i).value==select.value && select.id != texto){
                            select.value="";
                            select.dataset.costo=0; 
                            $("#"+select.id).val("").trigger('change');
                            alert("ya lo elegiste, para agregar mas solo incrementa los usos");
                            break;
                        }

                    
                    }catch (TypeError) {
                        console.log("no existe ese objeto con ese nombre");
                    }

            }
        }
        costo_total_edit();
    }

    //esta es la primera forma, pero sera acompañada de otra por que no responde el ervidor, el nombre sera cambiado por que lo tendra otra funcion, el nombre es sacar_costo_edit(select)
    function sacar_costo_edit_forma_1(select){

        if (select.value!=null && select.value!=0){


            $.ajax({
              url: "{{url('/search_material')}}"+'/'+select.value,
              dataType: "json",
              timeout : 80000,
            }).done(function(datosMat) {

              if(datosMat==null){
                alert("la base de datos esta fallando compa");
              }else{
               
                select.dataset.costo=datosMat.Costo_por_uso;

                for (var i = 0; i <j_2; i++) {

                    try{
                        var texto="material_edit"+i;
                        if(document.getElementById("material_edit"+i).value==select.value && select.id != texto){
                            select.value="";
                            select.dataset.costo=0; 
                            $("#"+select.id).val("").trigger('change');
                            alert("ya lo elegiste, para agregar mas solo incrementa los usos");
                            break;
                        }

                    
                    }catch (TypeError) {
                        console.log("no existe ese objeto con ese nombre");
                    }

                }
                costo_total_edit();

                
              }
            });

        }

        //console.log(allmat_ser);

    }

    function costo_total_edit(){
        var costo_total=null;
        var material=null;
        var costo=null;
        for (var i = 0; i <j_2; i++) {

            try{

                material=Number(document.getElementById("material_edit"+i).dataset.costo);
                costo=Number(document.getElementById("cantidad_edit"+i).value);
                costo_total+=(material*costo);
            
            }catch (TypeError) {
                console.log("no existe ese objeto con ese nombre");
            }

            
        }

        document.getElementById("costo_edit").value=costo_total.toFixed(2);
        costo_publico_edit();
    }

    function costo_publico_edit(){
        var costo_1=document.getElementById("costo_edit").value;
        var valor_input=document.getElementById("costo_public_edit").value;
        if (costo_1<=0){
            document.getElementById("porcentaje_edit").value=0+"%";
        }else{
            document.getElementById("porcentaje_edit").value=(((valor_input*100)/costo_1)-100).toFixed(2)+"%";
        }
        
    }
</script>

@stop
