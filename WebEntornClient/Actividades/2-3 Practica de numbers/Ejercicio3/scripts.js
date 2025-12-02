function obtenerNumero() {
    let numero = prompt("Introduce un número en el siguiente formato: (0b, 0o u 0x) + número o decimal sin prefijo (positivo).");
    numero = numero.trim();

    const binario = /^0b[01]+$/i;
    const octal = /^0o[0-7]+$/i;
    const hexadecimal = /^0x[\da-f]+$/i;
    const decimal = /^\d+$/;

    while (!binario.test(numero) && !octal.test(numero) && !hexadecimal.test(numero) && !decimal.test(numero)) {
        numero = prompt("Número inválido. Introduce un número en el formato: 0b..., 0o..., 0x... o decimal positivo sin prefijo.");
        numero = numero.trim();
    }

    return numero;
}


function conversionNumero(numero) {
    let base = 0;
    let numeroSinPrefijo = numero;

    if (numero.startsWith("0b")) {
        base = 2;
        numeroSinPrefijo = numero.slice(2);
    } else if (numero.startsWith("0o")) {
        base = 8;
        numeroSinPrefijo = numero.slice(2);
    } else if (numero.startsWith("0x")) {
        base = 16;
        numeroSinPrefijo = numero.slice(2);
    } else {
        base = 10;
    }

    let numeroConvertido = parseInt(numeroSinPrefijo, base);

    if (base == 8) {
        alert(`El número ${numero} en octal corresponde a\n\n--> ${numeroConvertido} en decimal\n\n--> ${numeroConvertido.toString(2)} en binario\n\n --> ${numeroConvertido.toString(16)} en hexadecimal`);
    } else if (base == 2) {
        alert(`El número ${numero} en binario corresponde a\n\n--> ${numeroConvertido} en decimal\n\n--> ${numeroConvertido.toString(8)} en octal\n\n --> ${numeroConvertido.toString(16)} en hexadecimal`);
    } else if (base == 16) {
        alert(`El número ${numero} en hexadecimal corresponde a\n\n--> ${numeroConvertido} en decimal\n\n--> ${numeroConvertido.toString(2)} en binario\n\n --> ${numeroConvertido.toString(8)} en octal`);
    } else if (base == 10) {
        alert(`El número ${numero} en decimal corresponde a\n\n--> ${numeroConvertido.toString(2)} en binario\n\n--> ${numeroConvertido.toString(8)} en octal\n\n --> ${numeroConvertido.toString(16)} en hexadecimal`);
    }
}

let numero = obtenerNumero();
conversionNumero(numero);