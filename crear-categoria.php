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

    <h1>Crear nueva categoría</h1>
    
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoría:</label>
        <input type="text" name="nombre" required>
        
        <input type="submit" value="Guardar">
    </form>

    <br>
    <a href="index.php">Volver al inicio</a>

</body>
</html>