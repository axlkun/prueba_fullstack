<main class="contenedor seccion centrar-comentarios">
    <h1>Comentarios</h1>

    <a href="/comment/create" class="btn">Nuevo comentario</a>

    <div class="home" id="commentsContainer"></div>
</main>

<script>
    // Función para obtener y mostrar los comentarios
    async function getComments() {
        const API_URL = 'http://localhost:8080/api/comment/all';
        const commentsContainer = document.getElementById('commentsContainer');

        try {
            const response = await fetch(API_URL);
            const data = await response.json();

            if (response.ok) {
                renderComments(data.data, commentsContainer);
            } else {
                console.error('Error al obtener los comentarios:', data.message);
            }
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
        }
    }

    // Función para renderizar los comentarios en el DOM
    function renderComments(comments, container) {
        const commentsHTML = comments.map(comment => {
            return `
                <div class="anuncio">
                    <div class="contenido-anuncio">
                        <p>${comment.fullname}</p>
                        <p>${comment.coment_text}</p>
                        <p>${comment.likes}</p>
                        <button onclick="verMas(${comment.id})">Ver más</button>
                    </div>
                </div>
            `;
        }).join('');

        container.innerHTML = commentsHTML;
    }

    // Función para redirigir a la página de detalle del comentario
    function verMas(commentId) {
        // console.log(commentId);
        window.location.href = `http://localhost:8080/comment/detail?id=${commentId}`;
    }

    // Cargar los comentarios al cargar la página
    window.onload = getComments;
</script>
