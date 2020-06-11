<?php
    include '../modelo/laboratorio.php';
    $laboratorio=new laboratorio();
    //recibe los datos enviados del ajax//
    if($_POST['funcion']=='crear'){
        $nombre=$_POST['nombre_laboratorio'];
        $avatar='laboratorio.jpg';
        $laboratorio->crear($nombre,$avatar);
    }
    if($_POST['funcion']=='buscar'){
        $laboratorio->buscar();
        $json=array();
        foreach ($laboratorio->objetos as $objeto) {
            $json=array(
                'Id_laboratorio'=>$objeto->Id_laboratorio,
                'nombre'=>$objeto->nombre,
                'avatar'=>'../imagenes/laboratorio/'.$objeto->avatar
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
    if($_POST['funcion']=='cambiar_logo'){
        $id=$_POST['id_logo-lab'];
        if(($_FILES['foto']['type']=='image/jpeg') || ($_FILES['foto']['type']=='image/png') || ($_FILES['foto']['type']=='image/gif')){
            $nombre_foto=uniqid().'-'.$_FILES['foto']['name'];
            //echo $nombre_foto;
            //creamos una ruta//
            $ruta='..imagenes/laboratorio/'.$nombre_foto;
            move_uploaded_file($_FILES['foto']['tpm_name'],$ruta);
            $laboratorio->cambiar_logo($id,$nombre_foto);
            foreach($laboratorio->objetos as $objeto){
                if($objeto->avatar!='laboratorio.jpg'){
                    unlink('../imaganes/laboratorio/'.$objeto->avatar);
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
        //echo $id;
    }
?>