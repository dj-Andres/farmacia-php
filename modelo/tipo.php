<?php
 include 'conexion.php';
  class tipo{
      var $objetos;
      public function __construct()
      {
        $db=new conexion();
        $this->acceso=$db->pdo;
      }
      function crear($nombre){
        $sql="SELECT Id_tipo_producto FROM tipo_producto  WHERE nombre_tipo=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'nocrear';                      
            }else{
                $sql="INSERT INTO tipo_producto(nombre) VALUES(:nombre)";
                $query=$this->acceso->prepare($sql);
                echo 'crear';
            }
        }
        function buscar(){
            if(!empty($_POST['consulta'])){
                $consulta=$_POST['consulta'];
                $sql="SELECT * FROM tipo_producto  WHERE nombre_tipo LIKE :consulta";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql="SELECT * FROM tipo_producto  WHERE nombre_tipo NOT LIKE ''ORDER BY Id_tipo_producto LIMIT 15";
                $query=$this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function borrar($id){
            $sql="DELETE FROM tipo_producto WHERE Id_tipo_producto=:Id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':Id'=>$id));
            $this->objetos=$query->fetchall();
            if(!empty($query->execute(array(':Id'=>$id)))){
                echo 'borrado';
            }else{
                echo 'no-borrado';
            }
        }
        function editar($nombre,$id_editado){
            $sql="UPDATE tipo_producto SET nombre_tipo=:nombre WHERE Id_tipo_producto=:Id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':Id'=>$id_editado,':nombre'=>$nombre));
            $this->objetos=$query->fetchall();
            echo 'editado';
        }
        function rellenar_tipos(){
            $sql="SELECT * FROM tipo_producto ORDER BY nombre_tipo ASC";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();          
            return $this->objetos;
        }
  }
?>