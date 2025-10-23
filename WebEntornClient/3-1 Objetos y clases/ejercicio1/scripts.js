const intervalo = {
    minimo: 0,
    maximo: 0,

    get numerosComprendidos() {
        let comprendidos = [];
        for (let i = this.minimo; i <= this.maximo; i++) {
            comprendidos.push(i);
        }
        return comprendidos;
    },

    set maxMin(arrayRandoms) {
        arrayRandoms.sort((a, b) => a - b);
        this.minimo = arrayRandoms[0];
        this.maximo = arrayRandoms[4];
    }
}


function esMinimoValido() {
    let min = prompt("Introduce el mínimo: ");
    while (isNaN(min) || min === '') {
        min = prompt("Por favor introduce un número válido para el mínimo.");
    }
    return parseInt(min);
}

function esMaximoValido(min) {
    let max = prompt(`Introduce el máximo: `);
    while (isNaN(max) || max <= min || max === '') {
        max = prompt(`Por favor introduce un número válido para el máximo (mayor que ${min}).`);
    }
    return parseInt(max);
}

//inicio programa
intervalo.minimo = esMinimoValido();
intervalo.maximo = esMaximoValido(intervalo.minimo);

console.log(`El array según su intervalo es: ${intervalo.numerosComprendidos}\nEl valor mínimo del array es: ${intervalo.minimo}\nEl valor máximo del array es: ${intervalo.maximo}`);

let arrayRandoms = [];
for (let i = 0; i <= 5; i++) {
    arrayRandoms.push(Math.floor(Math.random() * 100) + 1)
}

intervalo.maxMin = arrayRandoms;

console.log(`El array según con número aleatorios es: ${intervalo.numerosComprendidos}\nEl valor mínimo del nuevo array es: ${intervalo.minimo}\nEl valor máximo del nuevo array es: ${intervalo.maximo}`);
