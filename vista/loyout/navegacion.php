<meta name="viewport" content="width=device-width, initial-scale=1">
  <!---datatable-->
  <link rel="stylesheet" href="../css/datatables.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/compra.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!----Sweetalert---->
  <link rel="stylesheet" href="../css/sweetalert2.css">
  <!--Select2-->
  <link rel="stylesheet" href="../css/select2.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="adm_catalago.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      <li class="nav-item dropdown" id="cat-carrito" style="display: none;">
        <img  src="../imagenes/carrito.png" class="imagen-carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span id="contador" class="contador badge badge-danger"></span>
        </img>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <table class="carro table table-hover text-nowrap p-0">
            <thead class="table-success">
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Concentración</th>
                <th>Adicional</th>
                <th>Precio</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="lista">

            </tbody>
          </table>
          <a href="#" class="btn btn-danger btn-block" id="procesar_pedido">Procesar Compra</a>
          <a href="#" class="btn btn-primary btn-block" id="vaciar-carrito">Vaciar Carrito</a>
        </div>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <a href="../controlador/logout.php">Cerrar Sessión</a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../vista/adm_catalago.php" class="brand-link">
      <img src="../imagenes/logo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">FarmaciaSystem</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img id="avatar4" src="../imagenes/avatar04.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">USUARIO</li>
              <li class="nav-item">
                <a href="../vista/editar-datos-personales.php" class="nav-link">
                  <i class="nav-icon fas fa-user-cog"></i>
                  <p>
                    Datos Personales
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adm_usuario.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Gestión Usuario
                  </p>
                </a>
              </li>
              <li class="nav-header">Ventas</li>
              <li class="nav-item">
                <a href="adm_venta.php" class="nav-link">
                  <i class="nav-icon fas fa-notes-medical"></i>
                  <p>
                    Listar Ventas
                  </p>
                </a>
              </li>
              <li class="nav-header">Almacen</li>
              <li class="nav-item">
                <a href="adm_producto.php" class="nav-link">
                  <i class="nav-icon fas fa-pills"></i>
                  <p>
                    Gestión de Producto
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adm_atributo.php" class="nav-link">
                  <i class="nav-icon fas fa-vials"></i>
                  <p>
                    Gestión Atributo
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adm_lote.php" class="nav-link">
                  <i class="nav-icon fas fa-cubes"></i>
                  <p>
                    Gestión de Lotes
                  </p>
                </a>
              </li>
              <li class="nav-header">Compras</li>
              <li class="nav-item">
                <a href="adm_proveedor.php" class="nav-link">
                  <i class="nav-icon fas fa-truck"></i>
                  <p>
                    Gestión de Proveedores
                  </p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>