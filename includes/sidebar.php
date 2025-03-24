<div id="contenedor">
    <!-- BARRA LATERAL -->
    <aside id="sidebar">
        <div id="buscador" class="bloque">
            <h3>Buscar</h3>
            <form action="buscar.php" method="POST"> 
                <input type="text" name="busqueda" />
                <input type="submit" value="Buscar" />
            </form>
        </div>
        
        <?php  session_start(); ?>
        <?php
        if (isset($_SESSION['nombre']) && isset($_SESSION['apellidos'])){ ?>
            <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['nombre'] . ' ' . $_SESSION['apellidos']; ?></h3>
            <a href="crear-entrada.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoría</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
            </div>
        <?php }; ?>

        
        <?php if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])): ?>
    <div id="login" class="bloque">
        <h3>Inicia Sesión</h3>
        <?php if (isset($_SESSION['error-login'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['error-login']; ?>
            </div>
            <?php unset($_SESSION['error-login']); ?>
        <?php endif; ?>

        <form action="login.php" method="POST"> 
            <label for="email">Email</label>
            <input type="email" name="email" required/>
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" required />
            
            <input type="submit" value="Entrar" />
        </form>
    </div>
    
    <div id="register" class="bloque">
        <h3>Registrarse</h3>
        <form action="registro.php" method="POST"> 
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required />
            
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" required />
            
            <label for="email">Email</label>
            <input type="email" name="email" required />
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" required />
            
            <input type="submit" name="submit" value="Registrar" />
        </form>
    </div>
<?php endif; ?>

    </aside>