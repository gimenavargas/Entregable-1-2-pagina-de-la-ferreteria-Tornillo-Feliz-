document.addEventListener('DOMContentLoaded', () => {
    const formularioCompra = document.getElementById('formulario-compra');
    formularioCompra.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita que el formulario se envíe automáticamente

        // Obtener los valores del formulario
        const medioPago = document.getElementById('medio-pago').value;
        const contacto = document.getElementById('contacto').value;

        // Aquí puedes agregar la lógica para procesar la compra
        realizarCompra(medioPago, contacto);
    });
});

function realizarCompra(medioPago, contacto) {
    // Aquí puedes agregar la lógica para procesar la compra
    alert(`Pedido realizado con éxito. Nos comunicaremos en seguida con usted , en caso no reciba respuesta de su pedido comunicarse al numero :975643245 o al correo "Lopez123@gmail.com"`);

    // Después de procesar la compra, podrías redirigir al usuario a otra página, mostrar un mensaje de confirmación, etc.
    // Por ejemplo, redirigir al usuario a una página de confirmación:
    // window.location.href = 'pagina-de-confirmacion.html';
}
