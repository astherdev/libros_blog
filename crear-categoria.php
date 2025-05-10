<?php
require_once ("includes/conexion.php");
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div id="principal">
    <br>
    <h1>Crear un nuevo género literario</h1>
    <br>
    
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre del género:</label>
        <input type="text" name="nombre" required>
        
        <input type="submit" value="Guardar">
    </form>
    <button type="button" onclick="window.location.href='index.php'" class="boton boton-azul"> Volver al Inicio</button>

    <br>
    </div>
    <?php include 'includes/footer.php'; ?>
