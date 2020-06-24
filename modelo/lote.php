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
  }
?>