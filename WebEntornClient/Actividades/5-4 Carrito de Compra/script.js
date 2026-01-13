const listaCursos = document.querySelector('#lista-cursos');
listaCursos.addEventListener('click', enviarAlCarrito);

function enviarAlCarrito(e) {
    e.preventDefault();

    const botonAgregar = e.target;
    const cardCurso = botonAgregar.closest('.card');

    const curso = {
        // Id del curso
        id: botonAgregar.dataset.id,
        // id: card.querySelector('a').getAttribute('data-id'),

        imagen: cardCurso.querySelector('.imagen-curso').src,
        nombre: cardCurso.querySelector('h4').textContent,
        precio: cardCurso.querySelector('.precio span').textContent,
        cantidad: 1
    };

    const existe = existeEnCarrito(curso.id);
    if (existe) {
        // Actualizar cantidad
        actualizarCantidad(curso.id);
    } else {
        // Añadirlo nuevo (push)
        articulosCarrito.push(curso);
    }

    // Refrescar HTML
    carritoHTML();

    console.log(curso);
    console.log(articulosCarrito);
}

// Función para saber si existe en el carrito
let articulosCarrito = [];

function existeEnCarrito(idRecibido) {
    for (let i = 0; i < articulosCarrito.length; i++) {
        if (articulosCarrito[i].id === idRecibido) {
            return true;
        }
    }
    return false;
}

function actualizarCantidad(idCurso) {
    for (let i = 0; i < articulosCarrito.length; i++) {
        if (idCurso === articulosCarrito[i].id) {
            articulosCarrito[i].cantidad += 1;
        }
    }
}

const contenedorCarrito = document.querySelector('#lista-carrito tbody');
contenedorCarrito.addEventListener('click', quitarCurso);

// Función para eliminar un curso del carro o restar cantidad
function quitarCurso(e) {
    if (e.target.classList.contains('borrar-curso')) {
        const cursoId = e.target.dataset.id;
        let nuevoCarrito = [];

        articulosCarrito.forEach(curso => {
            if (curso.id === cursoId) {
                if (curso.cantidad > 1) { // Si un curso tiene más de 1
                    curso.cantidad--;
                    nuevoCarrito.push(curso);
                } else {
                }
            } else {
                nuevoCarrito.push(curso);
            }
        });

        articulosCarrito = nuevoCarrito;
        carritoHTML();
    }
}



function carritoHTML() {
    while(contenedorCarrito.firstChild) {
        contenedorCarrito.removeChild(contenedorCarrito.firstChild);
    }

    articulosCarrito.forEach(curso => {

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <img src="${curso.imagen}" width="100">
            </td>
            <td>${curso.nombre}</td>
            <td>${curso.precio}</td>
            <td>${curso.cantidad}</td>
            <td>
                <a href="#" class="borrar-curso" data-id="${curso.id}">X</a>
            </td>
        `;

        contenedorCarrito.appendChild(row);
    });
}





// Vaciar todos los cursos del carrito
const vaciarCarrito = document.getElementById('vaciar-carrito');
vaciarCarrito.addEventListener('click', vaciar);

function vaciar() {
    while(contenedorCarrito.firstChild) {
        contenedorCarrito.removeChild(contenedorCarrito.firstChild);
    }

    // Eliminar el valor de cantidad del curso en el carro
    articulosCarrito.forEach(curso => {
        curso.cantidad = 0;
    });
}

