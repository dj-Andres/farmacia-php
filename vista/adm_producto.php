<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){
    include_once 'loyout/header.php';
?>
  <title>FarmaciaSystem</title>

    <?php 
        include_once 'loyout/navegacion.php';
    ?>
    <!---Modal para crear usuario-->
    <div class="modal fade" id="crear-producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Producto</h3>
                    <button class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!--ALERTAS-->
                    <div class="alert alert-success text-center" id="crear" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Se creo exitosamento el producto</span>
                    </div>
                    <div class="alert alert-danger text-center" id="nocrear" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>El producto ya existe</span>
                    </div>
                    <!--FIN-ALERTAS-->
                    <form id="form-crear-producto">
                        <div class="form-group">
                            <label for="nombre_producto">Nombre:</label>
                            <input id="nombre_producto" type="text" class="form-control" placeholder="Ingrese nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="concentracion">Concentración:</label>
                            <input id="concentracion" type="text" class="form-control" placeholder="Ingrese concentracion">
                        </div>
                        <div class="form-group">
                            <label for="adicional">Adicional:</label>
                            <input id="adicional" type="date" class="form-control" placeholder="Ingrese adicional">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input id="precio" type="number" class="form-control" placeholder="Ingrese precio" required value="1">
                        </div>
                        <div class="form-group">
                            <label for="laboratorio">Laboratorio:</label>
                            <select name="laboratorio" id="laboratorio" class="form-control select2" style="width:100%"></select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_producto">Tipo Producto:</label>
                            <select name="tipo_producto" id="tipo_producto" class="form-control select2" style="width:100%"></select>
                        </div>
                        <div class="form-group">
                            <label for="presentacion">Presentación:</label>
                            <select name="presentacion" id="presentacion" class="form-control select2" style="width:100%"></select>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn bg-gradient-primary float-rigth m-1" type="submit">Guardar</button>
                    <button class="btn btn.outline-secundary float-rigth m-1" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!---Final de modal de crear usuarios-->
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión Producto <button type="button" data-toggle="modal" data-target="#crear-producto" class="btn bg-gradient-primary ml-2" id="boton-crear">Crear Producto</button> </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestión de Producto</li>
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
                    <h3 class="card-title">Buscar producto</h3>
                    <div class="input-group">
                        <input type="text" class="form-control fload-left" id="buscar-producto" placeholder="Ingrese nombre del producto">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id ="productos" class="row d-flex align-items-stretch">

                    </div>
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
<script src="../js/producto.js"></script>