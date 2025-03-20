<?php 
require_once 'includes/conexion.php'; 

// Obtenemos las categorías de la base de datos
$sql = "SELECT * FROM categorias";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Blog de Libros</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <!-- CABECERA -->
    <header id="cabecera">
        <!-- LOGO -->
        <div id="logo">
            <a href="index.php">
                Blog de Libros
            </a>
        </div>
        
        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <?php
                while ($categoria = mysqli_fetch_assoc($resultado)){
                ?>
                <li>
                    <a href="categoria.php?id=<?=$categoria['id']?>"><?= $categoria['nombre']; ?></a>
                </li>
                <?php
                };
                ?>
                <li>
                    <a href="sobre-mi.php">Sobre mí</a>
                </li>
                <li>
                    <a href="contacto.php">Contacto</a>
                </li>
            </ul>
        </nav>
        
        <div class="clearfix"></div>
    </header>
