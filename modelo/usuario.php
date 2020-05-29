<?php
include_once'conexion.php';
   

        class usuario{
        
            var $objetos;
            //es el metodo del al clase
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
        }


    

?>