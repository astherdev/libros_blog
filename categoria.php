<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Verificamos si se recibe un ID de categoría válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoria_id = $_GET['id'];

    // Obtener el nombre de la categoría
    $sql_categoria = "SELECT nombre FROM categorias WHERE id = $categoria_id";
    $resultado_categoria = mysqli_query($conexion, $sql_categoria);

    if ($resultado_categoria && mysqli_num_rows($resultado_categoria) > 0) {
        $categoria = mysqli_fetch_assoc($resultado_categoria);
    } else {
        // Si no se encuentra la categoría, redirigir a la página principal
        header("Location: index.php");
        exit();
    }

    // Obtener las entradas de la categoría
    $sql_entradas = "SELECT entradas.*, usuarios.nombre, usuarios.apellidos FROM entradas 
                    INNER JOIN usuarios ON entradas.usuario_id = usuarios.id 
                    WHERE categoria_id = $categoria_id ORDER BY fecha DESC";
    $resultado_entradas = mysqli_query($conexion, $sql_entradas);
} else {
    // Si no se recibe un ID válido, redirigir a la página principal
    header("Location: index.php");
    exit();
}
?>


<div id="principal">
    <h1>Reseñas en la categoría: <?= isset($categoria) ? htmlspecialchars($categoria['nombre']) : 'Categoría no encontrada'; ?></h1>

    <?php if (mysqli_num_rows($resultado_entradas) > 0): ?>
        <?php while ($entrada = mysqli_fetch_assoc($resultado_entradas)): ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">  
                    <h2><?=$entrada['titulo']?></h2>
                </a>
                <span class="fecha">
                <strong><?=$entrada['nombre']?> <?=$entrada['apellidos']?> | <?=$entrada['fecha']?></strong>
                </span>
                <p><?= substr(htmlspecialchars($entrada['descripcion']), 0, 180) . '...'; ?></p>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay reseñas para este género literario.</p>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
