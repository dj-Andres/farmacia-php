<?php
session_start();
if($_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==1){
    include_once 'loyout/header.php';
?>
  <title>FarmaciaSystem</title>

    <?php 
        include_once 'loyout/navegacion.php';
    ?>
    
    <!--Fin de modal de lotes---> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestión de Ventas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar Ventas</h3>
                </div>
                <div class="card-body">
                    <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Fecha de Venta</th>
                                <th>Cliente</th>
                                <th>Cedula</th>
                                <th>Total</th>
                                <th>Vendedor</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include_once 'loyout/foter.php';
}else{
    header('Location:../index.php');
}
?>
<script src="../js/datatables.js"></script>
<script src="../js/ventas.js"></script>