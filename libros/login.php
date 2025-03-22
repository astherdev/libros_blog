<?php 
require_once("includes/conexion.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)){
        $_SESSION['error'] = "Algun dato esta vacio";
        header("Location: index.php");
        exit();
    }

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexion, $sql);

    if($row = mysqli_fetch_assoc($result)){ 
        if(password_verify($password, $row['password'])){
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nombre'] = $row['nombre'];
            $_SESSION['usuario_apellidos'] = $row['apellidos'];
            header('Location: index.php');
            exit();
        }else {
        $_SESSION['error-login'] = "Usuario o contraseña incorrectos"; // Mensaje de error si falla
        header("Location: index.php");
        exit();
    }
    }
}

?>
