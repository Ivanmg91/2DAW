/********************************
 ******SELECCIÓN DE ELEMENTOS*****
 *********************************/


//getElementsByClassName --> HTMLCollection con todos los elementos de la clase
console.log("-----getElementsByClassName-------");
const contenedor = document.getElementsByClassName('contenedor');
console.log(contenedor);
//lo podemos recorrer
for (let i = 0;i <= contenedor.length-1; i++){
    console.log(contenedor[i]);
}

//getElementsByTagName --> HTMLCollection con todos los elementos de la etiqueta
console.log("--------getElementsByTagName-------");
const parrafosTodos = document.getElementsByTagName('p');
console.log(parrafosTodos);

for(let elemento of parrafosTodos){
    console.log(elemento.innerHTML);//mostramos su texto
}
/*forEach da ERROR
parrafosTodos.forEach(element => {
    console.log(element);
    }
);
*/

//getElementById --> el 1º elemento que tenga la id
console.log("-----getElementById-------");
const formulario = document.getElementById('formulario');
console.log(formulario);



//querySelector --> selecciona los elementos con identificador de CSS
//Ejemplos con clases
console.log("-----querySelector-------");
// = getElementsByClassName
const card = document.querySelector('.card');
console.log(card);

//Seleccion de elementos hijos --> 
const premium = document.querySelector('section.hacer .premium');
console.log(premium);
const premiumInfo = document.querySelector('.premium .info');
console.log(premiumInfo);
const enlaceInfo = document.querySelector('.premium .info .btn-mi-viaje');
console.log(enlaceInfo);

//Seleccion de un elemento entre varios iguales.
const primerCard = document.querySelector('section.hospedaje div.card:first-of-type');
console.log(primerCard);
const segunCard = document.querySelector('section.hospedaje div.card:nth-child(2)');
console.log(segunCard);
const tercerCard = document.querySelector('section.hospedaje div.card:last-of-type');
console.log(tercerCard);

//querySelector con id
const formularioQuery = document.querySelector('.contenido-hero #formulario');
console.log(formularioQuery);

//querySelector con etiquetas
console.log("---------querySelector por etiqueta---------");
const navegacion = document.querySelector('nav');
console.log(navegacion);
const primNav = navegacion.firstElementChild;
console.log(primNav);
const ultNav = navegacion.lastElementChild;
console.log(ultNav);


console.log("-------querySelectorAll------");
//querySelectorAll --> como querySelector pero devuelve todos
const cardTodos = document.querySelectorAll('.card');
console.log(cardTodos);
for (let card of cardTodos){
    console.log(card);
}

