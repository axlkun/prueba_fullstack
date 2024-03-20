<main class="contenedor seccion centrar-login">
    <h1>Actualizar perfil</h1>

    <form class="formulario" id="updateForm">
        <fieldset>

            <label for="fullname">Nombre completo:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Ingresa tu nombre completo" value="<?php echo $userDetails->fullname ?? ''; ?>" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" value="<?php echo $userDetails->email ?? ''; ?>" required>

            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña" value="<?php echo $userDetails->pass ?? ''; ?>" required>

            <label for="openid">Openid:</label>
            <input type="number" id="openid" name="openid" placeholder="Ingresa tu openid" value="<?php echo $userDetails->openid ?? ''; ?>" required>

        </fieldset>

        <div class="centrar-boton">
            <button type="button" id="updateButton" class="boton boton-verde">Actualizar</button>
        </div>
        
    </form>
</main>

<script>
    document.getElementById('updateButton').addEventListener('click', function() {
        const form = document.getElementById('updateForm');
        const formData = new FormData(form);
        const formJSON = {};

        formData.forEach((value, key) => {
            formJSON[key] = value;
        });

        const id = <?php echo json_encode($userDetails->id ?? ''); ?>;
        const url = `http://localhost:8080/api/usuario?id=${id}`;

        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formJSON)
        })
        .then(response => response.json())
        .then(data => {
            // Redireccionar a la página de perfil si la actualización fue exitosa
            console.log(data);

            if (data.status === '201') {
                window.location.href = '/profile';
            }
        })
        .catch(error => {
            console.error('Error al actualizar el perfil:', error);
        });
    });
</script>
