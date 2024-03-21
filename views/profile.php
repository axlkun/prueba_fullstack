<main class="contenedor centrar-form-comment">

    <div>
        <h1>Profile</h1>

        <div id="userDetailsContainer" class="comment-details"></div>

        <div class="btn-container" style="text-align: center;">
            <a href="/profile/update" class="btn">Actualizar perfil</a>
            <button id="deleteProfile" class="btn-eliminar">Eliminar perfil</button>
        </div>

    </div>
</main>


<script>
    async function getUserDetails() {
        try {
            const sessionId = <?php echo json_encode($_SESSION['id']); ?>;
            const apiUrl = `http://localhost:8080/api/usuario?id=${sessionId}`;
            const response = await fetch(apiUrl);
            const data = await response.json();

            if (response.ok) {
                const userDetailsContainer = document.getElementById('userDetailsContainer');

                const userDetailsHTML = `
                    <p><strong>Nombre:</strong> ${data.data.fullname}</p>
                    <p><strong>Email:</strong> ${data.data.email}</p>
                    <p><strong>Password:</strong> ${data.data.pass}</p>
                    <p><strong>Openid:</strong> ${data.data.openid}</p>
                    <p><strong>Fecha de creacion:</strong> ${data.data.creation_date}</p>
                    <p><strong>Fecha de actualizacion:</strong> ${data.data.update_date}</p>
                `;

                userDetailsContainer.innerHTML = userDetailsHTML;
            } else {
                alert(data.message);
            }
        } catch (error) {
            alert('Error al realizar la solicitud:', error);
        }
    }

    async function deleteProfile() {
        try {
            if (confirm('¿Estás seguro de que deseas eliminar este perfil?')) {
                const sessionId = <?php echo json_encode($_SESSION['id']); ?>;
                const apiUrl = `http://localhost:8080/api/usuario?id=${sessionId}`;

                const response = await fetch(apiUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });

                const data = await response.json();

                if (data.status === '201') {
                    alert(data.message);
                    window.location.href = '/';
                } else {
                    alert(data.message);
                }
            }
        } catch (error) {
            console.error('Error al eliminar el perfil:', error);
            alert('Error al eliminar el perfil. Por favor, inténtalo de nuevo.');
        }
    }

    window.onload = getUserDetails;

    document.getElementById('deleteProfile').addEventListener('click', deleteProfile);
</script>