// api: https://pixabay.com/api/docs/

// VARIABLES HTML
const formulario = document.getElementById('formulario');
const terminoBusqueda = document.getElementById('termino');
const resultado = document.getElementById('resultado');
const paginador = document.getElementById('paginacion');

// VARIABLES JS
let paginaActual = 1;
let totalPaginas;
let i; // Para guardar el generador
const resgistrosPagina = 3;


// FUNCIONES

// FUNCIÓN QUE USA EL ENDPOINT DE LA API PARA BUSCAR LAS IMÁGENES DESEADAS
async function buscarImagenes(terminoBusqueda) {
    
    // Respuesta del endpoint (resultados)
    const key = '54440312-ebeed9650e68e692992ec9b83';
    const respuesta = await fetch(`https://pixabay.com/api/?key=${key}&q=${terminoBusqueda}&per_page=${resgistrosPagina}&page=${paginaActual}`);
    const datosImagenes = await respuesta.json(); // await para qno devuelva una promise (pending)

    // Encargado de contar las páginas que necesitamos. la función ceil redondea hacia arriba
    totalPaginas = Math.ceil(datosImagenes.totalHits / resgistrosPagina);
    
    // Llamamos a mostrar imagenes y le pasamos los datos (cada hit son los datos de la imagen)
    mostrarImagenes(datosImagenes.hits);

    mostrarPaginador();
}

// Función para q se muestren las imagenes en la página
function mostrarImagenes(datosImagenes) {

    // Limpiar los resultados anteriores
    resultado.innerHTML = '';

    datosImagenes.forEach(imagen => {
        
        // Destructuring de los datos
        const { previewURL, likes, views, largeImageURL } = imagen;

        // Creación de los divs q pide el enunciado
        const divExterior = document.createElement('div');
        divExterior.classList.add('w-1/2', 'md:w-1/3', 'lg:w-1/4', 'mb-4', 'p-3');

        divExterior.innerHTML = `
            <div class="bg-white">
                <img class="w-full" src="${previewURL}" alt="imagen">
                
                <div class="p-4">
                    <p class="font-bold"> ${likes} <span class="font-light"> Me Gusta </span> </p>
                    <p class="font-bold"> ${views} <span class="font-light"> Veces vista </span> </p>
                    
                    <a href="${largeImageURL}" target="_blank" rel="noopener noreferrer" class="block w-full bg-blue-800 hover:bg-blue-500 text-white uppercase font-bold text-center rounded mt-5 p-1">
                        Ver Imagen
                    </a>
                </div>
            </div>
        `;
        
        resultado.appendChild(divExterior);
    });
}

// Función generadora para la paginación
function *generarPaginador(total) {
    for (let i = 1; i <= total; i++) {
        yield i; // Lo q hace yiel es devolver el valor y se queda pausado donde está
    }
}

function mostrarPaginador() {
    // Limpiar paginador
    paginador.innerHTML= '';

    // Inicializamos el generador
    i = generarPaginador(totalPaginas);

    while (true) {
        
        const { value, done } = i.next(); // El generador devuleve un objeto con 2 propiedades. Value: dato real (1, 2, 3...), done(el estado, es com un semáforo)
        // Si no hay más paginas salimos
        if (done) {
            return; // Si el generador es done (ha terminado) salimos del bucle while
        }

        // Crear botones
        const boton = document.createElement('a');
        boton.href = '#';
        boton.textContent = value;

        boton.classList.add('siguiente', 'bg-yellow-400', 'px-4', 'py-1', 'mr-2', 'font-bold', 'mb-4', 'rounded');

        // Al puslar boton de página
        boton.onclick = () => {
            paginaActual = value; 
            buscarImagenes(terminoBusqueda.value); // Llamamos a buscar de nuevo
        }

        paginador.appendChild(boton);
    }

}


// EJECUCIÓN
formulario.addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que el formulario se recargue

    // Establecemos la página actual
    paginaActual = 1;

    // Buscamos imagenes siempre cuando se haya escrito término. Si no hay término hace una búsqueda por defecto
    if (terminoBusqueda !== '') {
        buscarImagenes(terminoBusqueda.value);
    }
});
