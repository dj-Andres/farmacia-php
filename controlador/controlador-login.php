<?php
    include_once'../modelo/usuario.php';
    session_start();
    $usuario=$_POST['user'];
    $clave=$_POST['clave'];
    //instancio la clase del modelo de usuario para usar su metodo
    $usuario=new usuario();
    
    if(!empty($_SESSION['us_tipo'])){
        switch ($_SESSION['us_tipo']) {
            case '1':
                header('Location:../vista/adm_catalogo.php');
                break;
            
                case '2':
                    header('Location:../vista/tecnico_catalogo.php');
                break;
        }
    }else{
        if(!empty($usuario->objetos)){
            //se pasa las variables del envio pos en la clase de modelo usuario como parametros 
            $usuario->logear($usuario,$clave);  
            foreach($usuario->objetos as $item){
                //var_dump($item);
                $_SESSION['usuario']=$item->Id_usuario;
                $_SESSION['us_tipo']=$item->us_tipo;
                $_SESSION['nombre']=$item->nombre;
            }
            switch ($_SESSION['us_tipo']) {
                case '1':
                    header('Location:../vista/adm_catalago.php');
                    break;
                
                    case '2':
                        header('Location:../vista/tecnico_catalogo.php');
                    break;
            }
        }else{
            header('Location:../vista/login.php');
        }
    }
?>