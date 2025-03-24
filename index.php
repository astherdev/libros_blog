<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Obtener todas las entradas de la base de datos
$sql = "SELECT e.*, u.nombre, u.apellidos 
        FROM entradas e 
        JOIN usuarios u ON e.usuario_id = u.id 
        ORDER BY e.fecha DESC";

$resultado = mysqli_query($conexion, $sql);
?>



<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Últimas entradas</h1>

    <?php while ($entrada = mysqli_fetch_assoc($resultado)): ?>
        <article class="entrada">
            <a href="entrada.php?id=<?=$entrada['id']?>">  
                <h2><?=$entrada['titulo']?></h2>
            </a>
            <span class="fecha">
            <strong><?=$entrada['nombre']?> <?=$entrada['apellidos']?> | <?=$entrada['fecha']?></strong>
            </span>
            <p>
                <?=substr($entrada['descripcion'], 0, 150) . '...'?> 
            </p>
            <a href="entrada.php?id=<?=$entrada['id']?>" class="boton boton-azul">Leer más</a>
        </article>
    <?php endwhile; ?>

    <div id="ver-todas">
        <center><button type="button" onclick="window.location.href='todas-las-entradas.php'" class="boton boton-azul">Ver todas las entradas</button></center>
    </div>
</div> 

<?php require_once 'includes/footer.php'; ?>

<?php
if (isset($_SESSION['mensaje'])): ?>
    <div id="popup-mensaje" class="popup <?=$_SESSION['tipo_mensaje']?>">
        <p><?=$_SESSION['mensaje']?></p>
        <button onclick="cerrarPopup()">Cerrar</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("popup-mensaje").style.display = "block";
        });

        function cerrarPopup() {
            document.getElementById("popup-mensaje").style.display = "none";
        }
    </script>

    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #E3F2FD; /* Azul claro */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
            text-align: center;
            width: 300px;
            font-family: Arial, sans-serif;
        }

        .popup.exito {
            border: 3px solid #64B5F6; /* Azul medio */
            color: #1565C0; /* Azul oscuro */
        }

        .popup.error {
            border: 3px solid #42A5F5; /* Azul más oscuro */
            color: #0D47A1; /* Azul profundo */
        }

        .popup button {
            margin-top: 10px;
            padding: 8px 12px;
            background: #1E88E5; /* Azul brillante */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        .popup button:hover {
            background: #1565C0; /* Azul más oscuro en hover */
        }
    </style>

    <?php unset($_SESSION['mensaje']); unset($_SESSION['tipo_mensaje']); ?>
<?php endif; ?>
