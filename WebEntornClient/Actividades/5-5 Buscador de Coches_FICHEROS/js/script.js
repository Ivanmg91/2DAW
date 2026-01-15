const marca = document.querySelector('#marca');
const anyo = document.querySelector('#anyo');
const minimo = document.querySelector('#minimo');
const maximo = document.querySelector('#maximo');
const puertas = document.querySelector('#puertas');
const transmision = document.querySelector('#transmision');
const color = document.querySelector('#color');

const contenedorResultados = document.querySelector('#resultado');

const datos = {
    marca: '',
    anyo: '',
    minimo: '',
    maximo: '',
    puertas: '',
    transmision: '',
    color: '',
};

// Function to add years to the select
function rellenarAnyos() {
    const anyoActual = new Date().getFullYear();
    const min = anyoActual - 10;

    for (let i = anyoActual; i >= min; i--) {
        const opcionAnyo = document.createElement('option');
        opcionAnyo.value = i;
        opcionAnyo.textContent = i;

        anyo.appendChild(opcionAnyo)
    }
}

function mostrarResultados(datos) {
    const resultado = coches.filter(coche => {
        if (datos.marca && coche.marca !== datos.marca) {
            return false;
        }
        if (datos.anyo && Number(coche.anyo) !== Number(datos.anyo)) {
            return false;
        }
        if (datos.minimo && Number(coche.precio) < Number(datos.minimo)) { // Car prize becaus is defined in db.js
            return false;
        }
        if (datos.maximo && Number(coche.precio) > Number(datos.maximo)) {
            return false;
        }
        if (datos.puertas && Number(coche.puertas) !== Number(datos.puertas)) {
            return false;
        }
        if (datos.transmision && coche.transmision !== datos.transmision) {
            return false;
        }
        if (datos.color && coche.color !== datos.color) {
            return false;
        }  

        return true;
    });


    console.log(resultado);
}


marca.addEventListener('change', e => {
    datos.marca = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});

anyo.addEventListener('change', e => {
    datos.anyo = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});

minimo.addEventListener('change', e => {
    datos.minimo = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});

maximo.addEventListener('change', e => {
    datos.maximo = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});

puertas.addEventListener('change', e => {
    datos.puertas = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});

transmision.addEventListener('change', e => {
    datos.transmision = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});

color.addEventListener('change', e => {
    datos.color = e.target.value;
    console.log(datos);
    mostrarResultados(datos);
});



// Wait to HTML
document.addEventListener('DOMContentLoaded', () => {
    rellenarAnyos();
});