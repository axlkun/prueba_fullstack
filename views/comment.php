<?php
$commentId = isset($_GET['id']) ? $_GET['id'] : null;
$sessionId = $_SESSION['id'];
?>

<main class="contenedor centrar-form-comment">

    <div>
        <h1>Comentario</h1>
        <div id="commentDetails" class="comment-details"></div>

        <div class="btn-container">
            <button id="updateComment" class="btn">Actualizar</button>
            <button id="deleteComment" class="btn-eliminar">Eliminar Comentario</button>
        </div>

    </div>

</main>

<script>
    // obtener id
    const commentId = <?php echo $commentId; ?>;

    // obtener sessionId
    const sessionId = '<?php echo $sessionId; ?>';

    // Función para mostrar mensajes de error
    function showError(message) {
        console.error(message);
        alert('Error: ' + message);
        window.location.href = '/home';
    }

    // Función para eliminar un comentario
    async function deleteComment() {
        try {
            const confirmed = confirm('¿Estás seguro de que deseas eliminar este comentario?');
            if (!confirmed) return;

            const response = await fetch(`http://localhost:8080/api/comment?id=${commentId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
            });

            const data = await response.json();
            if (data.status === '201') {
                window.location.href = '/home';
            } else {
                alert('Error al eliminar el comentario. Por favor, inténtalo de nuevo.');
            }
        } catch (error) {
            showError('Error al eliminar el comentario: ' + error.message);
        }
    }

    // Función principal para obtener detalles del comentario
    async function getCommentDetails() {
        try {
            const response = await fetch(`http://localhost:8080/api/comment?id=${commentId}`);
            const data = await response.json();

            const commentDetailsContainer = document.getElementById('commentDetails');
            const commentData = data.data;
            const html = `
                
            <p><strong>ID:</strong> ${commentData.id}</p>
            <p><strong>Usuario:</strong> ${commentData.user}</p>
            <p><strong>Texto:</strong> ${commentData.coment_text}</p>
            <p><strong>Likes:</strong> ${commentData.likes}</p>
            <p><strong>Fecha de Creación:</strong> ${commentData.creation_date}</p>
            <p><strong>Fecha de Actualización:</strong> ${commentData.update_date}</p>

            `;
            commentDetailsContainer.innerHTML = html;

            // Deshabilitar el botón de actualizar si el usuario no es el mismo que el sessionId
            if (commentData.user !== sessionId) {
                document.getElementById('updateComment').disabled = true;
            } else {
                // Habilitar el botón de actualizar si el usuario es el mismo que el sessionId
                document.getElementById('updateComment').addEventListener('click', function() {
                    window.location.href = `/comment/update?id=${commentId}`;
                });
            }

        } catch (error) {
            showError('Error al obtener los detalles del comentario: ' + error.message);
        }
    }

    // Verificar si hay un ID válido
    if (!commentId) {
        window.location.href = '/home';
    } else {
        // Obtener y mostrar los detalles del comentario
        getCommentDetails();

        // Manejar el evento de clic en el botón de eliminar comentario
        document.getElementById('deleteComment').addEventListener('click', deleteComment);
    }
</script>