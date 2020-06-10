<?php
 include 'conexion.php';
  class laboratorio{
      var $objetos;
      public function __construct()
      {
        $db=new conexion();
        $this->acceso=$db->pdo;
      }
      function crear($nombre,$avatar){
        $sql="SELECT Id_laboratorio FROM laboratorio  WHERE nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'nocrear';                      
            }else{
                $sql="INSERT INTO laboratorio(nombre,avatar) VALUES(:nombre,:avatar)";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar));
                echo 'crear';
            }
        }
        function buscar(){
            if(!empty($_POST['consulta'])){
                $consulta=$_POST['consulta'];
                $sql="SELECT * FROM laboratorio  WHERE nombre LIKE :consulta";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                $sql="SELECT * FROM laboratorio  WHERE nombre NOT LIKE ''ORDER BY Id_laboratorio LIMIT 15";
                $query=$this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
  }
?>