function obtenerNumero() {
    let numero = parseFloat(prompt("Introduce un número positivo o negativo: "));

    while (isNaN(numero) || (numero >= -1 && numero <= 1)) {
        alert("Por favor, introduce un número fuera del rango de -1 a 1.");
        numero = parseFloat(prompt("Introduce un número positivo o negativo (fuera del rango -1 a 1):"));
    }

    return numero;
}

let numero = obtenerNumero();
let resultado = numero;
let resultadoAnterior;
let operaciones = 0;

while (resultado !== Infinity) {
    resultado *= numero;
    resultadoAnterior = resultado / numero;
    operaciones++;

    console.log(`Operación ${operaciones}: ${numero} x ${resultadoAnterior} = ${resultado}`);
}

console.log(`Se necesitaron ${operaciones} operaciones para llegar a infinito.`);
