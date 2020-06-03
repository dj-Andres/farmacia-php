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
                'residencia'=>$objeto->residencia,
                'correo'=>$objeto->correo,
                'sexo'=>$objeto->sexo,
                'adicional'=>$objeto->adicional
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
?>