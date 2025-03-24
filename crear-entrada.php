<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';


if(!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

require_once "includes/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $categoria_id = $conexion->real_escape_string($_POST['categoria']);
    
    $sql = "INSERT INTO entradas (titulo, descripcion, categoria_id, usuario_id, fecha) VALUES ('$titulo', '$descripcion', '$categoria_id', '{$_SESSION['id']}', NOW())";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
<div id="principal">
    <h1>Crear Nueva Entrada</h1>
    <form action="crear-entrada.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>
        
        <label for="descripcion">Contenido:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>
        
        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria" required>
            <?php
            $categoria_result = $conexion->query("SELECT id, nombre FROM categorias");
            if ($categoria_result->num_rows > 0) {
                while ($categoria_row = $categoria_result->fetch_assoc()) {
                    echo "<option value='{$categoria_row['id']}'>{$categoria_row['nombre']}</option>";
                }
            } else {
                echo "<option value=''>No hay categorías disponibles</option>";
            }
            ?>
        </select><br><br>
        
        <input type="submit" value="Crear Entrada">
    </form>
    </div>
    <?php include 'includes/footer.php'; ?>
