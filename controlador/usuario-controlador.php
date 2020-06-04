<?php
include_once '../modelo/usuario.php';
  $usuario= new usuario();
  session_start();
  $Id_usuario=$_SESSION['usuario'];
  if ($_POST['funcion']=='buscar_usuario') {
      $json=array();
      $fecha_actual=new DateTime();
      $usuario->obtener_datos($_POST['dato']);
      foreach($usuario->objetos as $objeto){
        $naciiento=new DateTime($objeto->edad);
        //comparacion de la fecha actual con la fecha de nacimiento//
        $edad=$naciiento->diff($fecha_actual);
        $edad_año=$edad->y;
        $json[]=array(
            //el ultimo nombre es la columna de la tabla usuario//
                'nombre'=>$objeto->nombre,
                'apellido'=>$objeto->apellido,
                'edad'=>$edad_año,
                'cedula'=>$objeto->cedula,
                'tipo_usuario'=>$objeto->nombre_tipo,
                'telefono'=>$objeto->telefono,
                'residencia'=>$objeto->residencia,
                'correo'=>$objeto->correo,
                'sexo'=>$objeto->sexo,
                'adicional'=>$objeto->adicional,
                'avatar'=>'../imagenes/'.$objeto->avatar
        );
      }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
  }
  if ($_POST['funcion']=='capturar_datos') {
    $json=array();
    // esta es la variable que se envia desde el js en la funcion de capturar datos como parametro//
    $Id_usuario=$_POST['Id_usuario'];
    // se usa el mismo metodo de la modelo del usuario pero con diferente parametro este caso el id//
    $usuario->obtener_datos($Id_usuario);
    foreach($usuario->objetos as $objeto){
      $json[]=array(
          //el ultimo nombre es la columna de la tabla usuario//
          'telefono'=>$objeto->telefono,
          'residencia'=>$objeto->residencia,
          'correo'=>$objeto->correo,
          'sexo'=>$objeto->sexo,
          'adicional'=>$objeto->adicional
      );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
  }
    if ($_POST['funcion']=='editar_usuario') {
      // esta es la variable que se envia desde el js en la funcion de capturar datos como parametro//
      $Id_usuario=$_POST['Id_usuario'];
      $telefono=$_POST['telefono'];
      $correo=$_POST['correo'];
      $residencia=$_POST['residencia'];
      $sexo=$_POST['sexo'];
      $adicional=$_POST['adicional'];
      // se envia todos los parametros al modelo usuario para la editar
      $usuario->actualizar_usuario($Id_usuario,$telefono,$correo,$residencia,$sexo,$adicional);
      // envio una respuesta del modelo  bd a js para confirmar que se complio el metodo//
      echo 'edicion';
    }
    if ($_POST['funcion']=='cambiar_clave') {
      // esta es la variable que se envia desde el js en la funcion de capturar datos como parametro//
      $Id_usuario=$_POST['Id_usuario'];
      $vieja_clave=$_POST['clave-vieja'];
      $nueva_clave=$_POST['clave-nueva'];
      // se envia todos los parametros al modelo usuario para la editar
      $usuario->actualizar_clave($Id_usuario,$vieja_clave,$nueva_clave);
      // envio una respuesta del modelo  bd a js para confirmar que se complio el metodo//
      //echo 'edicion';
    }
    if ($_POST['funcion']=='cambiar_foto') {
      if(($_FILES['foto']['type']=='image/jpeg') || ($_FILES['foto']['type']=='image/png') || ($_FILES['foto']['type']=='image/gif')){
        $nombre_foto=uniqid().'-'.$_FILES['foto']['name'];
        echo $nombre_foto;
        //creamos una ruta//
        $ruta='..imagenes/'.$nombre_foto;
        move_uploaded_file($_FILES['foto']['tpm_name'],$ruta);
        $usuario->cambiar_foto($Id_usuario,$nombre_foto);
        foreach($usuario->objetos as $objeto){
          unlink('../imaganes'.$objeto->avatar);
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
?>