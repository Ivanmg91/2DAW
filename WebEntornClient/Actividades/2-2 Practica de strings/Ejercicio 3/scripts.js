let cadena1 = prompt("Escribe una fras:");
let cadena2 = prompt("Escribe otra frase:");

let cadenaLarga = cadena1.length >= cadena2.length ? cadena1 : cadena2;
alert(`Vamos a analizar el texto "${cadenaLarga}"`);

let caracteresUnicos = "";

for (let i = 0; i < cadenaLarga.length; i++) {

    let caracter = cadenaLarga[i];
    
    if (!caracteresUnicos.includes(caracter)) {
        caracteresUnicos += caracter;
    }
}

let resultado = caracteresUnicos.split("").join(", ");
alert(`En el texto "${cadenaLarga}" encontramos los caracteres sin repetición: ${resultado}`);
