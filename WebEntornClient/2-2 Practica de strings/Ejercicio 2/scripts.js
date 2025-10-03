let textoCifrar = prompt("Escribe el texto que quieres cifrar: ");
let n;

while (isNaN(n = prompt("Escribe un número: "))) {
    alert("Tienes que introducir un número entero.");
}

let numero = Math.floor(Number(n));
let codigosOriginales = "";
let textoCifrado ="";

for (let i = 0; i < textoCifrar.length; i++) {

    let codigoOriginal = textoCifrar.charCodeAt(i);
    codigosOriginales += codigoOriginal + " ";
    
    let codigoCifrado = codigoOriginal + numero;
    let caracterCifrado = String.fromCharCode(codigoCifrado);
    
    textoCifrado += caracterCifrado;
}
alert(`"${textoCifrar}" se ha convertido en ${textoCifrado}`);
