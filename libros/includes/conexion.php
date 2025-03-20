<?php
$hostname = "localhost";
$username = "root";
$password = "123456";
$database = "libros";

// Conectar a la base de datos
$conexion = mysqli_connect($hostname, $username, $password, $database);

// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Configurar el conjunto de caracteres
mysqli_set_charset($conexion, "utf8mb4");
?>
