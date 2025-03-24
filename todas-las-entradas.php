<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Consulta para obtener todas las entradas
$sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, c.nombre AS categoria, u.nombre AS usuario 
        FROM entradas e
        JOIN categorias c ON e.categoria_id = c.id
        JOIN usuarios u ON e.usuario_id = u.id
        ORDER BY e.fecha DESC";

$resultado = mysqli_query($conexion, $sql);

// Verifica si hay errores en la consulta SQ

?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las entradas</h1>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <?php while ($entrada = mysqli_fetch_assoc($resultado)): ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><strong><?=$entrada['fecha']?> | <?=$entrada['usuario']?> | Categoría: <?=$entrada['categoria']?></strong></span>
                    <p>
                        <?=mb_substr($entrada['descripcion'], 0, 150) . '...'?> <!-- Muestra solo 150 caracteres -->
                    </p>
                </a>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay entradas disponibles.</p>
    <?php endif; ?>
    
    <div id="ver-todas">
        <center><button type="button" onclick="window.location.href='index.php'" class="boton boton-azul">Volver al inicio</button></center>
        <center><button type="button" onclick="window.location.href='editar_entradas.php'" class="boton boton-verde"> Editar Entradas</button></center>
    </div>
</div> <!-- fin principal -->

<?php require_once 'includes/footer.php'; ?>
