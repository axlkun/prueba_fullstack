<main class="contenedor centrar-form-comment">

    <div>
        <h1>Actualizar comentario</h1>

        <form class="formulario" id="updateForm">

            <label for="coment_text">Mensaje</label>
            <textarea id="coment_text" name="coment_text" required><?php echo isset($commentDetails->coment_text) ? $commentDetails->coment_text : ''; ?></textarea>

            <div class="centrar-boton">
                <button type="button" id="updateButton" class="boton boton-verde">Actualizar</button>
            </div>
        </form>
    </div>

</main>

<script>
    async function updateComment() {
        try {
            const form = document.getElementById('updateForm');
            const formData = new FormData(form);
            const formJSON = {};

            formData.forEach((value, key) => {
                formJSON[key] = value;
            });

            const id = <?php echo json_encode($commentDetails->id ?? ''); ?>;
            const url = `http://localhost:8080/api/comment?id=${id}`;

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
                window.location.href = `/comment/detail?id=${id}`;
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Error al actualizar el comentario:', error);
            alert('Error al actualizar el comentario. Por favor, inténtalo de nuevo.');
        }
    }

    // Manejar el evento de clic en el botón de actualización
    document.getElementById('updateButton').addEventListener('click', updateComment);
</script>