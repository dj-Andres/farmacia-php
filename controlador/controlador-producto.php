<?php
    include '../modelo/producto.php';
    $producto=new producto();
    //recibe los datos enviados del ajax//
    if($_POST['funcion']=='crear'){
        $nombre=$_POST['nombre'];
        $concentracion=$_POST['concentracion'];
        $adicional=$_POST['adicional'];
        $precio=$_POST['precio'];
        $laboratorio=$_POST['laboratorio'];
        $tipo=$_POST['tipo'];
        $presentacion=$_POST['presentacion'];
        $avatar='producto.png';
        $producto->crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar);
    }
    if($_POST['funcion']=='buscar'){
        $producto->buscar();
        $json=array();
        foreach ($producto->objetos as $objeto) {
            $json=array(
                'Id_laboratorio'=>$objeto->Id_laboratorio,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'precio'=>$objeto->precio,
                'stock'=>'stock',
                'avatar'=>'../imagenes/producto/'.$objeto->avatar,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion
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
    if($_POST['funcion']=='borrar'){
        $id=$_POST['id'];            
        $laboratorio->borrar($id);
    }
    if($_POST['funcion']=='actualizar'){
        $nombre=$_POST['nombre_laboratorio'];
        $id_editado=$_POST['id_editado'];
        $laboratorio->editar($nombre,$id_editado);
    }
    if($_POST['funcion']=='rellenar_laboratorios'){
        $laboratorio->rellenar_laboratorio();
        $json=array();
        foreach($laboratorio->objetos as $objeto){
            $json[]=array(
                'Id_laboratorio'=>$objeto->Id_laboratorio,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
?>