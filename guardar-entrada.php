<?php
session_start();
require_once ("includes/conexion.php");

if(!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);
    $categoria_id = intval($_POST["categoria"]);
    $usuario_id = $_SESSION['usuario_id'];

    if (!empty($titulo) && !empty($descripcion) && $categoria_id > 0) {
        // Verificar si la categoría existe
        $stmt = $conexion->prepare("SELECT id FROM categorias WHERE id = ?");
        $stmt->bind_param("i", $categoria_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();

            // Insertar la entrada
            $stmt = $conexion->prepare("INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, fecha) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("iiss", $usuario_id, $categoria_id, $titulo, $descripcion);

            if ($stmt->execute()) {
                echo "Entrada creada con exito. <a href='index.php'>Volver</a>";
            } else {
                echo "Error al guardar la entrada";
            }

            $stmt->close();
        } else {
            echo "La categoría no existe.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

$conexion->close();

?>