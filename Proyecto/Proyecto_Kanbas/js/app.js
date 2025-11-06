// app.js

// URL de la API que obtendrá las tareas
const apiUrl = 'http://127.0.0.1/php/api/tasks.php'; // Cambia esta URL si es necesario

// Función para obtener las tareas y mostrarlas en el HTML
function fetchTasks() {
    // Hacemos una solicitud GET a la API
    fetch(apiUrl, {
        method: 'GET', // Método GET para obtener las tareas
    })
    .then(response => {
        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            throw new Error('Error al obtener las tareas');
        }
        return response.json();
    })
    .then(tasks => {
        // Llamamos a la función para mostrar las tareas en el HTML
        displayTasks(tasks);
    })
    .catch(error => {
        // En caso de error, mostramos un mensaje en la consola
        console.error('Error:', error);
    });
}

// Función para mostrar las tareas en el HTML
function displayTasks(tasks) {
    const taskList = document.getElementById('task-list');
    
    // Limpiamos el contenido anterior de las tareas
    taskList.innerHTML = '';

    // Iteramos sobre las tareas y las agregamos al contenedor
    tasks.forEach(task => {
        const taskElement = document.createElement('div');
        taskElement.classList.add('task'); // Clase para el estilo de cada tarea
        
        taskElement.innerHTML = `
            <h3>${task.description}</h3>
            <p><strong>Estado:</strong> ${task.status}</p>
            <p><strong>Prioridad:</strong> ${task.priority}</p>
        `;
        
        taskList.appendChild(taskElement);
    });
}

// Llamamos a la función para cargar las tareas al iniciar la página
window.onload = fetchTasks;
