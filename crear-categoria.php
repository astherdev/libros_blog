<?php
require_once ("includes/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Categoría</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <br>
    <h1>Crear nueva categoría</h1>
    <br>
    
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoría:</label>
        <input type="text" name="nombre" required>
        
        <input type="submit" value="Guardar">
    </form>
    <button type="button" onclick="window.location.href='index.php'" class="boton boton-azul"> Volver al Inicio</button>

    <br>
    <?php include 'includes/footer.php'; ?>
</body>
</html>