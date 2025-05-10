<?php
require_once 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_entrada = intval($_POST['id']);

    // Eliminar la entrada
    $stmt = $conexion->prepare("DELETE FROM entradas WHERE id = ?");
    $stmt->bind_param("i", $id_entrada);

    if ($stmt->execute()) {
        $_SESSION['mensaje_exito'] = "Entrada eliminada correctamente.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensaje_error'] = "Error al eliminar la entrada.";
        header("Location: entrada.php?id=$id_entrada");
        exit();
    }
} else {
    die("Acceso denegado.");
}
?>
