<main class="contenedor seccion centrar-login">
    <h1>Crear una cuenta</h1>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/login" id="signup-form">
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
            <input type="submit" value="Crear cuenta" class="boton boton-verde">
        </div>

        <div class="espacio">
            <p>¿Ya tienes cuenta?</p><a href="/">Iniciar sesión</a>
        </div>
        
    </form>
</main>

<script>
    document.getElementById("signup-form").addEventListener("submit", function(event) {
        event.preventDefault();
        
        // Recolectar datos del formulario
        const formData = new FormData(this);

        // Convertir los datos a un objeto JSON
        const jsonData = {};
        formData.forEach(function(value, key) {
            jsonData[key] = value;
        });

        // Realizar la solicitud al endpoint
        fetch("http://localhost:8080/api/usuario", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor
            alert(data.message); // Muestra un mensaje de éxito o error
            
            if (data.status === "201") {
                // Opcional: Redireccionar a otra página después de crear la cuenta
                window.location.href = "/";
            }
        })
        .catch(error => {
            console.error("Error al enviar la solicitud:", error);
            alert("Error al crear la cuenta. Por favor, inténtalo de nuevo más tarde.");
        });
    });
</script>
