/*********************************************
 ******************CREAR HTML ****************
 *********************************************/
console.log("-----appendChild-----")
//Creamos un enlace --> podría ser un div, img, p....
const newEnlace = document.createElement('a');
newEnlace.textContent = 'Nuevo Enlace';
newEnlace.href = '#';
console.log(newEnlace);

//Lo incluimos en el DOM
//Seleccionamos la navegación
const navegacion3 = document.querySelector('.navegacion');
console.log(navegacion3);
navegacion3.appendChild(newEnlace);
console.log(navegacion3);

console.log("------insertBefore-----");
console.log(navegacion3.children);
navegacion3.insertBefore(newEnlace, navegacion3.children[1]);
console.log(navegacion3);

const otroEnlace = document.createElement('a');
otroEnlace.textContent = 'Otro';
otroEnlace.href = '#';
navegacion3.insertBefore(otroEnlace, navegacion3.children[3]);


//---------CREAR ELEMENTOS CON HIJOS--------------
//Creamos un card
console.log("---------crear un card------------")
//El elemento tiene una imagen y tres párrafos
//Creamos los tres párrafos
const parrafo1 = document.createElement('p');
parrafo1.textContent = 'CONCIERTO';
parrafo1.classList.add('categoria', 'concierto');
console.log(parrafo1);

const parrafo2 = document.createElement('p');
parrafo2.textContent = 'Festival de Música Rock';
parrafo2.classList.add('titulo');
console.log(parrafo2);

const parrafo3 = document.createElement('p');
parrafo3.textContent = '80€ por persona';
parrafo3.classList.add('precio');
console.log(parrafo3);

//Crear div con la clase de info
const info = document.createElement('div');
info.classList.add('info');
console.log(info);

//Añadimos como hijos los párrafos al div
info.appendChild(parrafo1);
info.appendChild(parrafo2);
info.appendChild(parrafo3);
console.log(info.children);

//Creamos la imagen
const imagen = document.createElement('img');
imagen.src = 'img/hacer2.jpg';
console.log(imagen);

//Creamos el div con class 'card'
const divCard = document.createElement('div');
divCard.classList.add('card');
console.log(divCard);

//Añadimos la imagen y la info con los 3p a cardDiv
divCard.appendChild(imagen);
divCard.appendChild(info);
console.log(divCard.children);

//lo asignamos al primer card del proyecto
const padreCard1 = document.querySelector('.contenedor-cards');
console.log(padreCard1);
padreCard1.appendChild(divCard);
padreCard1.insertBefore(divCard, padreCard1.children[0]);
