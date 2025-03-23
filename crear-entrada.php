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
    <title>Crear Entrada</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <br>
    <?php include 'includes/header.php'; ?>
    <br>
    <h2><center>Crear Nueva Entrada</center></h2>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required> <br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea> <br>

        <label for="categoria">Categoría:</label>
        <select name="categoria" required>
            <option value="">Seleccione una categoría</option>
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
        <center><button type="button" onclick="window.location.href='editar_entradas.php'" class="boton boton-verde"> Editar Entradas</button></center>
    </form>

    <h2>Entradas recientes</h2>
    <br>
    <?php include 'includes/footer.php'; ?>
    <br>
</body>
</html>

