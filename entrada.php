<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Obtener la entrada según el ID de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT e.*, u.nombre, u.apellidos FROM entradas e ".
            "INNER JOIN usuarios u ON e.usuario_id = u.id WHERE e.id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $entrada = mysqli_fetch_assoc($resultado);
    } else {
        header("Location: index.php"); 
        exit();
    }
} else {
    header("Location: index.php"); 
    exit();
}
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
<article class="entrada">
    <a href="entrada.php?id=<?=$entrada['id']?>">  
        <h2><?=$entrada['titulo']?></h2>
    </a>
    <span class="fecha">
    <strong><?=$entrada['nombre']?> <?=$entrada['apellidos']?> | <?=$entrada['fecha']?></strong>
    </span>
    <p><?=$entrada['descripcion']?></p>
    <a href="index.php" class="boton boton-azul">Volver</a>
</div> 

<?php require_once 'includes/footer.php'; ?>
