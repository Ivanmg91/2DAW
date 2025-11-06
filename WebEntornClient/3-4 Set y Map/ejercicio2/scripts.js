function pedirMinimo(mensaje) {
    let respuesta;

    while (true) {
        respuesta = prompt(mensaje);
        
        if (respuesta === null) {
            alert("NO se va a hacer nada");
            return null;
        }
        
        respuesta = parseFloat(respuesta);
        
        if (isNaN(respuesta)) {
            alert("Por favor, ingresa un número válido.");
        } else {
            return respuesta;
        }
    }
}


function pedirMaximo(mensaje, minimo) {
    let respuesta;

    while (true) {
        respuesta = prompt(mensaje);
        
        if (respuesta === null) {
            alert("NO se va a hacer nada");
            return null;
        }
        
        respuesta = parseFloat(respuesta);
        
        if (isNaN(respuesta)) {
            alert("Por favor, ingresa un número válido.");
        } else if (respuesta < minimo) {
            alert("El máximo debe ser mayor o igual a " + minimo);
        } else {
            return respuesta;
        }
    }
}

//INICIO
const rango_min = pedirMinimo("Introduce el rango minimo.");
const rango_max = pedirMaximo("Introduce el rango máximo.");
const repeticiones = pedirMinimo("Introduce el número de repeticiones.")

let map = new Map();

for (let i = rango_min; i <= rango_max; i++) {
    map.set(i, 0);
}

for (let i = 0; i < repeticiones; i++) {
    let random = Math.floor(Math.random() * (rango_max - rango_min + 1)) + rango_min;
    map.set(random, map.get(random) + 1);
}

for (let i = rango_min; i <= rango_max; i++) {
    console.log(`Número ${i}: ${map.get(i)}`)
}
