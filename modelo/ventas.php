<?php
    include 'conexion.php';
    
    class ventas{
        var $objetos;
        public function __construct()
        {
            $db=new conexion();
            $this->acceso=$db->pdo;
        }

        public function crear($total,$cliente,$cedula,$fecha,$vendedor){
            $sql="INSERT INTO venta (fecha,cliente,cedula,total,vendedor) VALUES(:fecha,:cliente,:cedula,:total,:vendedor)";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':cliente'=>$cliente,':cedula'=>$cedula,':total'=>$total,':vendedor'=>$vendedor)); 
        }
        public function ultima_venta(){
            $sql="SELECT MAX(Id_venta) as ultima_venta FROM venta";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        public function borrar($id_venta){
            $sql="DELETE FROM venta WHERE Id_venta=:Id_venta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':Id_venta'=>$id_venta));
        }

    }
?>