let numeros = [];

for (let i = 0; i <= 20; i++) {
    numeros.push(Math.floor(Math.random() * 11));
}
console.log("Array original:" + numeros);


let pares = numeros.filter(numero => numero % 2 === 0);
let impares = numeros.filter(numero => numero % 2 !== 0);
console.log("Array PARES:" + pares);
console.log("Array IMPARES:" + impares);

if (pares.length > 1) {
    pares.shift();
    pares.pop();
}

if (impares.length > 0) {
    let mitad = Math.floor(impares.length / 2);
    if (impares.length % 2 === 0) {
        impares.splice(mitad - 1, 2);
    } else {
        impares.splice(mitad, 1);
    }
}

console.log("Array PARES sin 1º y último:" + pares);
console.log("Array IMPARES sin elementos centrales:" + impares);

let sumaPares = 0;
let sumaImpares = 0;

for (let i = 0; i < pares.length; i++) {
    sumaPares += pares[i];
}

for (let i = 0; i < impares.length; i++) {
    sumaImpares += impares[i];
}

pares.push(sumaPares);
impares.push(sumaImpares);
console.log("Array PARES con suma al final:" + pares);
console.log("Array IMPARES con suma al final:" + impares);


let mediaPares = pares.length > 1 ? Math.floor(sumaPares / (pares.length - 1)) : 0;
let mediaImpares = impares.length > 1 ? Math.floor(sumaImpares / (impares.length - 1)) : 0;

pares.unshift(mediaPares);
impares.unshift(mediaImpares);
console.log("Array PARES con media al inicio:" + pares);
console.log("Array IMPARES con media al inicio:" + impares);

for (let i = 0; i < pares.length; i++) {
    pares[i] = Math.floor(pares[i] * pares[0]);
}
for (let i = 0; i < impares.length; i++) {
    impares[i] = Math.floor(impares[i] * impares[0]);
}

console.log("Array PARES multiplicado por su media:" + pares);
console.log("Array IMPARES multiplicado por su media:" + impares);

let combinado = pares.concat(impares);
console.log("Array combinado:" + combinado);

let combinadoOrdenado = combinado.sort((a, b) => a - b);
console.log("Array FINAL ORDENADO:" + combinadoOrdenado);

let sinRepetidos = [];
for (let i = 0; i < combinadoOrdenado.length; i++) {
    if (!sinRepetidos.includes(combinadoOrdenado[i])) {
        sinRepetidos.push(combinadoOrdenado[i]);
    }
}

console.log("Array FINAL ORDENADO SIN REPETIDOS: " + sinRepetidos);
