<main class="contenedor seccion centrar-login">
    <h1>Iniciar sesión</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/auth/login">
        <fieldset>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" required>

        </fieldset>

        <div class="centrar-boton">
            <input type="submit" value="Ingresar" class="boton boton-verde">
        </div>

        <div class="espacio">
            <p>No tienes una cuenta?</p><a href="/register">Registrarse</a>
        </div>
        
    </form>
</main>
