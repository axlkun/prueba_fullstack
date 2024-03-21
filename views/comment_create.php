<main class="contenedor seccion centrar-login">
    <h1>Nuevo comentario</h1>

    <form class="formulario" id="createCommentForm">
        <fieldset>

            <label for="coment_text">Mensaje</label>
            <textarea id="coment_text" name="coment_text" required></textarea>

        </fieldset>

        <div class="centrar-boton">
            <button type="button" id="createCommentButton" class="boton boton-verde">Comentar</button>
        </div>

    </form>
</main>

<script>
    document.getElementById('createCommentButton').addEventListener('click', function() {
        const form = document.getElementById('createCommentForm');
        const formData = new FormData(form);
        const formJSON = {};

        formData.forEach((value, key) => {
            formJSON[key] = value;
        });

        // Obtener el ID de usuario de la sesión
        const userId = <?php echo json_encode($_SESSION['id'] ?? ''); ?>;
        if (!userId) {
            console.error('ID de usuario no encontrado en la sesión.');
            return;
        }

        // Agregar campos al objeto JSON
        formJSON['user'] = userId;
        formJSON['likes'] = 0;

        const url = 'http://localhost:8080/api/comment';

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formJSON)
            })
            .then(response => response.json())
            .then(data => {
                // Redireccionar a la página del comentario creado si la creación fue exitosa

                if (data.status === '201') {
                    window.location.href = `/home`;
                }
            })
            .catch(error => {
                console.error('Error al crear el comentario:', error);
            });
    });
</script>
