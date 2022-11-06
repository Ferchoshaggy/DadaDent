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


        <div class="row">
            <div class="col-12">
           <h3>Procedimientos</h3>
          </div>
          </div>

          <div class="row">
          <div class="col-12" style="text-align: right;">
            <button class="btn butt"  data-toggle="modal" data-target="#agregarProce">Agregar</button>
          </div>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Costo</th>
                    <th style="text-align: center;">Costo a publico</th>
                    <th style="text-align: center;">No.materiales</th>
                    <th style="text-align: center;">Porcentaje de ganancia</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
        </div>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="agregarProce" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar un Nuevo Procedimiento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                <input type="text" name="nombre" class="form-control" style="border-color: orange" placeholder="Nombre">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                    <input type="number" class="form-control" placeholder="Costo" name="costo" id="costo" readonly style="border-color: orange">
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                    <input type="number" name="costo_public" id="costo_public" class="form-control" placeholder="Costo a Publico" style="border-color: orange" onchange="costo_publico(this);" onkeyup="costo_publico(this);">
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                    <input type="text" name="porcentaje" id="porcentaje" class="form-control" placeholder="Porcentaje de Ganancia" readonly style="border-color: orange">
                    </div>
                </div>
                <br>
                <div style="background: rgb(23 24 24 / 53%); border-radius:10px">
                    <label for="lista" style="color: #fff; margin-left: 10px;">Lista de Materiales</label>
                    <div  style="padding: 20px;">

                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label style="color: #fff;">Material</label>
                                    <select class="js-example-basic-single form-control" style="border-color: orange; width: 100%;" name="material0" id="material0" data-costo="" onchange="sacar_costo(this);" required>
                                        <option disabled value="" selected>.:selecciona:.</option>
                                        @foreach($materiales as $material)
                                        <option value="{{$material->id}}" >{{$material->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label style="color: #fff;">Usos</label>
                                    <input type="number" class="form-control" name="cantidad0" id="cantidad0" style="border-color: orange"  pattern="^[0-9]" min="0" onchange="costo_total();" onkeyup="costo_total();" required>
                                </div>
                                <div class="col-md-2" style="margin-bottom: 20px;">
                                    <button type="button" class="btn btn-success" style="font-size: 15px; font-weight: bold; margin-top: 32px;" onclick="mas_materiales();">+</button>
                                </div>
                            </div>

                            <div id="listado_padre">
                                
                            </div>

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

    .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: orange !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid orange !important;
    }

    .select2-selection__rendered {
      line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
          height: 35px !important;
    }
    .select2-selection__arrow {
          height: 34px !important;
    }
    
    .select2-selection__rendered{
        margin-top: -5px !important;
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
    //funcion de la tabla de boostrap tenga paginador y buscador
  $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });

    $('.js-example-basic-single').select2({
        dropdownParent: $('#agregarProce .modal-body')
    });

    
  });
  var j=1;
    function mas_materiales(){
        
          
        $("#listado_padre").append(

            '<div class="row" id="fila_hija'+j+'">'+
                '<div class="col-md-6" style="margin-bottom: 20px;">'+
                    '<label style="color: #fff;">Material</label>'+
                    '<select class="js-example-basic-single form-control" style="border-color: orange; width: 100%;" name="material'+j+'" id="material'+j+'"  onchange="sacar_costo(this);" data-costo="" required>'+
                        '<option disabled value="" selected>.:selecciona:.</option>'+
                        '@foreach($materiales as $material)'+
                        '<option value="{{$material->id}}" >{{$material->Nombre}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</div>'+
                '<div class="col-md-4" style="margin-bottom: 20px;">'+
                    '<label style="color: #fff;">Usos</label>'+
                    '<input type="number" class="form-control" name="cantidad'+j+'" id="cantidad'+j+'" style="border-color: orange"  pattern="^[0-9]" min="0" onchange="costo_total();" onkeyup="costo_total();" required>'+
                '</div>'+
                '<div class="col-md-2" style="margin-bottom: 20px;">'+
                    '<button type="button" class="btn btn-danger eliminar_hijo" style="font-size: 15px; font-weight: bold; margin-top: 32px;" id="'+j+'">-</button>'+
                '</div>'+
            '</div>'

        );
        j++;
        //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
        $('.js-example-basic-single').select2({
            dropdownParent: $('#agregarProce .modal-body')
        });
        
        

    }

    $(document).on('click', '.eliminar_hijo', function(){
        var id=$(this).attr("id"); 
        $('#fila_hija'+id+'').remove();
    });

    function sacar_costo(select){

        if (select.value!=null && select.value!=0){


            $.ajax({
              url: "{{url('/search_material')}}"+'/'+select.value,
              dataType: "json",
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

        detectar_igual(select);
    }

    function detectar_igual(select){

        
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

        document.getElementById("costo").value=costo_total;
    }

    function costo_publico(input){
        var costo_1=document.getElementById("costo").value;
        document.getElementById("porcentaje").value=((input.value*100)/costo_1).toFixed(0)+"%";
    }
</script>

@stop
