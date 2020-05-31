<?php
session_start();
if($_SESSION['us_tipo']==2){
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farmacia System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/css/all.min.css">
</head>
<body>
    <h1>Hola tecnico</h1>
    <a href="../controlador/logout.php">Cerrar Sessión</a>
</body>
</html>
<?php
}else{
    header('Location:../index.php');
}
?>