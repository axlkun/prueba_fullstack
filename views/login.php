<main class="contenedor centrar-form">

    <div>

        <h1>Iniciar sesión</h1>

        <?php if (isset($errores)) : ?>
            <?php foreach ($errores as $error) : ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data" action="/login">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" required>

            <div class="button-container">
                <input type="submit" value="Ingresar">
            </div>

            <div class="register-container">
                <p>No tienes una cuenta?</p><a href="/register">Registrarse</a>
            </div>

        </form>
    </div>

</main>