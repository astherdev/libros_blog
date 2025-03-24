<?php
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
require_once("includes/conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escribe una nueva reseña</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <br>
    <?php include 'includes/header.php'; ?>
    <br>
    <h2><center>Escribe una nueva reseña</center></h2>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Título del libro:</label>
        <input type="text" name="titulo" required> <br>

        <label for="descripcion">Tu reseña:</label>
        <textarea name="descripcion" required></textarea> <br>

        <label for="categoria">Género literario:</label>
        <select name="categoria" required>
            <option value="">Seleccione un género</option>
            <?php
            $sql = "SELECT id, nombre FROM categorias";
            $resultado = $conexion->query($sql);

            if (!$resultado) {
                die("Error al obtener las categorías: ".$conexion->error);
            }

            while($row = $resultado->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
            }
            ?>
        </select> <br>

        <center><button type="submit" class="boton boton-azul"> Publicar</button></center> 
    </form>

    <h2>Reseñas recientes</h2>
    <br>
    <?php include 'includes/footer.php'; ?>
    <br>
</body>
</html>

