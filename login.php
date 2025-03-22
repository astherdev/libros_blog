<?php 
require_once("includes/conexion.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Algun dato está vacío";
        header("Location: login.php");
        exit();
    }

    // Usar consulta segura con prepared statements
    $sql = "SELECT id, nombre, apellidos, email, password FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($result);

    if ($usuario && password_verify($password, $usuario['password'])) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellidos'] = $usuario['apellidos'];
        $_SESSION['email'] = $usuario['email'];

        header('Location: index.php'); // Redirigir al inicio
        exit();
    } else {
        $_SESSION['error-login'] = "Usuario o contraseña incorrectos";
        header("Location: login.php");
        exit();
    }
}
?>
