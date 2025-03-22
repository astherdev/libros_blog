<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$sql = "SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5";
$resultado = mysqli_query($conexion, $sql);
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Últimas entradas</h1>

    <?php while ($entrada = mysqli_fetch_assoc($resultado)): ?>
        <article class="entrada">
            <a href="entrada.php?id=<?=$entrada['id']?>">
                <h2><?=$entrada['titulo']?></h2>
                <span class="fecha"><strong><?=$entrada['fecha']?> | <?=$_SESSION['usuario_nombre'] . ' ' . $_SESSION['usuario_apellidos']?></strong></span>
                <p>
                    <?=substr($entrada['descripcion'], 0, 100) . '...'?> <!-- Muestra los 100 primeros carácteres -->
                </p>
            </a>
        </article>
    <?php endwhile; ?>
    
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div> <!--fin principal-->

<?php require_once 'includes/footer.php'; ?>
