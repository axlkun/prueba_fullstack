<h1>Profile</h1>

<div id="userDetailsContainer"></div>

<a href="/profile/update">Actualizar perfil</a>
<button id="deleteProfile">Eliminar perfil</button>

<script>
    async function getUserDetails() {
        try {
            // Obtener el id del usuario
            const sessionId = <?php echo json_encode($_SESSION['id']); ?>;

            const apiUrl = `http://localhost:8080/api/usuario?id=${sessionId}`;

            // Hacer la solicitud a la API
            const response = await fetch(apiUrl);
            const data = await response.json();

            if (response.ok) {

                const userDetailsContainer = document.getElementById('userDetailsContainer');

                const userDetailsHTML = `
                    <p>Fullname: ${data.data.fullname}</p>
                    <p>Email: ${data.data.email}</p>
                    <p>Password: ${data.data.pass}</p>
                    <p>OpenID: ${data.data.openid}</p>
                    <p>Creation Date: ${data.data.creation_date}</p>
                    <p>Update Date: ${data.data.update_date}</p>
                `;

                userDetailsContainer.innerHTML = userDetailsHTML;
            } else {
                console.error('Error al obtener los datos del usuario:', data.message);
            }
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
        }
    }

    // Llamar a la función getUserDetails al cargar la página
    window.onload = getUserDetails;

    document.getElementById('deleteProfile').addEventListener('click', function(event) {
            // Confirmar si el usuario realmente desea eliminar el comentario
            
            if (confirm('¿Estás seguro de que deseas eliminar este comentario?')) {

                const sessionId = <?php echo json_encode($_SESSION['id']); ?>;

                fetch(`http://localhost:8080/api/usuario?id=${sessionId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    //Redireccionar a la página de inicio si la eliminación fue exitosa
                    if (data.status === '201') {
                        window.location.href = '/';
                    } else {
                        alert('Error al eliminar el usuario. Por favor, inténtalo de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar el usuario:', error);
                    alert('Error al eliminar el usuario. Por favor, inténtalo de nuevo.');
                });
            }
        });
</script>
