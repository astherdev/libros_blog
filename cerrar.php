<?php
session_start(); // Iniciar la sesión
session_destroy(); // Destruir la sesión
header("Location: index.php"); // Redirigir al inicio
exit();
?>