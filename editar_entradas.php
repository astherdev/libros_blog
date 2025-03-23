<?php
session_start();
require_once("includes/conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

// Verificar si se recibe el ID de la entrada
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID de entrada no especificado.");
}

$id_entrada = intval($_GET['id']);

// Obtener los datos de la entrada
$stmt = $conexion->prepare("SELECT * FROM entradas WHERE id = ?");
$stmt->bind_param("i", $id_entrada);
$stmt->execute();
$resultado = $stmt->get_result();
$entrada = $resultado->fetch_assoc();

if (!$entrada) {
    die("Error: Entrada no encontrada.");
}

// Procesar edición
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['eliminar'])) {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $categoria_id = intval($_POST['categoria']);

    if (!empty($titulo) && !empty($descripcion) && $categoria_id > 0) {
        $stmt = $conexion->prepare("UPDATE entradas SET titulo = ?, descripcion = ?, categoria_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $titulo, $descripcion, $categoria_id, $id_entrada);

        if ($stmt->execute()) {
            $_SESSION['mensaje_exito'] = "Entrada actualizada correctamente.";
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar la entrada.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

// Procesar eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $stmt = $conexion->prepare("DELETE FROM entradas WHERE id = ?");
    $stmt->bind_param("i", $id_entrada);

    if ($stmt->execute()) {
        $_SESSION['mensaje_exito'] = "Entrada eliminada correctamente.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar la entrada.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrada</title>
    <link rel="stylesheet" href="/libros/css/style.css">
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar esta entrada?");
        }
    </script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h2>Editar Entrada</h2>
        <form method="post">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($entrada['titulo']) ?>" required>

            <label>Descripción:</label>
            <textarea name="descripcion" required><?= htmlspecialchars($entrada['descripcion']) ?></textarea>

            <label>Categoría:</label>
            <select name="categoria" required>
                <option value="">Seleccione una categoría</option>
                <?php
                $sql = "SELECT id, nombre FROM categorias";
                $resultado = $conexion->query($sql);
                while ($row = $resultado->fetch_assoc()) {
                    $selected = ($row['id'] == $entrada['categoria_id']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row['id']) . "' $selected>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <button type="submit" class="boton boton-verde">Guardar Cambios</button>
        </form>

        <!-- Botón para eliminar -->
        <form method="post" onsubmit="return confirmarEliminacion();">
            <input type="hidden" name="eliminar" value="true">
            <button type="submit" class="boton boton-rojo">Eliminar Entrada</button>
        </form>

        <button onclick="window.location.href='index.php'" class="boton boton-azul">Cancelar</button>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
