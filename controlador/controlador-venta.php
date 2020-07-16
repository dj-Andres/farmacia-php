<?php
    
    include '../modelo/ventas.php';
    $venta=new ventas();
    //recibe los datos enviados del ajax//
    if($_POST['funcion']=='listar'){
        $venta->buscar();

        $json=array();
        
        foreach ($venta->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
?>