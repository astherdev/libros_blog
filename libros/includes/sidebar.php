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
        
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, {Nombre Usuario}</h3>
            <!--botones-->
            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoria</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
        </div>
        
        <div id="login" class="bloque">
            <h3>Inicia Sesión</h3>
            <div class="alerta alerta-error">
                {Usuario no existe}
            </div>
            
            <form action="login.php" method="POST"> 
                <label for="email">Email</label>
                <input type="email" name="email" />
                
                <label for="password">Contraseña</label>
                <input type="password" name="password" />
                
                <input type="submit" value="Entrar" />
            </form>
        </div>
        
        <div id="register" class="bloque">
            <h3>Registrarse</h3>
            
            <?php session_start(); ?> <!-- Iniciar sesión en index.php -->

            <!-- Mostrar mensaje de éxito -->
            <?php if (isset($_SESSION['exito'])): ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['exito']; ?>
                </div>
                <?php unset($_SESSION['exito']); // Limpiar mensaje después de mostrarlo ?>
            <?php endif; ?>

            <!-- Mostrar mensaje de error -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); // Limpiar mensaje después de mostrarlo ?>
            <?php endif; ?>
            
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
    </aside>