document.addEventListener('DOMContentLoaded', () => {

    // 1.1 Seleccionar y Modificar
    const btnCambiar = document.getElementById('cambiar');
    btnCambiar.addEventListener('click', () => {
        document.getElementById('titulo').innerText = "¡Hola Mundo!";
        document.querySelector('.descripcion').innerText = "Texto modificado con JavaScript";
        document.getElementById('titulo').style.color = 'blue';
    });

    // 1.2 Crear y Agregar (Activado por botón extra para evitar duplicados)
    document.getElementById('btn-crear-lista').addEventListener('click', function() {
        const contenedor = document.getElementById('contenedor');
        if(contenedor.querySelector('ul')) return; // Evitar crear múltiples listas
        
        const ul = document.createElement('ul');
        const tareas = ["Estudiar", "Hacer ejercicio", "Leer"];
        
        tareas.forEach(texto => {
            const li = document.createElement('li');
            li.innerText = texto;
            ul.appendChild(li);
        });
        contenedor.appendChild(ul);
        this.style.display = 'none';
    });


    // 2.1 Click Simple
    const btnSaludar = document.getElementById('saludar');
    const msgSaludar = document.getElementById('mensaje');
    
    btnSaludar.addEventListener('click', () => {
        msgSaludar.innerText = "¡Hola!";
        msgSaludar.style.color = "green";
        setTimeout(() => { msgSaludar.innerText = ""; }, 2000);
    });

    // 2.2 Contador
    let contador = 0;
    const spanNumero = document.getElementById('numero');
    
    document.getElementById('sumar').addEventListener('click', () => {
        contador++;
        spanNumero.innerText = contador;
    });
    
    document.getElementById('restar').addEventListener('click', () => {
        if (contador > 0) {
            contador--;
            spanNumero.innerText = contador;
        }
    });
    
    document.getElementById('reset').addEventListener('click', () => {
        contador = 0;
        spanNumero.innerText = contador;
    });


    // 3.1 Validación Formulario
    const form = document.getElementById('formulario');
    const divErrores = document.getElementById('errores');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        divErrores.innerHTML = ''; // Limpiar
        const nombre = document.getElementById('nombre').value.trim();
        const email = document.getElementById('email').value.trim();
        
        if (!nombre || !email) {
            divErrores.innerHTML = '<p class="error">Todos los campos son obligatorios</p>';
            return;
        }
        if (nombre.length < 2) {
            divErrores.innerHTML += '<p class="error">El nombre debe tener al menos 2 caracteres</p>';
        }
        if (!email.includes('@')) {
            divErrores.innerHTML += '<p class="error">El email no es válido</p>';
        }
        
        if (nombre.length >= 2 && email.includes('@')) {
            divErrores.innerHTML = '<p class="success">Formulario válido</p>';
        }
    });

    // 3.2 Lista de Compras
    const inputItem = document.getElementById('nuevo-item');
    const ulLista = document.getElementById('lista');
    
    document.getElementById('agregar').addEventListener('click', () => {
        if (inputItem.value.trim() === '') return;
        
        const li = document.createElement('li');
        li.innerText = inputItem.value + ' ';
        
        const btnEliminar = document.createElement('button');
        btnEliminar.innerText = 'Eliminar';
        btnEliminar.addEventListener('click', () => ulLista.removeChild(li));
        
        li.appendChild(btnEliminar);
        ulLista.appendChild(li);
        inputItem.value = '';
    });


    // 4.1 Cambiar Estilo
    const caja = document.getElementById('caja');
    const btnEstilo = document.getElementById('cambiar-estilo');
    
    btnEstilo.addEventListener('click', () => {
        caja.classList.toggle('caja-especial');
        caja.classList.toggle('caja-normal');
        
        if (caja.classList.contains('caja-especial')) {
            btnEstilo.innerText = "Volver a Normal";
        } else {
            btnEstilo.innerText = "Cambiar Estilo";
        }
    });

    // 4.2 Semáforo
    const luces = document.querySelectorAll('.luz');
    let estadoSemaforo = 0;
    
    document.getElementById('siguiente-semaforo').addEventListener('click', () => {
        luces.forEach(l => l.classList.remove('activa'));
        
        //Roja - Verde - Amarilla - Roja
        estadoSemaforo = (estadoSemaforo + 1) % 3;
        
        if(estadoSemaforo === 0) document.querySelector('.roja').classList.add('activa');
        else if(estadoSemaforo === 1) document.querySelector('.verde').classList.add('activa');
        else if(estadoSemaforo === 2) document.querySelector('.amarilla').classList.add('activa');
    });


    // 5.1 Mostrar/Ocultar
    const btnToggle = document.getElementById('toggle');
    const contenido = document.getElementById('contenido');
    
    btnToggle.addEventListener('click', () => {
        if (contenido.style.display === 'none') {
            contenido.style.display = 'block';
            btnToggle.innerText = 'Ocultar';
        } else {
            contenido.style.display = 'none';
            btnToggle.innerText = 'Mostrar/Ocultar';
        }
    });

    // 5.2 Galería
    const imagenes = [
        'https://placehold.co/200x150/orange/white?text=Img+1', 
        'https://placehold.co/200x150/purple/white?text=Img+2', 
        'https://placehold.co/200x150/black/white?text=Img+3'
    ];
    let indiceImg = 0;
    const imgTag = document.getElementById('imagen-actual');
    const contadorGaleria = document.getElementById('contador-galeria');
    
    imgTag.src = imagenes[0];
    
    function actualizarGaleria() {
        imgTag.src = imagenes[indiceImg];
        contadorGaleria.innerText = `${indiceImg + 1} / ${imagenes.length}`;
    }

    document.getElementById('siguiente-galeria').addEventListener('click', () => {
        indiceImg = (indiceImg + 1) % imagenes.length; // Ciclo infinito
        actualizarGaleria();
    });

    document.getElementById('anterior').addEventListener('click', () => {
        indiceImg--;
        if (indiceImg < 0) indiceImg = imagenes.length - 1;
        actualizarGaleria();
    });


    // 6.1 Teclado
    const cuadrado = document.getElementById('cuadrado');
    let x = 0, y = 0;
    
    document.addEventListener('keydown', (event) => {
        // Solo mover si las teclas son flechas
        if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(event.key)) {
            event.preventDefault(); // Evitar scroll
            const paso = 10;
            
            switch(event.key) {
                case 'ArrowUp': y -= paso; break;
                case 'ArrowDown': y += paso; break;
                case 'ArrowLeft': x -= paso; break;
                case 'ArrowRight': x += paso; break;
            }
            
            cuadrado.style.top = y + 'px';
            cuadrado.style.left = x + 'px';
        }
    });

    // 6.2 Buscador
    const buscador = document.getElementById('buscador');
    const listaFrutas = document.querySelectorAll('#lista-frutas li');
    
    buscador.addEventListener('input', () => {
        const texto = buscador.value.toLowerCase();
        let hayResultados = false;
        
        listaFrutas.forEach(fruta => {
            if (fruta.innerText.toLowerCase().includes(texto)) {
                fruta.style.display = 'block';
                hayResultados = true;
            } else {
                fruta.style.display = 'none';
            }
        });
    });
});