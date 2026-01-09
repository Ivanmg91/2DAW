const listaCursos = document.querySelector('#lista-cursos');
listaCursos.addEventListener('click', enviarAlCarrito);

function enviarAlCarrito(e) {
    e.preventDefault();

    const boton = e.target;
    const card = boton.closest('.card');

    const curso = {
        // Id del curso
        id: boton.dataset.id,
        // id: card.querySelector('a').getAttribute('data-id'),

        imagen: card.querySelector('.imagen-curso').src,
        nombre: card.querySelector('h4').textContent,
        precio: card.querySelector('.precio span').textContent,
        cantidad: 1
    };

    const existe = existeEnCarrito(curso.id);
    if (existe) {
        // Actualizar cantidad
        actualizarCantidad(curso.id);
    } else {
        // Añadirlo nuevo (push)
        carrito.push(curso);
    }

    // Refrescar HTML
    // carritoHTML();          ESTO FALTA

    console.log(curso);
    console.log(carrito);
}

// Función para saber si existe en el carrito
let carrito = [];

function existeEnCarrito(idRecibido) {
    for (let i = 0; i < carrito.length; i++) {
        if (carrito[i].id === idRecibido) {
            return true;
        }
    }
    return false;
}

function actualizarCantidad(idCurso) {
    for (let i = 0; i < carrito.length; i++) {
        if (idCurso === carrito[i].id) {
            carrito[i].cantidad += 1;
        }
    }
}