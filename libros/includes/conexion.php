<?php
$hostname = "localhost";
$username = "root";
$password = "123456";
$database = "libros";

$conexion = mysqli_connect($hostname, $username, $password, $database);
if(mysqli_connect_errno()){
    echo "Error en la conexion ". mysqli_connect_error();
}
else{
    echo "<h1>Nos conectamos </h1>";
}

?>