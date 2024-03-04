document.addEventListener('DOMContentLoaded', () => {
    const agregarCarritoButtons = document.querySelectorAll('.agregar-carrito');
    agregarCarritoButtons.forEach(button => {
        button.addEventListener('click', agregarAlCarrito);
    });

    const vaciarCarritoButton = document.getElementById('vaciar-carrito');
    vaciarCarritoButton.addEventListener('click', vaciarCarrito);

    function agregarAlCarrito(event) {
        const producto = event.target.parentElement;
        const nombre = producto.querySelector('p:nth-of-type(2)').textContent;
        const precioTexto = producto.querySelector('p:nth-of-type(3)').textContent;
        const precio = parseFloat(precioTexto.replace('Precio: $', '')); // Extraemos el precio correctamente
        const cantidad = 1;

        agregarItemAlCarrito(nombre, precio, cantidad);
        actualizarCarrito();
    }

    function agregarItemAlCarrito(nombre, precio, cantidad) {
        const carrito = document.getElementById('lista-carrito');
        const nuevoItem = document.createElement('li');
        nuevoItem.innerHTML = `${nombre} - $${precio.toFixed(2)} x ${cantidad}`;
        carrito.appendChild(nuevoItem);
    }

    function actualizarCarrito() {
        calcularTotal();
    }

    function calcularTotal() {
        const precios = [];
        const itemsCarrito = document.querySelectorAll('#lista-carrito li');
        itemsCarrito.forEach(item => {
            const precioString = item.textContent.split('-')[1].trim().split('x')[0].trim();
            const precio = parseFloat(precioString.replace('$', ''));
            precios.push(precio);
        });

        const total = precios.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
        const totalSpan = document.getElementById('total');
        totalSpan.textContent = total.toFixed(2);
    }

    function vaciarCarrito() {
        const carrito = document.getElementById('lista-carrito');
        while (carrito.firstChild) {
            carrito.removeChild(carrito.firstChild);
        }
        actualizarCarrito();
    }
    function realizarCompra() {
        const medioPago = document.getElementById('medio-pago').value;
        const contacto = document.getElementById('contacto').value;
    
        // Obtener los datos del carrito
        const itemsCarrito = obtenerDatosCarrito();
    
        // Redireccionar a la página de compra con los parámetros
        window.location.href = `compra.html?medioPago=${medioPago}&contacto=${contacto}&productos=${JSON.stringify(itemsCarrito)}`;
    }
    
    function obtenerDatosCarrito() {
        const itemsCarrito = [];
        const itemsCarritoHTML = document.querySelectorAll('#lista-carrito li');
    
        itemsCarritoHTML.forEach(item => {
            const nombre = item.textContent.split('-')[0].trim();
            const precioString = item.textContent.split('-')[1].trim().split('x')[0].trim();
            const precio = parseFloat(precioString.replace('$', ''));
            itemsCarrito.push({ nombre, precio });
        });
    
        return itemsCarrito;
    }
    
});

