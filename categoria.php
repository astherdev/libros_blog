<?php
require_once 'includes/conexion.php';

if (isset($_GET['id'])) {
    $id_categoria = (int) $_GET['id']; // Convierte a entero
} else {
    $id_categoria = 0; // Valor por defecto
}

$sql = "SELECT * FROM entradas WHERE categoria_id = $id_categoria ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $sql);
?>

<h1>Entradas en esta categoría</h1>

<?php while ($entrada = mysqli_fetch_assoc($resultado)){ ?>
    <article>
        <h2><?php echo $entrada['titulo']; ?></h2>
        <p><?php echo $entrada['descripcion']; ?></p>
        <a href="entrada.php?id=<?php echo $entrada['id']?>">Leer más</a>
    </article>
<?php }; ?>
