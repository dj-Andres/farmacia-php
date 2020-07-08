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
            $producto->obtener_lote($objeto->Id_producto);
            foreach($producto->objetos as $obj){
                $total=$obj->total;
            }
            $json[]=array(
                'Id_producto'=>$objeto->Id_producto,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'precio'=>$objeto->precio,
                'stock'=>$total,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion,
                'Id_laboratorio'=>$objeto->Id_laboratorio,
                'Id_tipo'=>$objeto->Id_tipo_producto,
                'Id_presentacion'=>$objeto->Id_presentacion,
                'avatar'=>'../imagenes/producto/'.$objeto->avatar
            );
        }
        $jsonsting=json_encode($json);
        echo $jsonsting;
    }
    if($_POST['funcion']=='cambiar_avatar'){
        $id=$_POST['id_logo_prod'];
        $avatar=$_POST['avatar'];
        if(($_FILES['foto']['type']=='image/jpeg') || ($_FILES['foto']['type']=='image/png') || ($_FILES['foto']['type']=='image/gif')){
            $nombre_foto=uniqid().'-'.$_FILES['foto']['name'];
            //echo $nombre_foto;
            //creamos una ruta//
            $ruta='..imagenes/producto/'.$nombre_foto;
            move_uploaded_file($_FILES['foto']['tpm_name'],$ruta);
            $producto->cambiar_logo($id,$nombre_foto);
            foreach($producto->objetos as $objeto){
                if($avatar!='../imagenes/producto/producto.png'){
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
        //echo $id;
    }
    if($_POST['funcion']=='borrar'){
        $id=$_POST['id'];            
        $producto->borrar($id);
    }
    if($_POST['funcion']=='editar'){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $concentracion=$_POST['concentracion'];
        $adicional=$_POST['adicional'];
        $precio=$_POST['precio'];
        $laboratorio=$_POST['laboratorio'];
        $tipo=$_POST['tipo'];
        $presentacion=$_POST['presentacion'];
        $producto->editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion);
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
    if($_POST['funcion']=='buscar_Id'){
        $id_producto=$_POST['Id_producto'];
        $producto->buscarId($id_producto);
        $json=array();
        foreach ($producto->objetos as $objeto) {
            $producto->obtener_lote($objeto->Id_producto);
            foreach($producto->objetos as $obj){
                $total=$obj->total;
            }
            $json[]=array(
                'Id_producto'=>$objeto->Id_producto,
                'nombre'=>$objeto->nombre,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'precio'=>$objeto->precio,
                'stock'=>$total,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion,
                'Id_laboratorio'=>$objeto->Id_laboratorio,
                'Id_tipo'=>$objeto->Id_tipo_producto,
                'Id_presentacion'=>$objeto->Id_presentacion,
                'avatar'=>'../imagenes/producto/'.$objeto->avatar
            );
        }
        $jsonsting=json_encode($json[0]);
        echo $jsonsting;
    }
?>