/* VARIABLES */
const listaProductos = document.getElementById('lista-productos');
const carritoContenedor = document.getElementById('carrito-items');
const divCargando = document.getElementById('loading');

const articulosCarrito = JSON.parse(localStorage.getItem('carrito')) || []; // Localstorage
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

        const div = document.createElement('div');
        div.classList.add('producto-card');


        div.innerHTML = `
            <h3>${nombre}</h3>
            <p>${precio}€</p>
            <p>Stock: ${stock}</p>

            <button class="btn-add">Añadir al carrito</button>
        `;

        listaProductos.appendChild(div);

        
    });

    // CHAPUZA
    const addBotones = document.querySelectorAll('.btn-add');
    let contador = 1;
    addBotones.forEach(boton => {
        boton.setAttribute('data-id', contador);
        contador++;
    });

}

let total = 0;
function actualizarCarrito(producto) {
    const { id, nombre, precio } = producto;
    const filas = listaTuCompra.querySelectorAll('tr');

    let encontrado = false;

    filas.forEach(fila => {
        if (fila.dataset.id == id) {
            const cantidadCelda = fila.children[1];
            cantidadCelda.textContent = parseInt(cantidadCelda.textContent) + 1;
            encontrado = true;
        }
    });

    if (!encontrado) {
        const row = document.createElement('tr');
        row.dataset.id = id;

        row.innerHTML = `
            <td>${nombre}</td>
            <td>1</td>
        `;

        listaTuCompra.appendChild(row);
    }


    total += parseInt(precio);
    totalPrecio.innerHTML = total;
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
        console.log(`se ha pulsado boton de añadir. id = ${id}`);

        productosBD.forEach(producto => {
            if (producto.id == id) {
                articulosCarrito.push(producto);
                actualizarCarrito(producto);
                sincronizarStorage(); // para el localstorage
                console.log(`añadido al carrito: ${producto.nombre}`)
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



/* LISTENERS */

listaProductos.addEventListener('click', gestionarClickProductos);
vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
filtroCategoria.addEventListener('change', e => {
    const categoria = e.target.value;
    filtrarPorCategoria(categoria);
});


/* EJECUCIÓN */
await obtenerProductos();
pintarCards(productosBD);
cargarCarritoAlInicio(); // Esto carga lo q hay en el localstorage

console.log(productosBD[0].id)
