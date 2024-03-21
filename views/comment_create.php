<main class="contenedor centrar-form-comment">

    <div class="">
        <h1>Nuevo comentario</h1>
        <form class="formulario" id="createCommentForm">

            <label for="coment_text">Mensaje</label>
            <textarea id="coment_text" name="coment_text" required></textarea>

            <div>
                <button type="button" id="createCommentButton">Comentar</button>
            </div>
        </form>
    </div>

</main>

<script>
    async function createComment() {
        const form = document.getElementById('createCommentForm');
        const formData = new FormData(form);
        const formJSON = convertFormDataToJson(formData);

        // Obtener el ID de usuario de la sesión
        const userId = getUserIdFromSession();
        if (!userId) {
            console.error('ID de usuario no encontrado en la sesión.');
            return;
        }

        // Agregar campos al objeto JSON
        formJSON['user'] = userId;
        formJSON['likes'] = 0;

        const url = 'http://localhost:8080/api/comment';

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formJSON)
            });

            const data = await response.json();

            handleCommentResponse(data);
        } catch (error) {
            handleCommentError(error);
        }
    }

    function convertFormDataToJson(formData) {
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
        return jsonData;
    }

    function getUserIdFromSession() {
        return <?php echo json_encode($_SESSION['id'] ?? ''); ?>;
    }

    function handleCommentResponse(data) {
        if (data.status === '201') {
            alert(data.message);
            window.location.href = `/home`;
        } else {
            alert(data.message);
        }
    }

    function handleCommentError(error) {
        alert('Error al crear el comentario.');
    }

    document.getElementById('createCommentButton').addEventListener('click', createComment);
</script>