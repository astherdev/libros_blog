<?php
session_start();
if(!isset($_SESSION['usuario_id'])) {
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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Crear Nueva Entrada</h2>
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

        <button type="submit">Publicar</button>
    </form>

    <h2>Entradas recientes</h2>
</body>
</html>

