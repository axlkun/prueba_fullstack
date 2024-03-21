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
    // Función para enviar el formulario y crear la cuenta
    function submitForm(event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        const jsonData = convertFormDataToJson(formData);

        sendRequest(jsonData);
    }

    // Función para convertir FormData a JSON
    function convertFormDataToJson(formData) {
        const jsonData = {};
        formData.forEach(function(value, key) {
            jsonData[key] = value;
        });
        return jsonData;
    }

    // Función para enviar la solicitud al servidor
    function sendRequest(jsonData) {
        fetch("http://localhost:8080/api/usuario", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(handleResponse)
        .catch(handleError);
    }

    // Función para manejar la respuesta del servidor
    function handleResponse(data) {
        alert(data.message);
        if (data.status === "201") {
            window.location.href = "/";
        }
    }

    // Función para manejar errores
    function handleError(error) {
        console.error("Error al enviar la solicitud:", error);
        alert("Error al crear la cuenta. Por favor, inténtalo de nuevo más tarde.");
    }

    // Agregar el evento submit al formulario
    document.getElementById("signup-form").addEventListener("submit", submitForm);
</script>
