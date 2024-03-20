<main class="contenedor seccion centrar-login">
    <h1>Crear una cuenta</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/login">
        <fieldset>

            <label for="fullname">Nombre completo:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Ingresa tu nombre completo" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" required>

            <label for="openid">Openid:</label>
            <input type="number" id="openid" name="openid" placeholder="Ingresa tu openid" required>
            <!-- Cambié 'name="password"' por 'name="contraseña"' -->

        </fieldset>

        <div class="centrar-boton">
            <input type="submit" value="Ingresar" class="boton boton-verde">
            <!-- <a href="/inventario_ayuntamiento/registros.php" class="boton-rojo">Ingresar</a> -->
        </div>

        <div class="espacio">
            <p>Ya tienes cuenta?</p><a href="/">Iniciar sesion</a>
        </div>
        
    </form>
</main>
