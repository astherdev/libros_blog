<?php
session_start();
require_once 'includes/conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['id'];

// Obtener los datos actuales del usuario
$stmt = $conexion->prepare("SELECT nombre, apellidos, email, password FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Error: No se encontraron datos del usuario.");
}

// Procesar el formulario cuando se envíen los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $password_actual = $_POST['password_actual'] ?? '';
    $password_nuevo = $_POST['password_nuevo'] ?? '';

    try {
        // Si el usuario quiere cambiar la contraseña
        if (!empty($password_actual) && !empty($password_nuevo)) {
            if (password_verify($password_actual, $usuario['password'])) {
                $password_hash = password_hash($password_nuevo, PASSWORD_BCRYPT);
                $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, password = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $password_hash, $id);
                $stmt->execute();
            } else {
                $_SESSION['error'] = "La contraseña actual no es correcta.";
                header("Location: edicion_datos.php");
                exit();
            }
        } else {
            // Si el usuario solo cambia nombre o email
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nombre, $apellidos, $email, $id);
            $stmt->execute();
        }

        if ($stmt->affected_rows >= 0) {
            $_SESSION['mensaje_exito'] = "Datos editados correctamente.";
            header("Location: index.php"); // Ahora redirige a `index.php`
            exit();
        } else {
            $_SESSION['error'] = "No se realizaron cambios en la base de datos.";
            header("Location: edicion_datos.php");
            exit();
        }
    } catch (Exception $e) {
        die("Error al actualizar datos del usuario: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h2>Editar Mis Datos</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?= htmlspecialchars($_SESSION['error']) ?></p>
            <?php unset($_SESSION['error']); // Eliminar mensaje después de mostrarlo ?>
        <?php endif; ?>

        <form method="post">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

            <label>Contraseña Actual (si deseas cambiarla):</label>
            <input type="password" name="password_actual">

            <label>Nueva Contraseña (si deseas cambiarla):</label>
            <input type="password" name="password_nuevo">

            <center><button type="submit" class="boton boton-verde">Guardar Cambios</button></center>
        </form>

        <center><button onclick="window.location.href='mis-datos.php'" class="boton boton-azul">Cancelar</button></center>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
