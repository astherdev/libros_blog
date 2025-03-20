<?php
require_once ("includes/conexion.php");

if (isset($_POST["nombre"])) {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "Categoria creada correctamente";
            header("Refresh: 3; URL=index.php");
        } else {
            echo "Error al guardar la categoría: " . mysqli_error($conexion);
        }
    } else {
        echo "El nombre de la categoría no puede estar vacío.";
    }
}

mysqli_close($conexion);
?>
