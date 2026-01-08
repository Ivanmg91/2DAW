/********************************
 ******TRAVERSING THE DOM*********
 *********************************/
//------NAVEGAMOS POR NAV: de padres a hijos---------
console.log("*******children/childnodes******")

//Recordamos seleccion con padre
//const navDOM = document.querySelector('nav.navegacion');
//Recordamos seleccion por clase
//const navDOM = document.querySelector('.navegacion');
//Recordamos selección por etiqueta
const navDOM = document.querySelector('nav.navegacion');
console.log(navDOM);
console.log(navDOM.childNodes);//Recoge TODOS los elementos: los saltos de línea son tb elementos
console.log(navDOM.childNodes[0].nodeType);
console.log(navDOM.childNodes[0].nodeName);

console.log(navDOM.children);
console.log(navDOM.children[0].nodeType);
console.log(navDOM.children[0].nodeName);
console.log('---------------')
//Diferencia entre childNodes y children
/*
for(let a of navDOM.childNodes){
    a.remove();
}

console.log(navDOM.childNodes);
console.log(navDOM.children);
*/

//------------NAVEGAMOS POR CARD: de padres a hijos-----


for (let card of document.querySelectorAll('.card')){
    console.log(card);
}
const cardBici = document.querySelectorAll('.card')[3];
console.log(cardBici);
//Hijos de card
console.log(cardBici.children);
//hijos de card --> div
console.log(cardBici.children[1].children);
//acceder a card --> div --> titulo y modificamos
cardBici.children[1].children[1].textContent = "Traversing the DOM";
//cardBici.children[0].src = 'img/hacer3.jpg';

//Ejemplo: eliminar atributo de un hijo
const cardMusica = document.querySelector('.card'); 
console.log(cardMusica.children[0]);
cardMusica.children[0].removeAttribute('src');


//------------NAVEGAMOS POR CARD: de padres a hijos-----
console.log("******firstChild/lastChild******")
const hospedaje = document.querySelector('.hospedaje');
console.log(hospedaje)
console.log(hospedaje.children);
console.log(hospedaje.childNodes);

const hospedajeHijos = hospedaje.querySelector('.contenedor-cards');
console.log(hospedajeHijos);

console.log(hospedajeHijos.firstElementChild);
console.log(hospedajeHijos.firstChild);

hospedajeHijos.removeChild(hospedajeHijos.firstElementChild)
hospedajeHijos.removeChild(hospedajeHijos.firstChild)



//--------TRAVERSING DE HIJOS A PADRES-------------
console.log("***********parentElement********************")

const padreCardMusica = document.querySelector('.card').parentElement;
console.log(padreCardMusica);
console.log(document.querySelector('.card').parentElement.parentElement);
const masPadre= padreCardMusica.parentElement.parentElement
console.log(masPadre);
console.log(masPadre.parentElement);
console.log(masPadre.parentElement.parentElement);

//--------TRAVERSING ENTRE HERMANOS------------
//Siguiente hermano
const hermanoSig = document.querySelector('.card').nextElementSibling;
console.log(hermanoSig);
//NO usar nextSibling, no muestra elementos, tiene en cuenta saltos de linea
//const hermano = document.querySelector('.card').nextSibling;
//console.log(hermano);

//Anterior hermano: seleccionamos el cuarto card de la section "hacer"
//No puedo seleccionar cards después del 4º pq selecciona el primer section "hacer"
const hermano = document.querySelector('section.hacer div.card:nth-child(4)');
console.log(hermano);
const hermanoAnt = hermano.previousElementSibling;
console.log(hermanoAnt);
console.log("-------------------------");
//Si quiero seleccionar el 6º card, tengo que seleccionar la última 
//section "hacer" y de ahí seleccionar el 2º
const ultNY = document.querySelector('.hacer:last-of-type');
console.log(ultNY);
const segunCardNY = ultNY.querySelector('.card:nth-child(2)');
console.log(segunCardNY);




/* Iván Montiano González */ 

// Abrir el footer al pulsar el botón
const botonFooter = document.querySelector('.btn-flotante');
botonFooter.textContent = "Descubre Más";

botonFooter.addEventListener('click', () => {
    footer.classList.toggle('activo'); // Alternar la clase de activo que es la que muestra el footer

    /* Alternar la clase para que active o desactive + cambiar texto */
    botonFooter.classList.toggle('activo');
    botonFooter.textContent = botonFooter.classList.contains('activo') ? "X Cerrar" : "Descubre Más";
});