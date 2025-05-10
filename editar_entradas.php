<?php
session_start();
require_once 'includes/conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID de entrada no especificado.");
}

$id_entrada = intval($_GET['id']);

// Obtener datos de la entrada
$stmt = $conexion->prepare("SELECT * FROM entradas WHERE id = ?");
$stmt->bind_param("i", $id_entrada);
$stmt->execute();
$resultado = $stmt->get_result();
$entrada = $resultado->fetch_assoc();

if (!$entrada) {
    die("Error: Entrada no encontrada.");
}

// Procesar actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $categoria_id = intval($_POST['categoria']);

    if (!empty($titulo) && !empty($descripcion) && $categoria_id > 0) {
        $stmt = $conexion->prepare("UPDATE entradas SET titulo = ?, descripcion = ?, categoria_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $titulo, $descripcion, $categoria_id, $id_entrada);

        if ($stmt->execute()) {
            $_SESSION['mensaje_exito'] = "Entrada actualizada correctamente.";
            header("Location: entrada.php?id=$id_entrada");
            exit();
        } else {
            $_SESSION['mensaje_error'] = "Error al actualizar la entrada.";
        }
    } else {
        $_SESSION['mensaje_error'] = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reseña</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        /* Estilo del fondo del popup */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
        }

        /* Estilo del popup */
        .popup {
            background: white;
            width: 40%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .popup-header {
            background: #007BFF;
            color: white;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 18px;
        }

        .popup-body {
            padding: 20px;
            font-size: 16px;
        }

        .popup-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
        }

        .boton-azul {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .boton-rojo {
            background: #FF0000;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .boton-azul:hover {
            background: #0056b3;
        }

        .boton-rojo:hover {
            background: #cc0000;
        }
    </style>
    <script>
        function mostrarPopup() {
            document.getElementById('popup-eliminar').style.display = 'block';
        }

        function cerrarPopup() {
            document.getElementById('popup-eliminar').style.display = 'none';
        }
    </script>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <br>
        <center><h2>Editar Reseña</h2></center>
        <br>

        <form method="post">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($entrada['titulo']) ?>" required>

            <label>Tu reseña:</label>
            <textarea name="descripcion" required><?= htmlspecialchars($entrada['descripcion']) ?></textarea>

            <label>Género literario:</label>
            <select name="categoria" required>
                <option value="">Seleccione un género</option>
                <?php
                $sql = "SELECT id, nombre FROM categorias";
                $resultado = $conexion->query($sql);
                while ($row = $resultado->fetch_assoc()) {
                    $selected = ($row['id'] == $entrada['categoria_id']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row['id']) . "' $selected>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <center><button type="submit" name="guardar" class="boton boton-verde">Guardar Cambios</button></center>
        </form>

        <!-- Botón para abrir el popup -->
        <center><button onclick="mostrarPopup()" class="boton boton-rojo">Eliminar Libro</button></center>

        <!-- Popup de confirmación de eliminación -->
        <div id="popup-eliminar" class="popup-overlay">
            <div class="popup">
                <div class="popup-header">
                    <strong>Confirmar Eliminación</strong>
                </div>
                <div class="popup-body">
                    <p>¿Estás seguro de que deseas eliminar esta reseña?</p>
                </div>
                <div class="popup-buttons">
                    <form action="eliminar-entrada.php" method="post">
                        <input type="hidden" name="id" value="<?= $id_entrada ?>">
                        <center><button type="submit" class="boton-rojo">Eliminar</button></center>
                    </form>
                    <center><button onclick="cerrarPopup()" class="boton-azul">Cancelar</button></center>
                </div>
            </div>
        </div>

        <center><button onclick="window.location.href='entrada.php?id=<?= $id_entrada ?>'" class="boton boton-azul">Cancelar</button></center>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
