<?php
require_once 'includes/conexion.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($nombre) || empty($apellidos) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Error en algún dato.";
        header("Location: index.php");
        exit;
    }

    // Verificar si el email ya está registrado
    $sql_check = "SELECT id FROM usuarios WHERE email = '$email'";
    $result_check = mysqli_query($conexion, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        $_SESSION['error'] = "El email ya está registrado.";
        header("Location: index.php");
        exit;
    }

    // Insertar en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql_insert = "INSERT INTO usuarios (nombre, apellidos, email, password, fecha) 
                VALUES ('$nombre', '$apellidos', '$email', '$hashed_password', NOW())";

    if (mysqli_query($conexion, $sql_insert)) {
        $_SESSION['exito'] = "Se registró correctamente.";
    } else {
        $_SESSION['error'] = "Error al registrar usuario.";
    }

    header("Location: index.php");
    exit;
}
?>
