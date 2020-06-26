<?php
    include_once '../modelo/lote.php';
        
    $lote=new lote();

    if($_POST['funcion']=='crear_lote'){
        $id_producto=$_POST['id_producto'];
        $proveedor=$_POST['proveedor'];
        $stock=$_POST['stock'];
        $vencimiento=$_POST['vencimiento'];
        $lote->crear($id,$proveedor,$stock,$vencimiento);
    }
    if($_POST['funcion']=='buscar'){
        $lote->buscar();
        $json=array();
        //funcion para determinar la fecha de vencimiento de los productos//
        $fecha_actual= new DateTime();
        foreach ($lote->objetos as $objeto) {
            $vencimiento=new DateTime($objeto->vencimiento);
            $diferencia=$vencimiento->diff($fecha_actual);
            $mes=$diferencia->m;
            $dia=$diferencia->d;
            $verificado=$diferencia->invert;
            if($verificado==0){
                $estado='danger';
            }else{
                if($mes>3){
                    $estado='ligth';
                    $mes=$mes*(-1);
                    $dia=$dia*(-1);
                }
                if($mes<=3){
                    $estado='warning';
                }
                //if($mes<=0 && $dia<=0){
                  //  $estado='danger';
                //}
            }
            $json[]=array(
                'Id_lote'=>$objeto->Id_lote,
                'stock'=>$objeto->stock,
                'vencimiento'=>$objeto->vencimiento,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'nombre'=>$nombre_producto,
                'laboratorio'=>$objeto->nombre_laboratorio,
                'presentacion'=>$objeto->presentacion,
                'proveedor'=>$objeto->nombre_proveedor,
                'avatar'=>'../imagenes/producto/'.$objeto->logo,
                'mes'=>$mes,
                'dia'=>$dia,
                'estado'=>$estado
                //'invert'=>$verificado
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
    if($_POST['funcion']=='editar'){
        $id_lote=$_POST['id'];
        $stock=$_POST['stock'];
        $lote->editar($id_lote,$stock);
    }
    if($_POST['funcion']=='borrar'){
        $id_lote=$_POST['id'];
        $lote->borrar($id_lote);
    }

?>