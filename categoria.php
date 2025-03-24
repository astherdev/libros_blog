<?php
require_once 'includes/conexion.php';

// ID de la categoría que deseas mostrar en el index
$id_categoria = 1; // Cambia este valor al ID de la categoría que deseas mostrar

$sql = "SELECT * FROM entradas WHERE categoria_id = $id_categoria ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $sql);
?>

<h1>Entradas en la categoría específica</h1>

<?php while ($entrada = mysqli_fetch_assoc($resultado)){ ?>
    <article>
        <h2><?php echo $entrada['titulo']; ?></h2>
        <p><?php echo $entrada['descripcion']; ?></p>
        <a href="entrada.php?id=<?php echo $entrada['id']?>">Leer más</a>
    </article>
<?php }; ?>
