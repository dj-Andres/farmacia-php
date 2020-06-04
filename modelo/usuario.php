<?php
include_once'conexion.php';
   

        class usuario{
        
            var $objetos;
            //es el metodo del la clase
                public function __construct()
                {
                    $db=new conexion();
                    $this->acceso=$db->pdo;
                }
                function logear($dni,$pass){
                    $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=Id_tipo_us WHERE cedula=:dni and clave=:pass";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':dni' =>$dni ,':pass'=>$pass));
                    $this->objetos = $query->fetchall();
                    return $this->objetos;
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
                    $sql="SELECT * FROM usuario WHERE clave=:vieja_clave AND Id_usuario=:Id_usuario";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario,':vieja_clave'=>$vieja_clave));
                    $this->objetos=$query->fetchall();
                    if(!empty($this->objetos)){
                        $sql="UPDATE usuario SET clave=:nueva_clave WHERE Id_usuario=:Id_usuario";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':Id_usuario'=>$Id_usuario,':nueva_clave'=>$nueva_clave));
                        echo 'actualizado';
                    }else{
                        echo 'No se realizo cambio';
                    }
                }
                function cambiar_foto($Id_usuario,$nombre_foto){
                    $sql="SELECT * FROM avatar WHERE Id_usuario=:Id_usuario";
                    $query=$this->acceso->prepare($sql);
                    $query->execute(array(':Id_usuario'=>$Id_usuario));
                    $this->objetos=$query->fetchall();
                    
                        $sql="UPDATE usuario SET avatar=:nombre_foto WHERE Id_usuario=:Id_usuario";
                        $query=$this->acceso->prepare($sql);
                        $query->execute(array(':Id_usuario'=>$Id_usuario,':nombre_foto'=>$nombre_foto));
                        
                    return $this->objetos;
                    
                }
        }


    

?>