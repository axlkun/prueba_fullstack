<h1>Profile</h1>

<div id="userDetailsContainer"></div>

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
</script>
