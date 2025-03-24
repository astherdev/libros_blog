<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Consulta para obtener todas las entradas
$sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, c.nombre AS categoria, u.nombre AS usuario , u.apellidos AS apellido
        FROM entradas e
        JOIN categorias c ON e.categoria_id = c.id
        JOIN usuarios u ON e.usuario_id = u.id
        ORDER BY e.fecha DESC";

$resultado = mysqli_query($conexion, $sql);

// Verifica si hay errores en la consulta SQ

?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las reseñas</h1>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <?php while ($entrada = mysqli_fetch_assoc($resultado)): ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><strong><?=$entrada['fecha']?> | <?=$entrada['usuario']?>  <?=$entrada['apellido']?> | Categoría: <?=$entrada['categoria']?></strong></span>
                    <p>
                        <?=mb_substr($entrada['descripcion'], 0, 150) . '...'?> <!-- Muestra solo 150 caracteres -->
                    </p>
                </a>
                <br>
                <a href="editar_entradas.php?id=<?=$entrada['id']?>" class="boton boton-verde">Editar Reseñas</a>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay entradas disponibles.</p>
    <?php endif; ?>
    
    <div id="ver-todas">
        <br>
        <center><button type="button" onclick="window.location.href='index.php'" class="boton boton-azul">Volver al inicio</button></center>
        <br>
    </div>
</div> <!-- fin principal -->

<?php require_once 'includes/footer.php'; ?>
