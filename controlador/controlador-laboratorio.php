<?php
    include '../modelo/laboratorio.php';
    $laboratorio=new laboratorio();
    //recibe los datos enviados del ajax//
    if($_POST['funcion']=='crear'){
        $nombre=$_POST['nombre_laboratorio'];
        $avatar='laboratorio.png';
        $laboratorio->crear($nombre,$avatar);
    }
    if($_POST['funcion']=='buscar'){
        $laboratorio->buscar();
        $json=array();
        foreach ($laboratorio->objetos as $objeto) {
            $json=array(
                'Id_laboratorio'=>$objeto->Id_laboratorio,
                'nombre'=>$objeto->nombre,
                'avatar'=>'../imagenes/'.$objeto->avatar
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
?>