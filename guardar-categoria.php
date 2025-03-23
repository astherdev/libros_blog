<?php
session_start();
require_once("includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);

    if (!empty($nombre)) {
        // Preparar la consulta para insertar la categoría
        $stmt = $conexion->prepare("INSERT INTO categorias (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);

        if ($stmt->execute()) {
            // Guardamos el mensaje en la sesión
            $_SESSION['mensaje'] = "Categoría creada correctamente";
            $_SESSION['tipo_mensaje'] = "exito";
        } else {
            $_SESSION['mensaje'] = "Error al guardar la categoría";
            $_SESSION['tipo_mensaje'] = "error";
        }

        $stmt->close();
    } else {
        $_SESSION['mensaje'] = "El nombre de la categoría no puede estar vacío";
        $_SESSION['tipo_mensaje'] = "error";
    }

    $conexion->close();
    header("Location: index.php"); // Redirige al index
    exit();
}
?>
