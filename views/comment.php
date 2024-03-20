<?php $id = isset($_GET['id']) ? $_GET['id'] : null; ?>
<div id="commentDetails"></div>
<a href="/comment/update?id=<?php echo $id; ?>">Actualizar</a>
<button id="deleteComment">Eliminar Comentario</button>

<script>
    // obtener id
    const id = <?php echo $id; ?>;

    if (!id) {
        window.location.href = '/home';
    } else {
        // consumir endpoint
        fetch(`http://localhost:8080/api/comment?id=${id}`)
            .then(response => response.json())
            .then(data => {

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
            })
            .catch(error => {
                console.error('Error al obtener los detalles del comentario:', error);
                // Si ocurre un error, redirecciona a la página de inicio
                window.location.href = '/home';
            });

            // eliminar comentario
            document.getElementById('deleteComment').addEventListener('click', function(event) {
            // Confirmar si el usuario realmente desea eliminar el comentario
            if (confirm('¿Estás seguro de que deseas eliminar este comentario?')) {
                // Consumir el endpoint POST para eliminar el comentario
                fetch(`http://localhost:8080/api/comment?id=${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    //Redireccionar a la página de inicio si la eliminación fue exitosa
                    if (data.status === '201') {
                        window.location.href = '/home';
                    } else {
                        alert('Error al eliminar el comentario. Por favor, inténtalo de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar el comentario:', error);
                    alert('Error al eliminar el comentario. Por favor, inténtalo de nuevo.');
                });
            }
        });
    }
</script>