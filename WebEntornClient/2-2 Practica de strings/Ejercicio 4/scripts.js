let palabra1 = "";
let palabra2 = "";
let palabra3 = "";

do {
    palabra1 = prompt("Introduce la primera palabra (mínimo 4 caracteres, sin espacios):");

    if (palabra1.includes(' ')) {

        alert("La palabra no debe contener espacios.");
        palabra1 = "";
    } else if (palabra1.length < 4) {

        alert("La palabra debe tener al menos 4 caracteres.");
        palabra1 = "";
    }
} while (palabra1.length < 4);

do {
    palabra2 = prompt("Introduce la segunda palabra (mínimo 5 caracteres, sin espacios):");

    if (palabra2.includes(' ')) {

        alert("La palabra no debe contener espacios.");
        palabra2 = "";
    } else if (palabra2.length < 5) {

        alert("La palabra debe tener al menos 5 caracteres.");
        palabra2 = "";
    }
} while (palabra2.length < 5);

do {

    palabra3 = prompt("Introduce la tercera palabra (mínimo 6 caracteres, sin espacios):");

    if (palabra3.includes(' ')) {

        alert("La palabra no debe contener espacios.");
        palabra3 = "";
    } else if (palabra3.length < 6) {

        alert("La palabra debe tener al menos 6 caracteres.");
        palabra3 = "";
    }
} while (palabra3.length < 6);

const inicio = palabra1.substring(0, 2).toUpperCase();
let centro = "";
const longitud2 = palabra2.length;

if (longitud2 % 2 === 0) {

    const medio = longitud2 / 2;
    centro = palabra2.substring(medio - 1, medio + 1).toLowerCase();

} else {

    const medio = Math.floor(longitud2 / 2);
    centro = palabra2.substring(medio - 1, medio + 2).toLowerCase();
}

const fin = palabra3.substring(palabra3.length - 2).toUpperCase();
const nuevaPalabra = inicio + centro + fin;

alert(`Con los textos: "${palabra1}", "${palabra2}" y "${palabra3}", obtenemos: ${nuevaPalabra}`)
