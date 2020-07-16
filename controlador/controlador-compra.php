<?php
    include '..modelo/ventas.php';
    include_once '..modelo/conexion.php';
    
    $venta=new ventas();

    session_start();
    $vendedor=$_SESSION['usuario'];

    if($_POST['funcion']=='registrar_compra'){
        $total=$_POST['total'];
        $cliente=$_POST['nombre_cli'];
        $cedula=$_POST['cedula'];
        $productos=json_decode($_POST['json']);
        date_default_timezone_get('America/Guayaquil');
        $fecha=date('Y-m-d H:l:s');
        //print_r($productos);
        $venta->crear($total,$cliente,$cedula,$fecha,$vendedor);

        $venta->ultima_venta();

        foreach ($venta->objetos as $objeto) {
            $id_venta=$objeto->ultima_venta;
            echo $id_venta;
        }
        try {
            $db=new conexion();
            $conexion=$db->pdo;

            $conexion->beginTransaction();

            foreach ($productos as $prod) {
                $cantidad=$prod->cantidad;

                while ($cantidad !=0) {
                    $sql="SELECT * FROM lote WHERE vencimiento =(SELECT MIN (vencimiento) FROM lote WHERE lote_Id_prod=:id) AND lote_Id_prod=:id";
                    $query=$conexion->prepare($sql);
                    $query->execute(array(':id'=>$prod->id));
                    $lote=$query->fetchall();
                    

                    foreach ($lote as $lote) {
                        if($cantidad < $lote->stock){
                            $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,Id_det_lote,Id_det_prod,Id_det_prov,Id_det_venta) VALUES('$cantidad','$lote->vencimiento','$lote->Id_lote','$prod->Id','$lote->lote_Id_prov','$id_venta')";
                            $conexion->exec($sql);
                            $conexion->exec("UPDATE lote SET stock=stock-'.$cantidad' WHERE Id_lote='$lote->Id_lote'");
                            $cantidad=0;
                        }
                        
                        if($cantidad == $lote->stock){
                            $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,Id_det_lote,Id_det_prod,Id_det_prov,Id_det_venta) VALUES('$cantidad','$lote->vencimiento','$lote->Id_lote','$prod->Id','$lote->lote_Id_prov','$id_venta')";
                            $conexion->exec($sql);
                            $conexion->exec("DELETE FROM  lote  WHERE Id_lote='$lote->Id_lote'");
                            $cantidad=0;
                        }

                        if($cantidad > $lote->stock){
                            $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,Id_det_lote,Id_det_prod,Id_det_prov,Id_det_venta) VALUES('$lote->stock','$lote->vencimiento','$lote->Id_lote','$prod->Id','$lote->lote_Id_prov','$id_venta')";
                            $conexion->exec($sql);
                            $conexion->exec("DELETE FROM  lote  WHERE Id_lote='$lote->Id_lote'");
                            $cantidad=$cantidad-$lote->stock;
                        }            
                    }
                }
                $subtotal=$prod->cantidad * $prod->precio;
                $conexion->exec("INSERT INTO venta_producto(cantidad,subtotal,producto_Id_producto,venta_Id_venta)VALUES('$prod->cantidad','$subtotal','$prod->id','$id_venta')");
            }
            $conexion->commit();
        } catch (Exception $error) {
            $conexion->rollBack();
            $venta->borrar($id_venta);
            echo $error->getMessage();
        }
    }
?>