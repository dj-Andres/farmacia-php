<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3){
    include_once 'loyout/header.php';
?>
  <title>FarmaciaSystem</title>

    <?php 
        include_once 'loyout/navegacion.php';
    ?>
  
    <!--Modal para crear laboratorio-->
    <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Laboratorio</h3>
                    <button class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!--ALERTAS-->
                    <div class="alert alert-success text-center" id="crear-laboratorio" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Se creo exitosamento</span>
                    </div>
                    <div class="alert alert-danger text-center" id="nocrear-laboratorio" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>El laboratorio ya existe</span>
                    </div>
                    <!--FIN-ALERTAS-->
                    <form id="form-crear-laboratorio">
                        <div class="form-group">
                            <label for="nombre-laboratorio">Nombre:</label>
                            <input id="nombre-laboratorio" type="text" class="form-control" placeholder="Ingrese nombre" require="">
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn bg-gradient-primary float-rigth m-1" type="submit">Crear</button>
                    <button class="btn btn.outline-secundary float-rigth m-1" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Final modal de presentacion-->
    <!--Modal para crear presentacion-->
    <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Presentación</h3>
                    <button class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!--ALERTAS-->
                    <div class="alert alert-success text-center" id="crear-presentacion" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Se creo exitosamento</span>
                    </div>
                    <div class="alert alert-danger text-center" id="nocrear-presentacion" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>El usuario ya existe</span>
                    </div>
                    <!--FIN-ALERTAS-->
                    <form id="form-crear-presentacion">
                        <div class="form-group">
                            <label for="nombre-presentacion">Nombre:</label>
                            <input id="nombre-presentacion" type="text" class="form-control" placeholder="Ingrese nombre" require="">
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn bg-gradient-primary float-rigth m-1" type="submit">Crear</button>
                    <button class="btn btn.outline-secundary float-rigth m-1" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Final de modal presentacion-->
    <!--Modal para crear tipo--->
    <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Tipo</h3>
                    <button class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!--ALERTAS-->
                    <div class="alert alert-success text-center" id="crear-tipo" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Se creo exitosamento</span>
                    </div>
                    <div class="alert alert-danger text-center" id="nocrear-tipo" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>El usuario ya existe</span>
                    </div>
                    <!--FIN-ALERTAS-->
                    <form id="form-crear-tipo">
                        <div class="form-group">
                            <label for="nombre-tipo">Nombre:</label>
                            <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese nombre" require="">
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn bg-gradient-primary float-rigth m-1" type="submit">Crear</button>
                    <button class="btn btn.outline-secundary float-rigth m-1" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--final de modal de tipo-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión Atributo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestión atributo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                                <li class="nav item"><a href="#presentacion" class="nav-link" data-toggle="tab">Presentación</a></li>
                                <li class="nav item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                              <div class="tab-pane active" id="laboratorio">
                                <div class="card card-success">
                                  <div class="card-header">
                                    <div class="card-title">
                                        Buscar Laboratorio <button class="btn bg-gradient-primary btn-sm m-2" data-toggle="modal" data-target="#crearlaboratorio">Crear laboratorio</button>
                                        <div class="input-group">
                                          <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingresar el nombre del laboratorio">
                                          <div class="input-group-append">
                                            <botton class="btn btn-default"><i class="fas fa-search"></i></botton>
                                          </div>
                                        </div>  
                                    </div>
                                  </div>
                                  <div class="card-body">

                                  </div>
                                  <div class="card-footer">

                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane" id="presentacion">
                                <div class="card card-success">
                                  <div class="card-header">
                                    <div class="card-title">
                                      Buscar Presentación <button class="btn bg-gradient-primary btn-sm m-2" data-toggle="modal" data-target="#crearpresentacion">Crear Presentación</button>
                                      <div class="input-group">
                                          <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingresar el nombre de la presentación">
                                          <div class="input-group-append">
                                            <botton class="btn btn-default"><i class="fas fa-search"></i></botton>
                                          </div>
                                        </div>  
                                    </div>
                                  </div>
                                  <div class="card-body">

                                  </div>
                                  <div class="card-footer">

                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane" id="tipo">
                                <div class="card card-success">
                                  <div class="card-header">
                                    <div class="card-title">
                                      Buscar Tipo <button class="btn bg-gradient-primary btn-sm m-2" data-toggle="modal" data-target="#creartipo">Crear tipo</button>
                                      <div class="input-group">
                                          <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingresar el tipo">
                                          <div class="input-group-append">
                                            <botton class="btn btn-default"><i class="fas fa-search"></i></botton>
                                          </div>
                                        </div>  
                                    </div>
                                  </div>
                                  <div class="card-body">
                                  
                                  </div>
                                  <div class="card-footer">
                                  
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
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
<script src="../js/laboratorio.js"></script>