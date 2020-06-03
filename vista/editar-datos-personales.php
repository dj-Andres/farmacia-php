<?php
session_start();
if($_SESSION['us_tipo']==1){
    include_once 'loyout/header.php';
?>
  <title>FarmaciaSystem</title>

    <?php 
        include_once 'loyout/navegacion.php';
    ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos Personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos Personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <input id="Id_usuario" type="hidden" value="<?php  echo $_SESSION['usuario'];?>">
                                    <img src="../imagenes/avatar.png" alt="" class="profile-user-img img-fluid img-circle">
                                    <h3 class="profile-username text-center text-success" id="nombre">Nombre:</h3>
                                    <p class="text-muted text-center" id="apellido">Apellido:</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                            <b style="color:#0B7300">Edad:</b><a class="float-rigth" id="edad"></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Cedula:</b><a class="float-rigth" id="cedula"></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color:#0B7300">Tipo Ususario:</b><a class="float-rigth" id="us_tipo">Administrador</a>
                                            <spam class="float-rigth badge badge-primary"></spam>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Información</h3>
                        </div>
                        <div class="card-body">
                            <strong style="color:#0B7300">
                                <i class="fas fa-phone mr-1"></i>Telefono
                            </strong>
                            <p class="text-center" id="telefono">0992294342</p>

                            <strong style="color:#0B7300">
                                <i class="fas fa-map-market-alt mr-1"></i>Residencia
                            </strong>
                            <p class="text-center" id="residencia">0992294342</p>

                            <strong style="color:#0B7300">
                                <i class="fas fa-map-alt mr-1"></i>Email
                            </strong>
                            <p class="text-center" id="correo">andres96jimenez@gmail.com</p>

                            <strong style="color:#0B7300">
                                <i class="fas fa-smile-wink mr-1"></i>Sexo
                            </strong>
                            <p class="text-center" id="sexo">andres96jimenez@gmail.com</p>
                        </div>

                        <strong style="color:#0B7300">
                                <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                            </strong>
                            <p class="text-center" id="adicioanl-use">andres96jimenez@gmail.com</p>
                            <button class="edit btn btn-block bg-grandient-danger">Editar</button>
                        <div class="card-footer">
                            <p class="text-muted">Click en el botón que desea editar</p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-success">
                            <div class="card-header">
                                <h3 class="card-title">Editar los datos que desea editar</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success text-center" id="editado" style="display:none;">
                                        <span><i class="fas fa-check m-1"></i>Editado</span>
                                </div>
                                <div class="alert alert-danger text-center" id="no-editado" style="display:none;">
                                        <span><i class="fas fa-times m-1"></i>No se pudo editar</span>
                                </div>
                                <form id="form-usuario" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                        <div class="col-sm-10">
                                            <input type="number" id="telefono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="recidencia" class="col-sm-2 col-form-label">Residencia</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="recidencia" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Eamil</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                                        <div class="col-sm-10">
                                            <input type="sexo" id="sexo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
                                        <div class="col-sm-10">
                                            <textarea name="adicional" id="adicional" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-control row">
                                        <div class="offset-sm-10 col-sm-10 float-rigth">
                                            <button class="btn btn-block btn-outline-success">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">¡ Cuidado al ingresar datos erroneos!</p>
                            </div>
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
<script src="../js/usuario.js"></script>