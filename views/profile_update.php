<main class="contenedor centrar-form">

    <div>
        <h1>Actualizar perfil</h1>

        <form class="formulario" id="updateForm">

            <label for="fullname">Nombre completo:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Ingresa tu nombre completo" value="<?php echo $userDetails->fullname ?? ''; ?>" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" value="<?php echo $userDetails->email ?? ''; ?>" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" value="<?php echo $userDetails->pass ?? ''; ?>" required>

            <label for="openid">Openid:</label>
            <input type="number" id="openid" name="openid" placeholder="Ingresa tu openid" value="<?php echo $userDetails->openid ?? ''; ?>" required>

            <div class="centrar-boton">
                <button type="button" id="updateButton">Actualizar</button>
            </div>
        </form>
    </div>

</main>

<script>
    async function updateProfile() {
        try {
            const form = document.getElementById('updateForm');
            const formData = new FormData(form);
            const formJSON = {};

            formData.forEach((value, key) => {
                formJSON[key] = value;
            });

            const id = <?php echo json_encode($userDetails->id ?? ''); ?>;
            const url = `http://localhost:8080/api/usuario?id=${id}`;

            const response = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formJSON)
            });

            const data = await response.json();

            if (data.status === '201') {
                alert(data.message);
                window.location.href = '/profile';
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Error al actualizar el perfil:', error);
            alert('Error al actualizar el perfil. Por favor, inténtalo de nuevo.');
        }
    }

    // Manejar el evento de clic en el botón de actualización
    document.getElementById('updateButton').addEventListener('click', updateProfile);
</script>