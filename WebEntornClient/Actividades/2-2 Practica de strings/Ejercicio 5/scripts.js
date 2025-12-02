let texto = prompt("Introduce un texto: ");

if (texto === null) {
  alert("Fin del programa.");
  throw new Error("Programa cancelado.");
}

let palabras = texto.trim().split(/\s+/);

while (palabras.length < 3) {
  alert("Tu texto tiene menos de 3 palabras...");
  texto = prompt("Introduce un texto: ");

  if (texto === null) {
    alert("Fin del programa.");
    throw new Error("Programa cancelado.");
  }

  palabras = texto.trim().split(/\s+/);
}
let caracter = prompt("Introduce carácter:");

while (caracter === null || caracter.length !== 1) {
  if (caracter === null) {
    alert("Fin del programa.");
    throw new Error("Programa cancelado.");
  }

  alert("Solo tienes que introducir un carácter.");
  caracter = prompt("Introduce carácter: ");
}

let contador = 0;
for (let i = 0; i < texto.length; i++) {
  if (texto[i] === caracter) {
    contador++;
  }
}

alert(`Tu frase "${texto}" contiene el carácter "${caracter}" ${contador} veces.`);