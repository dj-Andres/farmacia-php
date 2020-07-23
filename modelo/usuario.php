<?php
include_once 'conexion.php';
   

        class usuario{
        
            var $objetos;
            //es el metodo del la clase
                public function __construct()
                {
                    $db=new conexion();
                    $this->acceso=$db->pdo;
                }
                function logear($dni,$pass){
                    $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=Id_tipo_us WHERE cedula=:dni";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':dni' =>$dni));
                    $this->objetos = $query->fetchall();

                    foreach ($this->objetos as $objeto) {
                        $contrasena_actual=$objeto->clave;
                    }
                    if (strpos($contrasena_actual,'$2y$10$')===0) {
                        if(password_verify($pass,$contrasena_actual)){
                            return $this->objetos;
                        }
                    }else{
                        if($pass==$contrasena_actual){
                            return $this->objetos;
                        }
                    }
                    
                }
                function obtener_datos($id){
                    $sql="SELECT * FROM usuario  join tipo_us on us_tipo=Id_tipo_us  AND Id_usuario=:id";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':id' =>$id));
                    $this->objetos = $query->fetchall();
                    return $this->objetos;
                }
                function actualizar_usuario($Id_usuario,$telefono,$resedencia,$correo,$sexo,$adiconal){
                    $sql="UPDATE usuario SET telefono=:telefono,residencia=:residencia,correo=:correo,sexo=:sexo,adicional=:adicional WHERE Id_usuario=:Id_usuario";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario,':residencia'=>$resedencia,':telefono'=>$telefono,':correo'=>$correo,':sexo'=>$sexo,':adicional'=>$adiconal));
                }
                function actualizar_clave($Id_usuario,$vieja_clave,$nueva_clave){
                    $sql="SELECT * FROM usuario WHERE  Id_usuario=:Id_usuario";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario));
                    $this->objetos=$query->fetchall();

                    foreach ($this->objetos as $objeto) {
                        $contrasena_actual=$objeto->clave;
                    }
                    if (strpos($contrasena_actual,'$2y$10$')===0) {
                        if(password_verify($vieja_clave,$contrasena_actual)){
                            $pass=password_hash($nueva_clave,PASSWORD_BCRYPT,['cost'=>10]);
                            $sql="UPDATE usuario SET clave=:nueva_clave WHERE Id_usuario=:Id_usuario";
                            $query=$this->acceso->prepare($sql);
                            $query->execute(array(':Id_usuario'=>$Id_usuario,':nueva_clave'=>$pass));
                            echo 'actualizado';    
                        }else{
                            echo 'No se realizo cambio';
                        }
                    }else{
                        if($vieja_clave==$contrasena_actual){
                            $pass=password_hash($nueva_clave,PASSWORD_BCRYPT,['cost'=>10]);
                            $sql="UPDATE usuario SET clave=:nueva_clave WHERE Id_usuario=:Id_usuario";
                            $query=$this->acceso->prepare($sql);
                            $query->execute(array(':Id_usuario'=>$Id_usuario,':nueva_clave'=>$pass));
                            echo 'actualizado';    
                        }else{
                            echo 'No se realizo cambio';
                        }
                    }
                }
                function cambiar_foto($Id_usuario,$nombre_foto){
                    $sql="SELECT avatar FROM usuario WHERE Id_usuario=:Id_usuario";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario));
                    $this->objetos=$query->fetchall();
                    
                        $sql="UPDATE usuario SET avatar=:nombre_foto WHERE Id_usuario=:Id_usuario";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':Id_usuario'=>$Id_usuario,':nombre_foto'=>$nombre_foto));
                        
                    return $this->objetos;
                    
                }
                function buscar(){
                    if(!empty($_POST['sql'])){
                        $sql=$_POST['sql'];
                        $sql="SELECT * FROM usuario join tipo_us on us_tipo=Id_tipo_us WHERE nombre LIKE :sql";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':sql'=>"%$sql%"));
                        $this->objetos=$query->fetchall();
                        return $this->objetos;
                    }else{
                        $sql="SELECT * FROM usuario join tipo_us on us_tipo=Id_tipo_us WHERE nombre NOT LIKE ''ORDER BY Id_usuario LIMIT 15";
                        $query=$this->acceso->prepare($sql);
                        $query->execute();
                        $this->objetos=$query->fetchall();
                        return $this->objetos;
                    }
                }
                function crear($nombre,$apellido,$cedula,$naciiento,$clave,$tipo,$avatar){
                    $sql="SELECT Id_usuario FROM usuario  WHERE cedula=:cedula";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':cedula'=>$cedula));
                    $this->objetos=$query->fetchall();
                    if(!empty($this->objetos)){
                        echo 'nocrear';                      
                    }else{
                        $sql="INSERT INTO usuario(cedula,nombre,apellido,edad,clave,avatar,us_tipo) VALUES(:cedula,:nombre,:apllido,:nacimiento,:clave,:avatar,:tipo)";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':cedula'=>$cedula,':nombre'=>$nombre,':apellido'=>$apellido,':nacimiento'=>$naciiento,':clave'=>$clave,':avatar'=>$avatar,':tipo'=>$tipo));
                        echo 'crear';
                    }
                }
                function ascender($clave,$Id_ascendido,$Id_usuario){
                    $sql="SELECT Id_usuario FROM usuario  WHERE Id_usuario=:Id_usuario AND clave=:clave";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario,':clave'=>$clave));
                    $this->objetos=$query->fetchall();
                    if(!empty($this->objetos)){
                        $tipo=1;
                        $sql="UPDATE usuario set us_tipo=:tipo WHERE Id_usuario=:Id";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':Id'=>$Id_ascendido,':tipo'=>$tipo));
                        $this->objetos=$query->fetchall();
                        echo 'ascendido';
                    }else{
                        echo 'no-ascendido';
                    }
                }
                function descender($clave,$Id_descendido,$Id_usuario){
                    $sql="SELECT Id_usuario FROM usuario  WHERE Id_usuario=:Id_usuario AND clave=:clave";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario,':clave'=>$clave));
                    $this->objetos=$query->fetchall();
                    if(!empty($this->objetos)){
                        $tipo=2;
                        $sql="UPDATE usuario set us_tipo=:tipo WHERE Id_usuario=:Id";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':Id'=>$Id_descendido,':tipo'=>$tipo));
                        $this->objetos=$query->fetchall();
                        echo 'descendido';
                    }else{
                        echo 'no-descendido';
                    }
                }
                function borrar($clave,$Id_borrado,$Id_usuario){
                    $sql="SELECT * FROM usuario  WHERE Id_usuario=:Id_usuario";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario));
                    $this->objetos=$query->fetchall();
                    foreach ($this->objetos as $objeto) {
                        $contrasena_actual=$objeto->clave;
                    }
                    if (strpos($contrasena_actual,'$2y$10$')===0) {
                        if(password_verify($clave,$contrasena_actual)){
                            $sql="DELETE FROM usuario  WHERE Id_usuario=:Id";
                            $query=$this->acceso->prepare($sql);
                            $query->execute(array(':Id'=>$Id_borrado));
                            $this->objetos=$query->fetchall();
                            echo 'borrado';
                        }else{
                            echo 'no-borrado';
                        }
                    }else{
                        if($clave==$contrasena_actual){
                            $sql="DELETE FROM usuario  WHERE Id_usuario=:Id";
                            $query=$this->acceso->prepare($sql);
                            $query->execute(array(':Id'=>$Id_borrado));
                            $this->objetos=$query->fetchall();
                            echo 'borrado';
                        }else{
                            echo 'no-borrado';
                        }
                    }
                }
        }

?>