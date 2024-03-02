<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
$username = "root"; // Tu nombre de usuario de la base de datos
$password = ""; // Tu contraseña de la base de datos
$dbname = "algoritmia"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$numerocelular = $_POST['numerocelular'];
$contraseña = $_POST['contraseña'];
$repetircontraseña = $_POST['repetircontraseña'];

// Insertar datos en la base de datos
$sql = "INSERT INTO registros (nombres, apellidos, correo, numerocelular, contraseña, repetircontraseña)
        VALUES ('$nombres', '$apellidos', '$correo', '$numerocelular', '$contraseña', '$repetircontraseña')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
