<?php
 include 'conexion.php';
  class producto{
      var $objetos;
      public function __construct()
      {
        $db=new conexion();
        $this->acceso=$db->pdo;
      }
      function crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar){
        $sql="SELECT Id_producto FROM productos WHERE nombre=:nombre AND concentracion=:concentracion AND adicional=:adicional AND  prod_lab=:laboratorio AND prod_present=:presentacion AND prod_tip_prod=:tipo";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,'concentracion'=>$concentracion,'adcional'=>$adicional,'laboratorio'=>$laboratorio,'presentacion'=>$presentacion,'tipo'=>$tipo));
        $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'nocrear';                      
            }else{
                $sql="INSERT INTO productos(nombre,concentracion,adicional,precio,avatar,prod_lab,prod_tip_prod,prod_present) VALUES(:nombre,:concentracion,:adicional,:precio,:avatar,:laboratorio,:tipo,:presentacion)";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,'concentracion'=>$concentracion,'adcional'=>$adicional,'precio'=>$precio,'avatar'=>$avatar,'laboratorio'=>$laboratorio,'presentacion'=>$presentacion,'tipo'=>$tipo));
                echo 'crear';
            }
        }
        function buscar(){
            if(!empty($_POST['consulta'])){
                $consulta=$_POST['consulta'];
                $sql="SELECT Id_producto,producto.nombre as nombre,concentracion,adicional,precio,producto.avatar as avatar,tipo_producto.nombre_tipo as tipo,presentacion.presentacion as presentacion ,laboratorio.nombre as laboratorio FROM productos JOIN laboratorio ON prod_lab=Id_laboratorio JOIN tipo_producto ON  prod_tip_prod=Id_tipo_producto JOIN presentacion ON  prod_present=Id_presentacion  AND producto.nombre LIKE :consulta";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }else{
                
                $sql="SELECT Id_producto,producto.nombre as nombre,concentracion,adicional,precio,producto.avatar as avatar,tipo_producto.nombre_tipo as tipo,presentacion.presentacion as presentacion ,laboratorio.nombre as laboratorio FROM productos JOIN laboratorio ON prod_lab=Id_laboratorio JOIN tipo_producto ON  prod_tip_prod=Id_tipo_producto JOIN presentacion ON  prod_present=Id_presentacion  AND producto.nombre ORDER BY producto.nombre  NOT LIKE '' LIMIT 15";
                $query=$this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function cambiar_logo($id,$nombre_foto){
            $sql="SELECT avatar FROM laboratorio WHERE Id_laboratorio=:Id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':Id'=>$id));
            $this->objetos=$query->fetchall();
            
                $sql="UPDATE laboratorio SET avatar=:nombre_foto WHERE Id_laboratorio=:Id";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':Id'=>$id,':nombre_foto'=>$nombre_foto));
                
            return $this->objetos;
            
        }
        function borrar($id){
            $sql="DELETE FROM laboratorio WHERE Id_laboratorio=:Id";
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
            $sql="UPDATE laboratorio SET nombre=:nombre WHERE Id_laboratorio=:Id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':Id'=>$id_editado,':nombre'=>$nombre));
            $this->objetos=$query->fetchall();
            echo 'editado';
        }
        function rellenar_laboratorio(){
            $sql="SELECT * FROM laboratorio ORDER BY nombre ASC";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();          
            return $this->objetos;
        }
  }
?>