<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farmacia System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">
</head>
<?php
session_start();
if(!empty($_SESSION['us_tipo'])){
    header('Location:controlador/controlador-login.php');
}else{
    session_destroy();
?>
    <body>
        <img class="wave" src="imagenes/wave.png" alt="">
        <div class="contenedor">
            <div class="img">
                <img src="imagenes/bg.svg" alt="">
            </div>
            <div class="contenido-login">
                <form action="controlador/controlador-login.php" method="POST">
                    <img src="imagenes/logo.png" alt="">
                    <h2>System Farmacia</h2>
                    <div class="input-div dni">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Cedula</h5>
                            <input type="text" name="user" class="input">
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Contraseña</h5>
                            <input type="password" name="clave" class="input">
                        </div>
                    </div>
                    <a href="">Crear una cuenta</a>
                    <input type="submit" value="Iniciar Sessión" class="btn">
                </form>
            </div>
        </div>
    </body>
    <script src="js/login.js"></script>
    </html>
<?php
}
?>
