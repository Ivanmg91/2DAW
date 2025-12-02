// --- ESTILOS ---
document.getElementById("parrafo").style.color = "blue";
document.getElementsByClassName("parrafo2")[0].style.color = "red";
document.getElementsByTagName('p')[2].style.color = "yellow";
document.querySelector('.contenedor2').style.backgroundColor = "black";
document.querySelectorAll('.contenedores')[0].style.backgroundColor = "blue";

// --- INNER TEXT / HTML ---
document.getElementById('innerText').innerText = "Aquí usamos innerText";
document.getElementById('textContent').textContent = "Aquí usamos textContent";
document.getElementById('innerHTML').innerHTML = "Aquí usamos <strong>innerHTML</strong>";

// --- IMAGEN ---
function cambiar() {
    document.getElementById("foto").src = "img/leon.jpg";
}

// --- TÍTULO ---
const titulo = document.getElementById("titulo");
titulo.style.color = "blue";
titulo.removeAttribute("style");

// --- H2 CON CLASE ---
const elementos = document.querySelectorAll("h2");
elementos.forEach(h2 => {
    if (h2.hasAttribute("class")) {
        console.log("H2 con clase:", h2.getAttribute("class"));
        h2.style.color = "blue";
    }
});

// --- ClassList ClassName ---
const parrafo5 = document.getElementById("parrafo5");
const parrafo6 = document.getElementById("parrafo6");
const extras = document.getElementsByClassName("parrafoExtra");

// Añadir clase a los nuevos párrafos
if(parrafo5) parrafo5.classList.add("resaltado");
if(parrafo6) parrafo6.classList.add("nuevoEstilo");

// Cambiar todas las clases de los párrafos extra
for (let i = 0; i < extras.length; i++) {
    extras[i].className = "modificado";
}

const parrafo1 = document.getElementById("parrafo5");
parrafo1.classList.remove("resaltado"); 

// --- Toggle ---
const items = document.querySelectorAll(".item");
items.forEach(item => {
    item.classList.toggle("destacado");
});

// --- Traversing the DOM ---

// --- Padre Hijo ---
const contenedor = document.getElementById("contenedor");
console.log("childNodes:", contenedor.childNodes);
console.log("children:", contenedor.children);
Array.from(contenedor.children).forEach(el => el.style.color = "red");


// -- parentNode parentElement ---
const hijo = document.getElementById("hijo");
console.log(hijo.parentNode);
console.log(hijo.parentElement); 
hijo.parentElement.style.backgroundColor = "lightblue";


// --- nextElementSibling y previusElementSibling ---
const p2 = document.getElementById("p2");
const siguiente = p2.nextElementSibling;
siguiente.style.color = "blue";
const anterior = p2.previousElementSibling;
anterior.style.color = "red"; 

// --- Eliminar ---
const parrafo11 = document.getElementById("eliminar1");
parrafo11.remove(); 
const contenedorr = document.getElementById("contenedorEliminar");
const parrafo2 = document.getElementById("eliminar2");
contenedorr.removeChild(parrafo2);


// --- Crear ---
const contenedorCrear = document.getElementById("contenedorCrear");
const nuevoParrafoFinal = document.createElement("p");
nuevoParrafoFinal.textContent = "Soy el párrafo final (appendChild)";
contenedorCrear.appendChild(nuevoParrafoFinal); 
const nuevoParrafoMedio = document.createElement("p");
nuevoParrafoMedio.textContent = "Soy un párrafo insertado antes del Párrafo 2";
const referencia = contenedorCrear.children[1]; 
contenedorCrear.insertBefore(nuevoParrafoMedio, referencia);



// --- Estructura de elementos ---
const parrafoCategoria = document.createElement('p');
parrafoCategoria.textContent = "TEATRO";
parrafoCategoria.classList.add('categoria', 'teatro');

const parrafoTitulo = document.createElement('p');
parrafoTitulo.textContent = "Actuación teatral";
parrafoTitulo.classList.add('titulo');

const parrafoPrecio = document.createElement('p');
parrafoPrecio.textContent = "$25 por persona";
parrafoPrecio.classList.add('precio');

const info = document.createElement('div');
info.classList.add('info');

info.appendChild(parrafoCategoria);
info.appendChild(parrafoTitulo);
info.appendChild(parrafoPrecio);

const imagenCard = document.createElement('img');
imagenCard.src = "img/tux.jpg";
imagenCard.alt = "Imagen del evento";

const card = document.createElement('div');
card.classList.add('card');

card.appendChild(imagenCard);
card.appendChild(info);

const contenedorEstructura = document.querySelector('#contenedorEstructura');
contenedorEstructura.appendChild(card);