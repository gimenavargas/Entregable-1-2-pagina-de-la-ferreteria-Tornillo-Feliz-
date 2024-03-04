<?php
// Respuestas del chatbot
$responses = array(
    "Hola" => "¡Hola! ¿En qué puedo ayudarte?",
    "¿Cómo estás?" => "Estoy bien, gracias por preguntar.",
    "Muestrame los productos "
    "Adiós" => "¡Hasta luego! Si tienes más preguntas, estaré aquí.",

    // Puedes agregar más respuestas según tus necesidades
);

// Obtener la entrada del usuario desde la solicitud GET
$userInput = $_GET["userInput"];

// Buscar la respuesta del chatbot
$response = isset($responses[$userInput]) ? $responses[$userInput] : "Lo siento, no entiendo esa pregunta.";

// Devolver la respuesta al cliente
echo $response;
?>
<?php
// Función para obtener una selección de productos de la base de datos
function obtenerProductos() {
    // Configuración de la conexión a la base de datos (modifica según tus credenciales)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "algoritmia";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener una selección de productos
    $sql = "SELECT nombre, descripcion, precio, imagen FROM productos LIMIT 5"; // Obtener los primeros 5 productos
    $result = $conn->query($sql);

    // Construir la respuesta del chatbot
    $botResponse = "Aquí tienes algunos productos:\n";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $botResponse .= "Nombre: " . $row["nombre"] . "\n";
            $botResponse .= "Descripción: " . $row["descripcion"] . "\n";
            $botResponse .= "Precio: $" . $row["precio"] . "\n";
            $botResponse .= "Imagen: " . $row["imagen"] . "\n\n";
        }
    } else {
        $botResponse .= "Lo siento, no hay productos disponibles en este momento.";
    }

    // Cerrar conexión
    $conn->close();

    return $botResponse;
}

// Llamar a la función para obtener los productos y mostrarlos en el chatbot
echo obtenerProductos();
?>
