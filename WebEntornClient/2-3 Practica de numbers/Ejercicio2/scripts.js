function obtenerNumeroComensales() {
    let numeroComensales = parseFloat(prompt("¿Con cuántos comensales vamos a contar?"));

    while (isNaN(numeroComensales) || numeroComensales <= 0) {
        alert("Por favor, introduce un número de comensales");
        numeroComensales = parseFloat(prompt("¿Con cuántos comensales vamos a contar?"));
    }

    return numeroComensales;
}

function obtenerNumeroComensalesAbuelos(comensalesTotales) {
    let numeroComensalesAbuelos = parseFloat(prompt("¿Cuántos comensales tenemos mayores de 65 años?"));

    while (isNaN(numeroComensalesAbuelos) || numeroComensalesAbuelos > comensalesTotales) {
        alert("Por favor, introduce un número de comensales mayores de 65 años válido.");
        numeroComensalesAbuelos = parseFloat(prompt("¿Cuántos comensales tenemos mayores de 65 años?"));
    }

    return numeroComensalesAbuelos;
}

function obtenerNumeroComensalesNinios(comensalesTotales, comensalesAbuelos) {
    let numeroComensalesNinios = parseFloat(prompt("¿Cuántos comensales tenemos menores de 10 años con menú infantil?"));

    while (isNaN(numeroComensalesNinios) || numeroComensalesNinios > (comensalesTotales - comensalesAbuelos)) {
        alert("Por favor, introduce un número de comensales menores de 10 años válido.");
        numeroComensalesNinios = parseFloat(prompt("¿Cuántos comensales tenemos menores de 10 años con menú infantil?"));
    }

    return numeroComensalesNinios;
}

let numeroComensales = obtenerNumeroComensales();
let numeroComensalesAbuelos = obtenerNumeroComensalesAbuelos(numeroComensales);
let numeroComensalesNinios = obtenerNumeroComensalesNinios(numeroComensales, numeroComensalesAbuelos);
