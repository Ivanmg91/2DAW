let textoACifrar = prompt("Escribe el texto que quieres cifrar: ");
let n;

// user must introduce a entire number
while (isNaN(n = prompt("Escribe un número: "))) {
    alert("Debes introducir un número entero.")
}
// the number mustn't be a float
let numero = Math.floor(n);
console.log(numero);