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
        public function buscar(){
            $sql="SELECT Id_venta,fecha,cliente,cedula,total,CONCAT(usuario.nombre,' ',usuario.apellido) as vendedor FROM venta JOIN usuario on vendedor=Id_usuario";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function venta_dia_vendedor($id_usuario){
            $sql="SELECT SUM(total) as venta_dia_vendedor FROM venta  WHERE vendedor=:id_usuario AND date(fecha) = date(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function venta_diaria(){
            $sql="SELECT SUM(total) as venta_diaria FROM venta  WHERE  date(fecha) = date(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function venta_mensual(){
            $sql="SELECT SUM(total) as venta_mensual FROM venta  WHERE year(fecha)= year(curdate()) AND month(fecha)=month(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function venta_anual(){
            $sql="SELECT SUM(total) as venta_anual FROM venta  WHERE year(fecha)= year(curdate())";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }

    }
?>