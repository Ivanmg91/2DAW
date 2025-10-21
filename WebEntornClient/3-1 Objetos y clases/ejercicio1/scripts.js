const intervalo = {
    minimo: 0,
    maximo: 0,
}

function esNumeroValido(numero) {
    while (isNaN(numero)) {
        alert("Por favor, introduce un número válido.");
        numero = parseInt(prompt("Por favor introduce un número válido."));
    }
}

//inicio programa
intervalo.minimo = prompt("Introduce el mínimo: ");
intervalo.maximo = prompt("Introduce el máximo: ");

// console.log(intervalo);