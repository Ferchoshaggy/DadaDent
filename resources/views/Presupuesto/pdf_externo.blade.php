<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRESUPUESTO EXTERNO</title>
    <link href="https://fonts.cdnfonts.com/css/letter-gothic-std-2?styles=29995" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
</head>
<style type="text/css">
    @import url('https://fonts.cdnfonts.com/css/letter-gothic-std-2?styles=29995');
    
    *{
        margin: 0;
        padding: 0;
            
        }

    body{   

        
        font-size: 15px;
        font-family: 'Letter Gothic Std', sans-serif;
        padding-top: 225px;
        padding-bottom: 75px;
        padding-right: 50px;
        padding-left: 50px;
        margin: 0;
        background-color: rgb(255, 255, 255);
        background-image: url(./formatos/Formato externo.png);
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center center; background-attachment: fixed; 
    }

    header{
        //background-color: darkblue;
        /*height: 1615px;*/
        
    }

    .linea {
        padding-top: 20px;
        padding-bottom: 20px;
        border-bottom: 2px solid #cccccc;
    }
</style>
<body>

<header>
    <div style="margin-top: -40px;  font-size: 20px; position: absolute;">
        <div style=" ">
            Presupuesto
        </div>
        <div style="margin-top: -24px; margin-left: 540px; text-align: center;  position: absolute; width: 180px;">
            Fecha: {{$presupuesto->fecha}}
        </div>
    </div>
    <li style="margin-top: -6px; background-color: gray; width: 715px; list-style: none; height: 2px; position: absolute;"></li>
    

    <table class="table" style=" width: 100%; text-align: left;border-collapse:collapse; margin-top: 20px;">
        <tbody>
            <tr>
                <td style="width: 400px; font-size: 20px;">
                    <div style="word-wrap: break-word; width: 380px;">Nombre: {{$presupuesto->nombre}}</div>
                </td>
                <td style="font-size: 20px;">Edad: {{$presupuesto->edad}}</td>
                <td style="text-align: right; font-size: 20px;">
                    Sexo: 
                    @if($presupuesto->id_sexo=="1")
                        Masculino
                    @else
                        Femenino
                    @endif
                </td>
            </tr>
        </tbody>
        
    </table>
    @if($presupuesto->id_tipo=="1")
    <div style="margin-top: 40px; text-align: center;">
        <img src="{{url('/formatos/Permanentes.png')}}" style="width: 55%; height: auto;">
    </div>
    @endif
    @if($presupuesto->id_tipo=="2")
    <div style="margin-top: 40px; text-align: center;">
        <img src="{{url('/formatos/Temporales.png')}}" style="width: 40%; height: auto;">
    </div>
    @endif
    @if($presupuesto->id_tipo=="3")
    <div style="margin-top: 40px; text-align: center;">
        <img src="{{url('/formatos/Mixtos.png')}}" style="width: 100%; height: auto;">
    </div>
    @endif
    <?php $existe_descuento="no"; ?>
    @foreach($presupuestos_procedimientos as $presupuesto_procedimiento)
    @if($presupuesto_procedimiento->descuento!=0 || $presupuesto_procedimiento->descuento!=null)
    <?php $existe_descuento="si"; ?>
    @break
    @endif
    @endforeach
    <table class="table" style=" width: 100%; text-align: left; border-collapse:collapse; margin-top: 60px;">
        <thead>
            <tr>
               <th style="width: 260px; text-align: left; font-weight: 0; padding-bottom: 20px;">Pieza</th>
               <th style="width: 190px; text-align: left; font-weight: 0; padding-bottom: 20px;">Tratamiento</th>
               <th style="text-align: left; font-weight: 0; padding-bottom: 20px;">Costo</th>
               @if($existe_descuento=="si")
               <th style="text-align: left; font-weight: 0; padding-bottom: 20px;">Descuento</th> 
               @endif
               
            </tr>
        </thead>
        <tbody>
            <?php $descuentos=0;$costos=0;$total=0;$total_costo=0;?>
            @foreach($presupuestos_procedimientos as $presupuesto_procedimiento)
            <tr>
                <td style="width: 260px;">
                    <div style="word-wrap: break-word; width: 240px;">
                        <?php $salir=0; ?>
                        @if($presupuesto->id_tipo=="1" && $presupuesto_procedimiento->id_ubicacion=="1")
                        @foreach($perma_supers as $perma_super)
                        @if($perma_super->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$perma_super->pz_dental}}
                        @break
                        @endif
                        @endforeach
                        @endif

                        @if($presupuesto->id_tipo=="1" && $presupuesto_procedimiento->id_ubicacion=="2")
                        @foreach($perma_infers as $perma_infer)
                        @if($perma_infer->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$perma_infer->pz_dental}}
                        @break
                        @endif
                        @endforeach
                        @endif

                        @if($presupuesto->id_tipo=="2" && $presupuesto_procedimiento->id_ubicacion=="1")
                        @foreach($tempo_supers as $tempo_super)
                        @if($tempo_super->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$tempo_super->pz_dental}}
                        @break
                        @endif
                        @endforeach
                        @endif

                        @if($presupuesto->id_tipo=="2" && $presupuesto_procedimiento->id_ubicacion=="2")
                        @foreach($tempo_infers as $tempo_infer)
                        @if($tempo_infer->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$tempo_infer->pz_dental}}
                        @break
                        @endif
                        @endforeach
                        @endif


                        @if($presupuesto->id_tipo=="3" && $presupuesto_procedimiento->id_ubicacion=="1")
                        @foreach($perma_supers as $perma_super)
                        @if($perma_super->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$perma_super->pz_dental}}
                        <?php $salir=1; ?>
                        @break
                        @endif
                        @endforeach
                        @if($salir==0)
                        @foreach($tempo_supers as $tempo_super)
                        @if($tempo_super->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$tempo_super->pz_dental}}
                        @break
                        @endif
                        @endforeach
                        @endif
                        @endif


                        @if($presupuesto->id_tipo=="3" && $presupuesto_procedimiento->id_ubicacion=="2")
                        @foreach($perma_infers as $perma_infer)
                        @if($perma_infer->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$perma_infer->pz_dental}}
                        <?php $salir=1; ?>
                        @break
                        @endif
                        @endforeach
                        @if($salir==0)
                        @foreach($tempo_infers as $tempo_infer)
                        @if($tempo_infer->numero_asignado==$presupuesto_procedimiento->numero_asignado_pz)
                        {{$tempo_infer->pz_dental}}
                        @break
                        @endif
                        @endforeach
                        @endif
                        @endif

                        @if($presupuesto_procedimiento->id_ubicacion=="3")
                        Todos
                        @endif


                    </div>
                </td>
                <?php $costo=0; $ganancia=0;?>
                @foreach($procedimientos as $procedimiento)
                @if($procedimiento->id==$presupuesto_procedimiento->id_procedimiento)
                
                <td style="width: 190px; ">
                    <div style="word-wrap: break-word; width: 180px;">
                        {{$procedimiento->nombre}}
                    </div>
                </td>
                <td >
                    <div style="word-wrap: break-word; width: 95px;">
                        ${{$costo=$procedimiento->costo_publico}}
                        <?php
                            $descuentos+=($procedimiento->costo_publico*$presupuesto_procedimiento->descuento)/100;
                            $ganancia=$procedimiento->costo_publico-(($procedimiento->costo_publico*$presupuesto_procedimiento->descuento)/100); 
                        ?>
                    </div>
                </td>
                @break
                @endif
                @endforeach
                <?php 
                    $total+=$ganancia;
                    $total_costo+=$costo;
                ?>

                @if($existe_descuento=="si")
                <td >
                    @if($presupuesto_procedimiento->descuento==0 || $presupuesto_procedimiento->descuento==null)
                    0%
                    @else
                    {{round($presupuesto_procedimiento->descuento, 2)}}%
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
        
    </table>
    <p style=" margin-top: 20px; text-align: right;">Importe: ${{round($total_costo, 2)}}</p>
    @if($existe_descuento=="si")
    <p style="text-align: right;">Menos descuento de: ${{round($descuentos, 2)}}</p>
    @endif
    <p style="text-align: right;">Total: ${{$total}}</p>

    <div style="margin-top: 10px;">
        <p style="font-size: 20px;">Observaciones</p>
        <div style="word-wrap: break-word; width: 715px; margin-top:10px;">
            {{$presupuesto->observaciones}}
        </div>
    </div>
</header>


</body>

</html>



