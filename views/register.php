<main class="contenedor centrar-form">


    <div>
        <h1>Crear una cuenta</h1>

        <form class="formulario" method="POST" enctype="multipart/form-data" action="/login" id="signup-form">

            <label for="fullname">Nombre completo:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Ingresa tu nombre completo" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" required>

            <label for="openid">Openid:</label>
            <input type="number" id="openid" name="openid" placeholder="Ingresa tu openid" required>

            <div class="button-container">
                <input type="submit" value="Crear cuenta">
            </div>

            <div class="register-container">
                <p>¿Ya tienes cuenta?</p><a href="/login">Iniciar sesión</a>
            </div>
        </form>
    </div>

</main>

<script>
    async function submitForm(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const jsonData = convertFormDataToJson(formData);

        try {
            const response = await fetch("http://localhost:8080/api/usuario", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(jsonData)
            });

            const data = await response.json();

            handleResponse(data);
        } catch (error) {
            handleError(error);
        }
    }

    function convertFormDataToJson(formData) {
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
        return jsonData;
    }

    function handleResponse(data) {
        alert(data.message);
        if (data.status === "201") {
            window.location.href = "/login";
        }
    }

    function handleError(error) {
        console.error("Error al enviar la solicitud:", error);
        alert("Error al crear la cuenta. Por favor, inténtalo de nuevo más tarde.");
    }

    document.getElementById("signup-form").addEventListener("submit", submitForm);
</script>