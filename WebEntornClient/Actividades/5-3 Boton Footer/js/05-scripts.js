/*********************************************
 *********ELIMINAR ELEMENTOS DEL DOM**********
 *********************************************/

//Eliminamos desde la referncia del propio elemento
const primerEnlace = document.querySelector('a');
console.log(primerEnlace);
primerEnlace.remove();

//Eliminamos desde la referencia del padre
const navegacion2 = document.querySelector('.navegacion');
console.log(navegacion2.children);
navegacion2.removeChild(navegacion2.children[2]);