<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

if (isset($_POST['busqueda']) && !empty($_POST['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);

    // Consulta para buscar en los títulos y descripciones de las entradas
    $sql = "SELECT entradas.*, usuarios.nombre, usuarios.apellidos FROM entradas 
            INNER JOIN usuarios ON entradas.usuario_id = usuarios.id 
            WHERE entradas.titulo LIKE '%$busqueda%' OR entradas.descripcion LIKE '%$busqueda%' 
            ORDER BY entradas.fecha DESC";
    $resultado = mysqli_query($conexion, $sql);
} else {
    header("Location: index.php"); // Si no se ingresó búsqueda, redirige al inicio
    exit();
}
?>
<div id="principal">
    <h1>Resultados de búsqueda para: "<?= htmlspecialchars($busqueda); ?>"</h1>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <?php while ($entrada = mysqli_fetch_assoc($resultado)): ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">  
                    <h2><?=$entrada['titulo']?></h2>
                </a>
                <span class="fecha">
                <strong><?=$entrada['nombre']?> <?=$entrada['apellidos']?> | <?=$entrada['fecha']?></strong>
                </span>
                <p><?=$entrada['descripcion']?></p>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No se encontraron resultados para tu búsqueda.</p>
    <?php endif; ?>
</div>

