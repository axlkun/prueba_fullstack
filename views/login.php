<main class="contenedor seccion centrar-login">
    <h1>Iniciar sesión</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/login">
        <fieldset>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" placeholder="Ingresa tu contraseña" required>
            <!-- Cambié 'name="password"' por 'name="contraseña"' -->

        </fieldset>

        <div class="centrar-boton">
            <input type="submit" value="Ingresar" class="boton boton-verde">
            <!-- <a href="/inventario_ayuntamiento/registros.php" class="boton-rojo">Ingresar</a> -->
        </div>

        <div class="espacio">
            <p>No tienes una cuenta?</p><a href="/register">Registrarse</a>
        </div>
        
    </form>
</main>
