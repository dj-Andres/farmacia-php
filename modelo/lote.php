<?php
 include 'conexion.php';
  class lote{
      var $objetos;
      public function __construct()
      {
        $db=new conexion();
        $this->acceso=$db->pdo;
      }
      function crear($id_producto,$proveedor,$stock,$vencimiento){
            $sql="INSERT INTO lote(stock,vencimiento,lote_Id_prod,lote_Id_prov) VALUES(:stock,:vencimiento,:Id_producto,:Id_proveedor)";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':stock'=>$stock,':vencimiento'=>$vencimiento,':Id_producto'=>$id_producto,':Id_proveedor'=>$proveedor));
            echo 'crear';
      }
      function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT Id_lote,stock,vencimiento,concentracion,adicional,productos.nombre as nombre_producto,laboratorio.nombre as nombre_laboratorio,presentacion,proveedor.nombre as nombre_proveedor,productos.avatar as logo FROM lote JOIN proveedor  on lote_Id_prov=Id_proveedor JOIN productos on lote_Id_prod=Id_producto JOIN laboratorio on prod_lab=Id_laboratorio JOIN tipo_producto on prod_tip_prod=Id_tipo_producto JOIN presentacion on prod_present=Id_presentacion AND productos.nombre  LIKE :consulta ORDER BY productos.nombre LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            
            $sql="SELECT Id_lote,stock,vencimiento,concentracion,adicional,productos.nombre as nombre_producto,laboratorio.nombre as nombre_laboratorio,presentacion,proveedor.nombre as nombre_proveedor,productos.avatar as logo FROM lote JOIN proveedor  on lote_Id_prov=Id_proveedor JOIN productos on lote_Id_prod=Id_producto JOIN laboratorio on prod_lab=Id_laboratorio JOIN tipo_producto on prod_tip_prod=Id_tipo_producto JOIN presentacion on prod_present=Id_presentacion AND productos.nombre NOT LIKE '' ORDER BY productos.nombre LIMIT 15";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
      }
      function editar($id_lote,$stock){
        $sql="UPDATE lote SET stock=:stock WHERE Id_lote=:Id_lote";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':stock'=>$stock,':Id_lote'=>$id_lote));
        echo 'editado';
      }
      function borrar($id_lote){
        $sql="DELETE FROM lote  WHERE Id_lote=:Id_lote";
        $query=$this->acceso->prepare($sql);
        if(!empty($query->execute(array(':Id_lote'=>$id_lote)))){
          echo 'borrado';
        }else{
          echo 'noborrado';
        }
        
      }
  }
?>