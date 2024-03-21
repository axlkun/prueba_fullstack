<h1>Comentarios</h1>

<a href="/comment/create">Nuevo comentario</a>

<div class="contenedor-anuncios" id="commentsContainer"></div>

<script>
    // Función para obtener y mostrar los comentarios
    async function getComments() {
        try {
            // Hacer la solicitud a la API para obtener los comentarios
            const response = await fetch('http://localhost:8080/api/comment/all');
            const data = await response.json();

            if (response.ok) {
                // Obtener el contenedor donde se mostrarán los comentarios
                const commentsContainer = document.getElementById('commentsContainer');

                // Construir el contenido HTML con los comentarios
                let commentsHTML = '';

                // Recorrer los comentarios y construir el HTML
                data.data.forEach(comment => {
                    commentsHTML += `
                        <div class="anuncio">
                            <div class="contenido-anuncio">
                                <p>${comment.fullname}</p>
                                <p>${comment.coment_text}</p>
                                <p>${comment.likes}</p>
                                <button onclick="verMas(${comment.id})">Ver más</button>
                            </div>
                        </div>
                    `;
                });

                // Insertar el contenido HTML en el contenedor
                commentsContainer.innerHTML = commentsHTML;
            } else {
                console.error('Error al obtener los comentarios:', data.message);
            }
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
        }
    }

    // Función para mostrar más detalles del comentario
    function verMas(commentId) {
        window.location.href = `http://localhost:8080/comment/detail?id=${commentId}`;
    }

    // Llamar a la función getComments al cargar la página
    window.onload = getComments;
</script>
