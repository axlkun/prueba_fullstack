<?php 
$id = isset($_GET['id']) ? $_GET['id'] : null; 
?>
<div id="commentDetails"></div>
<a href="/comment/update?id=<?php echo $id; ?>">Actualizar</a>
<button id="deleteComment">Eliminar Comentario</button>

<script>
    // obtener id
    const id = <?php echo $id; ?>;

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

            const response = await fetch(`http://localhost:8080/api/comment?id=${id}`, {
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
            const response = await fetch(`http://localhost:8080/api/comment?id=${id}`);
            const data = await response.json();

            const commentDetailsContainer = document.getElementById('commentDetails');
            const commentData = data.data;
            const html = `
                <h2>Comentario</h2>
                <p>ID: ${commentData.id}</p>
                <p>Usuario: ${commentData.user}</p>
                <p>Texto del Comentario: ${commentData.coment_text}</p>
                <p>Likes: ${commentData.likes}</p>
                <p>Fecha de Creación: ${commentData.creation_date}</p>
                <p>Fecha de Actualización: ${commentData.update_date}</p>
            `;
            commentDetailsContainer.innerHTML = html;
        } catch (error) {
            showError('Error al obtener los detalles del comentario: ' + error.message);
        }
    }

    // Verificar si hay un ID válido
    if (!id) {
        window.location.href = '/home';
    } else {
        // Obtener y mostrar los detalles del comentario
        getCommentDetails();

        // Manejar el evento de clic en el botón de eliminar comentario
        document.getElementById('deleteComment').addEventListener('click', deleteComment);
    }
</script>
