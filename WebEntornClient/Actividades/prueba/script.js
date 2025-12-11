const bar = document.getElementById('my-bar');
const text = document.getElementById('text-percentage');

let width = 0;

function cargarBarra() {
    if (width >= 100) {
            text.innerText = "¡Carga Completa!";
        } else {
            width++; 
            
            bar.style.width = width + '%'; 
            
            text.innerText = width + '%'; 
        }
}

setInterval(cargarBarra, 50);