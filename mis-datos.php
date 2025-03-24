<?php
    require_once 'includes/conexion.php';
    require_once 'includes/header.php';
    require_once 'includes/sidebar.php';

    // Verificar si la sesión está iniciada correctamente
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $id = $_SESSION['id'];

    // Verificar si los datos están en la sesión
    if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellidos']) || !isset($_SESSION['email'])) {
        $sql = "SELECT nombre, apellidos, email FROM usuarios WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($result);

        if (!$usuario) {
            die("Error: No se encontraron datos del usuario.");
        }

        // Guardar los datos en la sesión
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellidos'] = $usuario['apellidos'];
        $_SESSION['email'] = $usuario['email'];
    }

    // Mostrar los datos de la sesión
    $usuario = [
        'nombre' => $_SESSION['nombre'],
        'apellidos' => $_SESSION['apellidos'],
        'email' => $_SESSION['email']
    ];
    ?>
<div id="principal">
    <div class="container">
        <h2>Mis Datos</h2>
        <form>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" readonly>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" readonly>

            <label for="email">Email:</label>
            <input type="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" readonly>

            <center><button type="button" onclick="window.location.href='edicion_datos.php'" class="boton boton-naranja">Editar Datos</button></center>
        </form>
    </div>
    </div>
    <?php require_once 'includes/footer.php'; ?>
