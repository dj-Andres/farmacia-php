<?php
include_once '../modelo/usuario.php';
  $usuario= new usuario();
  if ($_POST['funcion']=='buscar_usuario') {
      $json=array();
      $usuario->obtener_datos($_POST['dato']);
      foreach($usuario->objetos as $objeto){
        $json[]=array(
            //el ultimo nombre es la columna de la tabla usuario//
                'nombre'=>$objeto->nombre,
                'apellido'=>$objeto->apellido,
                'edad'=>$objeto->edad,
                'cedula'=>$objeto->cedula,
                'tipo_usuario'=>$objeto->nombre_tipo,
                'telefono'=>$objeto->telefono,
                'correo'=>$objeto->correo,
                'sexo'=>$objeto->sexo,
                'adicional'=>$objeto->adicional
        );
      }
      $jsonstring=json_encode($json[0]);
      echo $jsonstring;

  }
?>