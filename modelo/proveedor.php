<?php
 include 'conexion.php';
  class proveedor{
      var $objetos;
      public function __construct()
      {
        $db=new conexion();
        $this->acceso=$db->pdo;
      }
      function crear($nombre,$telefono,$correo,$direccion,$avatar){
        $sql="SELECT Id_proveedor FROM proveedor  WHERE nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'nocrear';                      
            }else{
                $sql="INSERT INTO proveedor(nombre,telefono,correo,direccion,avatar) VALUES(:nombre,:telefono,:correo,:direccion,:avatar)";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':correo'=>$correo,':telefono'=>$telefono,':direccion'=>$direccion,':avatar'=>$avatar));
                echo 'crear';
            }
        }
        function buscar(){
            if(!empty($_POST['consulta'])){
                $consulta=$_POST['consulta'];
                $sql="SELECT * FROM proveedor  WHERE nombre LIKE :consulta";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql="SELECT * FROM proveedor  WHERE nombre NOT LIKE ''ORDER BY Id_proveedor desc LIMIT 15";
                $query=$this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        
  }
?>