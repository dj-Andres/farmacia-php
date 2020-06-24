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
    if($_POST['funcion']=='cambiar_avatar'){
        $id=$_POST['id_logo_prov'];
        $avatar=$_POST['avatar'];
        if(($_FILES['foto']['type']=='image/jpeg') || ($_FILES['foto']['type']=='image/png') || ($_FILES['foto']['type']=='image/gif')){
            $nombre_foto=uniqid().'-'.$_FILES['foto']['name'];
            //echo $nombre_foto;
            //creamos una ruta//
            $ruta='..imagenes/proveedor/'.$nombre_foto;
            move_uploaded_file($_FILES['foto']['tpm_name'],$ruta);
            $proveedor->cambiar_logo($id,$nombre_foto);
            foreach($proveedor->objetos as $objeto){
                if($avatar!='../imagenes/proveedor/proveedor.png'){
                    unlink($avatar);
                }
            }
            $json=array();
            $json=array(
                  'ruta'=>$ruta,
                  'alert'=>'editado'
            );
            $jsonstring=json_encode($json[0]);
            echo $jsonstring;
          }else{
            $json=array();
            $json=array(
                  'alert'=>'no-editado'
            );
            $jsonstring=json_encode($json[0]);
            echo $jsonstring;
          }
    }
    if($_POST['funcion']=='borrar'){
        $id=$_POST['id'];            
        $proveedor->borrar($id);
    }
    if($_POST['funcion']=='editar'){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $direccion=$_POST['direccion'];
        $correo=$_POST['correo'];
        $telefono=$_POST['telefono'];
        $proveedor->editar($id,$nombre,$correo,$telefono,$direccion);
    }
    if($_POST['funcion']=='rellenar_proveedores'){
        $proveedor->rellenar_proveedor();
        $json=array();
        foreach($proveedor->objetos as $objeto){
            $json[]=array(
                'Id_proveedor'=>$objeto->Id_proveedor,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
?>