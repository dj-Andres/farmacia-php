<?php
    include '../modelo/presentacion.php';
    $presentacion=new presentacion();
    //recibe los datos enviados del ajax//
    if($_POST['funcion']=='crear'){
        $nombre=$_POST['nombre_presentacion'];
        $presentacion->crear($nombre);
    }
    if($_POST['funcion']=='buscar'){
        $presentacion->buscar();
        $json=array();
        foreach ($presentacion->objetos as $objeto) {
            $json=array(
                'Id_presentacion'=>$objeto->Id_presentacion,
                'nombre'=>$objeto->presentacion
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
    if($_POST['funcion']=='borrar'){
        $id=$_POST['id'];            
        $presentacion->borrar($id);
    }
    if($_POST['funcion']=='actualizar'){
        $nombre=$_POST['nombre_presentacion'];
        $id_editado=$_POST['id_editado'];
        $presentacion->editar($nombre,$id_editado);
    }
    if($_POST['funcion']=='rellenar_presentacion'){
        $presentacion->rellenar_presentacion();
        $json=array();
        foreach($presentacion->objetos as $objeto){
            $json[]=array(
                'Id_presentacion'=>$objeto->Id_presentacion,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
?>