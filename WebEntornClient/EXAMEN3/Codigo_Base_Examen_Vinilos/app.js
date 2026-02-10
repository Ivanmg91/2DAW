/* VARIABLES GLOBALES */
let articulosCarrito = JSON.parse(localStorage.getItem('carrito')) || []; // Localstorage
const vinilosDB = [];
let contador = 0;

/* VARIABLES HTML */
const divCargando = document.getElementById('loading');
const listaVinilos = document.getElementById('lista-vinilos');
const listaTuCompra = document.getElementById('carrito-items');
const totalPrecio = document.getElementById('precio-total');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
const filtroCategoria = document.getElementById('filtro-categoria');
const contadorProductos = document.getElementById('contador-productos')

/* FUNCIONES */
// Función para obtener los vinilos del JSON
async function obtenerVinilos() {
    try {

        // Obtener los vinilos del JSON
        const respuesta = await fetch('./vinilos.json');
        const vinilos = await respuesta.json();

        console.log("Los datos obtenidos son los siguientes:")
        console.log(vinilos);

        // Foreach para añadir los vinilos como objetos unicos y no como array
        vinilos.forEach(vinilo => {
            vinilosDB.push(vinilo);
        });

        // Quitar lo de cargando cuando obtenga los datos
        divCargando.style.display = 'none';


    } catch (error) {
        console.log(`Error obteniendo los vinilos: ${error}`);
    }
}

// Función para pintar los discos en el contenedero #lista-vinilos
function mostrarVinilos(datos) {
    
    limpiarHTML(listaVinilos);

    datos.forEach(vinilo => {
        const { id, nombre, artista, precio, categoria, stock } = vinilo;

        const div = document.createElement('div');
        div.classList.add('producto-card');
        div.innerHTML = `
            <h3>${artista}</h3>
            <p>${nombre}</p>
            <p>${categoria}</p>
            <p>${precio}€</p>
            <p class="stock-info">Stock: ${stock}</p>

            <button class="btn-add" data-id="${id}">Añadir al carrito</button>
        `;

        listaVinilos.appendChild(div);
    });
    
}

// Función para elimiar o reducir stock de un vinilo
function eliminarVinilo(e) {
    if (e.target.classList.contains('btn-remove')) {
        const id = e.target.getAttribute('data-id');

        const vinilo = vinilosDB.find(p => p.id == id);

        if (vinilo) {
            vinilo.stock++;
            contador--;
            contadorProductos.textContent = contador;

            const botonAdd = document.querySelector(`.btn-add[data-id="${id}"]`);
            const card = botonAdd.parentElement;

            card.querySelector('.stock-info').textContent = `Stock: ${vinilo.stock}`;
            botonAdd.disabled = false;
            botonAdd.textContent = 'Añadir al carrito';
            card.classList.remove('agotado');
        } 

        for (let i = 0; i < articulosCarrito.length; i++) {
            
            if (articulosCarrito[i].id == id) {
                articulosCarrito.splice(i, 1);
                break;
            }
        }

        listaTuCompra.innerHTML = '';
        total = 0;
        totalPrecio.innerHTML = 0;


        cargarCarritoAlInicio();
        sincronizarStorage();
    }
}

// Función para actualizar el carrtio al agregar o eliminar un vinilo
let total = 0;
function actualizarCarritoHTML(vinilo) {
    const { id, nombre, precio } = vinilo;

    const elementos = listaTuCompra.querySelectorAll('.item-carrito');
    let encontrado = false;

    elementos.forEach(elemento => {
        if (elemento.getAttribute('data-id') == id) {
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
            <span class="cantidad">1</span>R
            <button class="btn-remove" data-id="${id}">X</button>
        `;

        listaTuCompra.appendChild(li);
    }

    total += parseFloat(precio);
    totalPrecio.textContent = total;
}

// Función para guardar el carrito en el localstorage
function sincronizarStorage() {
    localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
}

// Función para limpiar el html
function limpiarHTML(listaVinilos) {
    while(listaVinilos.firstChild) {
        listaVinilos.removeChild(listaVinilos.firstChild);
    }
    console.log("Se han limpiado los productos con limpiarHTML")
}

// Función que detecta el vinilo q has añadido y lo añade
function agregarVinilo(e) {
    if (e.target.classList.contains('btn-add')) {
        const id = e.target.getAttribute('data-id');

        vinilosDB.forEach(vinilo => {
            if (vinilo.id == id) {
                
                if (vinilo.stock > 0) {

                    articulosCarrito.push(vinilo);
                    actualizarCarritoHTML(vinilo);

                    vinilo.stock--;

                    const card = e.target.parentElement;
                    const parrafoStock = card.querySelector('.stock-info');
                    parrafoStock.textContent = `Stock: ${vinilo.stock}`;

                    if (vinilo.stock === 0 ) {
                        e.target.classList.add('agotado');
                        e.target.textContent = 'Agotado';
                        e.target.disabled = true;
                    }
                }
            }
        });

        contador++;
        contadorProductos.textContent = contador;
    }
}

// Función para vaciar el carrito al pulsar el boton
function vaciarCarrito() {
    listaTuCompra.innerHTML = '';

    articulosCarrito.length = 0;

    total = 0;
    totalPrecio.innerHTML = total;

    contador = 0;
    contadorProductos.textContent = contador;
    sincronizarStorage();
}

// Función para cargar el carrito con localstorage
function cargarCarritoAlInicio() {
    if (articulosCarrito.length > 0) {
        articulosCarrito.forEach(vinilo => {
            actualizarCarritoHTML(vinilo);
        });
    }
}

// Función para usar el filtrado
function filtrarPorCategoria(categoriaSeleccionada) {
    let productosFiltrados;

    if (categoriaSeleccionada === 'todos') {
        productosFiltrados = vinilosDB;
    } else if (categoriaSeleccionada === 'Rock') {
        productosFiltrados = vinilosDB.filter(v => v.categoria === 'Rock');
    } else if (categoriaSeleccionada === 'Pop') {
        productosFiltrados = vinilosDB.filter(v => v.categoria === 'Pop');
    } else if (categoriaSeleccionada === 'Jazz') {
        productosFiltrados = vinilosDB.filter(v => v.categoria === 'Jazz');
    } else if (categoriaSeleccionada === 'Electronic') {
        productosFiltrados = vinilosDB.filter(v => v.categoria === 'Electronic');
    }

    mostrarVinilos(productosFiltrados);
}



/* LISTA VINILOS */
listaVinilos.addEventListener('click', agregarVinilo);
vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
listaTuCompra.addEventListener('click', eliminarVinilo);

filtroCategoria.addEventListener('change', e => {
    const categoria = e.target.value;
    filtrarPorCategoria(categoria);
});

/* EJECUCIÓN */
await obtenerVinilos();
mostrarVinilos(vinilosDB);
cargarCarritoAlInicio();
