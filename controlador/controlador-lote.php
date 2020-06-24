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
?>