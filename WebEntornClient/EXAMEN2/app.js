/* VARIABLES */
const listaProductos = document.getElementById('lista-productos');
const carritoContenedor = document.getElementById('carrito-items');
const divCargando = document.getElementById('loading');

let articulosCarrito = JSON.parse(localStorage.getItem('carrito')) || []; // Localstorage
const productosBD = [];

const listaTuCompra = document.getElementById('carrito-items');
const totalPrecio = document.getElementById('precio-total');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');

const filtroCategoria = document.getElementById('filtro-categoria');

/* FUNCIONES */

// Función para obtener los productos del JSON
async function obtenerProductos() {
    try {

        const respuesta = await fetch('./productos.json');
        const productos = await respuesta.json();

        console.log("Los datos obtenidos son los siguientes:")
        console.log(productos);

        productos.forEach(producto => {
            productosBD.push(producto);
        });

        divCargando.style.display = 'none';

    } catch (error) {
        console.log(`Error al obtener los productos: ${error}`);
    }

}

function limpiarHTML(listaProductos) {
    while(listaProductos.firstChild) {
        listaProductos.removeChild(listaProductos.firstChild);
    }

    console.log("Se han limpiado los productos con limpiarHTML")
}

// Función para pintar las cards de los productos
function pintarCards(datos) {

    limpiarHTML(listaProductos);

    datos.forEach(producto => {
        const { id, nombre, precio, categoria, stock } = producto;

        let agotado;
        if (stock === 0) {
            agotado = true;
        } else {
            agotado = false;
        }

        const div = document.createElement('div');
        div.classList.add('producto-card');
        if (agotado) {
            div.classList.add('agotado');
        }

        div.innerHTML = `
            <h3>${nombre}</h3>
            <p>${precio}€</p>
            <p class="stock-cantidad">Stock: ${stock}</p>

            <button class="btn-add" data-id="${id}" ${agotado ? 'disabled' : ''}>
                ${agotado ? 'Agotado' : 'Añadir al carrito'}
            </button>
        `;

        listaProductos.appendChild(div);
    });
}

let total = 0;
function actualizarCarrito(producto) {
    const { id, nombre, precio } = producto;
    
    // Buscamos si ya existe el elemento en la lista (usando la clase item-carrito)
    const elementos = listaTuCompra.querySelectorAll('.item-carrito');
    let encontrado = false;

    elementos.forEach(elemento => {
        if (elemento.getAttribute('data-id') == id) {
            // Si existe, aumentamos el contador dentro del span de cantidad
            const cantidadSpan = elemento.querySelector('.cantidad');
            let cantidadActual = parseInt(cantidadSpan.textContent);
            cantidadSpan.textContent = cantidadActual + 1;
            encontrado = true;
        }
    });

    if (!encontrado) {
        const li = document.createElement('li');
        li.classList.add('item-carrito');
        li.setAttribute('data-id', id);

        li.innerHTML = `
            <span>${nombre}</span>
            <span class="cantidad">1</span>
            <button class="btn-remove" data-id="${id}">X</button>
        `;

        listaTuCompra.appendChild(li);
    }

    // Actualizamos el precio total sumando este producto
    total += parseFloat(precio);
    totalPrecio.textContent = total;
}

// Función para vaciar el carrito
function vaciarCarrito() {
    listaTuCompra.innerHTML = '';

    articulosCarrito.length = 0;

    total = 0;
    totalPrecio.innerHTML = total;

    sincronizarStorage();
}

function gestionarClickProductos(e) {
    if (e.target.classList.contains('btn-add')) {
        const id = e.target.getAttribute('data-id');

        productosBD.forEach(producto => {
            if (producto.id == id) {
                
                if (producto.stock > 0) {

                    articulosCarrito.push(producto);
                    actualizarCarrito(producto);
                    sincronizarStorage();

                    producto.stock--; 

                    // buscar el padre, la card
                    const card = e.target.parentElement;
                    const parrafoStock = card.querySelector('.stock-cantidad');
                    parrafoStock.textContent = `Stock: ${producto.stock}`;

                    // Se ha agotado ahora?'
                    if (producto.stock === 0) {
                        e.target.classList.add('agotado');
                        e.target.textContent = 'Agotado';
                        e.target.disabled = true;
                    }
                }
            }
        });
    }
}

function filtrarPorCategoria(categoriaSeleccionada) {
    let productosFiltrados;

    if (categoriaSeleccionada === 'todos') {
        productosFiltrados = productosBD;
    } else if (categoriaSeleccionada === 'Moviles') {
        productosFiltrados = productosBD.filter(p => p.categoria === 'Moviles');
    } else if (categoriaSeleccionada === 'Laptops') {
        productosFiltrados = productosBD.filter(p => p.categoria === 'Laptops');
    } else if (categoriaSeleccionada === 'Accesorios') {
        productosFiltrados = productosBD.filter(p => p.categoria === 'Accesorios');
    }

    // Pintamos los productos filtrados
    pintarCards(productosFiltrados);
}

function sincronizarStorage() {
    localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
}

function cargarCarritoAlInicio() {
    if (articulosCarrito.length > 0) {
        articulosCarrito.forEach(producto => {
            actualizarCarrito(producto);
        });
    }
}

function eliminarProducto(e) {
    if (e.target.classList.contains('btn-remove')) {
        const id = e.target.getAttribute('data-id');

        // Filtra y guarda todos los q no tengan ese id
        articulosCarrito = articulosCarrito.filter(producto => producto.id != id);

        // Limpiar
        listaTuCompra.innerHTML = '';
        total = 0;
        totalPrecio.innerHTML = 0;

        cargarCarritoAlInicio();
        sincronizarStorage();
    }
}

/* LISTENERS */

listaProductos.addEventListener('click', gestionarClickProductos);
vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
filtroCategoria.addEventListener('change', e => {
    const categoria = e.target.value;
    filtrarPorCategoria(categoria);
});

listaTuCompra.addEventListener('click', eliminarProducto);

/* EJECUCIÓN */
await obtenerProductos();
pintarCards(productosBD);
cargarCarritoAlInicio(); // Esto carga lo q hay en el localstorage

console.log(productosBD[0].id)
