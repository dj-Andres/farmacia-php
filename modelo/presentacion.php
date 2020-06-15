<?php
 include 'conexion.php';
  class presentacion{
      var $objetos;
      public function __construct()
      {
        $db=new conexion();
        $this->acceso=$db->pdo;
      }
      function crear($nombre){
        $sql="SELECT Id_presentacion FROM presentacion  WHERE presentacion=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'nocrear';                      
            }else{
                $sql="INSERT INTO presentacion(presentacion) VALUES(:nombre)";
                $query=$this->acceso->prepare($sql);
                echo 'crear';
            }
        }
        function buscar(){
            if(!empty($_POST['consulta'])){
                $consulta=$_POST['consulta'];
                $sql="SELECT * FROM presentacion  WHERE presentacion LIKE :consulta";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql="SELECT * FROM presentacion  WHERE presentacion NOT LIKE ''ORDER BY Id_presentacion LIMIT 15";
                $query=$this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function borrar($id){
            $sql="DELETE FROM presentacion WHERE Id_presentacion=:Id";
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
            $sql="UPDATE presentacion SET presentacion=:nombre WHERE Id_presentacion=:Id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':Id'=>$id_editado,':nombre'=>$nombre));
            $this->objetos=$query->fetchall();
            echo 'editado';
        }
        function rellenar_presentacion(){
            $sql="SELECT * FROM presentacion ORDER BY nombre ASC";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();          
            return $this->objetos;
        }
  }
?>