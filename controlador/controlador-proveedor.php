<?php 
    include_once '../modelo/proveedor.php';
    
    $proveedor=new proveedor();
    if($_POST['funcion']=='crear'){
        $nombre=$_POST['nombre'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $direccion=$_POST['direccion'];
        $avatar='proveedor.png';
        $proveedor->crear($nombre,$telefono,$correo,$direccion,$avatar);
    }
    if($_POST['funcion']=='buscar'){
        $proveedor->buscar();
        $json=array();
        foreach ($proveedor->objetos as $objeto) {
            $json[]=array(
                'Id_proveedor'=>$objeto->Id_proveedor,
                'telefono'=>$objeto->telefono,
                'correo'=>$objeto->correo,
                'direccion'=>$objeto->direccion,
                'avatar'=>'../imagenes/proveedor/'.$objeto->avatar
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
?>