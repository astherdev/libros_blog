<?php
require_once 'includes/conexion.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Últimas entradas</h1>
    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2>{Titulo Entrada}</h2>
            <span class="fecha">{Categoria} | {Fecha de publicación}</span>
            <p>
                {Descripcion de entrada}
            </p>
        </a>
    </article>
    
    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2>{Titulo Entrada}</h2>
            <span class="fecha">{Categoria} | {Fecha de publicación}</span>
            <p>
                {Descripcion de entrada}
            </p>
        </a>
    </article>
    
    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2>{Titulo Entrada}</h2>
            <span class="fecha">{Categoria} | {Fecha de publicación}</span>
            <p>
                {Descripcion de entrada}
            </p>
        </a>
    </article>
    
    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2>{Titulo Entrada}</h2>
            <span class="fecha">{Categoria} | {Fecha de publicación}</span>
            <p>
                {Descripcion de entrada}
            </p>
        </a>
    </article>
    
    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2>{Titulo Entrada}</h2>
            <span class="fecha">{Categoria} | {Fecha de publicación}</span>
            <p>
                {Descripcion de entrada}
            </p>
        </a>
    </article>
    
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div> <!--fin principal-->

<?php require_once 'includes/footer.php'; ?>
