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
        foreach ($lote->objetos as $objeto) {
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
                'avatar'=>'../imagenes/producto/'.$objeto->logo
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
?>