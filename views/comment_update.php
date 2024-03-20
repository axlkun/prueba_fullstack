<main class="contenedor seccion centrar-login">
    <h1>Actualizar comentario</h1>

    <form class="formulario" id="updateForm">
        <fieldset>

            <label for="coment_text">Mensaje</label>
            <textarea id="coment_text" name="coment_text" required><?php echo isset($commentDetails->coment_text) ? $commentDetails->coment_text : ''; ?></textarea>

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

        const id = <?php echo json_encode($commentDetails->id ?? ''); ?>;
        const url = `http://localhost:8080/api/comment?id=${id}`;

        fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formJSON)
            })
            .then(response => response.json())
            .then(data => {
                // Redireccionar a la página anterior si la actualización fue exitosa

                if (data.status === '201') {
                    window.location.href = `/comment/detail?id=${id}`;
                }
            })
            .catch(error => {
                console.error('Error al actualizar el perfil:', error);
            });
    });
</script>