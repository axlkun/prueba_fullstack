<div id="commentDetails"></div>

<script>
    // obtener id
    const id = <?php echo json_encode(isset($_GET['id']) ? $_GET['id'] : null); ?>;

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
    }
</script>