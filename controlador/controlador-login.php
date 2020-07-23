<?php
    include_once '../modelo/usuario.php';
    session_start();
    $dni=$_POST['user'];
    $pass=$_POST['clave'];
    //instancio la clase del modelo de usuario para usar su metodo
    $usuario=new usuario();
    
    if(!empty($_SESSION['us_tipo'])){
        switch ($_SESSION['us_tipo']) {
            case '1':
                header('Location:../vista/adm_catalago.php');
                break;
            
                case '2':
                    header('Location:../vista/tecnico_catalago.php');
                break;

                case '3':
                    header('Location:../vista/adm_catalago.php');
                break;
        }
    }else{
        $usuario->logear($dni,$pass);  
        if(!empty($usuario->objetos)){
            //se pasa las variables del envio pos en la clase de modelo usuario como parametros 
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
                    
                    case '3':
                        header('Location:../vista/adm_catalogo.php');
                    break;
            }
        }else{
            header('Location:../index.php');
        }
    }
?>