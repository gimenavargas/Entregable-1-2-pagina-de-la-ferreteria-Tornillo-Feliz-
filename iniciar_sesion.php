<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "algoritmia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar el formulario de inicio de sesión si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT id, nombres, apellidos FROM registros WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario y la contraseña coinciden, iniciar sesión
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION["usuario_id"] = $row["id"];
        $_SESSION["usuario_nombres"] = $row["nombres"];
        $_SESSION["usuario_apellidos"] = $row["apellidos"];
        
        // Redirigir a la página de inicio después del inicio de sesión exitoso
        header("Location: productos.html");
        exit();
    } else {
        // El usuario y la contraseña no coinciden, mostrar un mensaje de error
        $mensaje_error = "El correo electrónico o la contraseña son incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="iniciar_sesion.css">
    
</head>
<body>
    <header>
        <h1>Iniciar Sesión</h1>
    </header>
    
    <div class="container">
        <div class="formulario-login">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div>
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div>
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required>
                </div>
                <?php if(isset($mensaje_error)) { ?>
                <p class="error"><?php echo $mensaje_error; ?></p>
                <?php } ?>
                <button type="submit">Iniciar Sesión</button>
                <a href="registro.html" class="btn btn-primary">Registrarse</a>
                
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Tienda Online ("EL TORNILLO FELIZ")</p>
    </footer>
</body>
</html>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>
