import { Task } from './Task.js';

const apiUrl = 'http://127.0.0.1:8000/php/api/tasks.php';

function fetchTasks() {

    fetch(apiUrl, {
        method: 'GET',
    })

    .then(response => {
        if (!response.ok) {
            throw new Error('Error al obtener las tareas');
        }
        return response.json();
    })

    .then(tasks => {
        displayTasks(tasks);
    })

    .catch(error => {
        console.error('Error:', error);
    });
}

function openEditMenu(task) {
    const menu = document.getElementById("edit-delete-tarea");

    document.getElementById("edit-title").placeholder = task.description;
    document.getElementById("edit-priority").value = task.priority;

    menu.classList.add("visible");

    const button_delete_task = document.getElementById("delete-task");
    button_delete_task.addEventListener("click", () => {
        console.log("DELETE ejecutado");
        deleteTask(task);

        document.getElementById("edit-delete-tarea").classList.remove("visible");
    });
}

function displayTasks(tasks) {
    document.querySelectorAll('.kanban-items').forEach(col => col.innerHTML = '');    

    tasks.forEach(task => {
        const taskElement = document.createElement('div');
        taskElement.classList.add('task');
        
        taskElement.innerHTML = `
            <h3>${task.description}</h3>
            <p><strong>Prioridad:</strong> ${task.priority}</p>
        `;


        // AL PULSAR UNA TAREA
        taskElement.addEventListener("click", () => {
            openEditMenu(task);

            // Aquí haces lo que quieras
            // alert("Has pulsado: " + task.description);
        });
        
        if (task.status.toLowerCase() === 'deleted') {
            document.querySelector('#deleted .kanban-items').appendChild(taskElement);
        } else if (task.status.toLowerCase() === 'some day') {
            document.querySelector('#some-day .kanban-items').appendChild(taskElement);
        } else if (task.status.toLowerCase() === 'this week') {
            document.querySelector('#this-week .kanban-items').appendChild(taskElement);
        } else if (task.status.toLowerCase() === 'tomorrow') {
            document.querySelector('#tomorrow .kanban-items').appendChild(taskElement);
        } else if (task.status.toLowerCase() === 'today') {
            document.querySelector('#today .kanban-items').appendChild(taskElement);
        } else if (task.status.toLowerCase() === 'in progress') {
            document.querySelector('#in-progress .kanban-items').appendChild(taskElement);
        }
    });
}

function createTask (task) {

    const data = {
        description: task.description,
        status: task.status,
        priority: task.priority,
    };

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })

    .then(response => {
        if (!response.ok) {
            throw new Error('Error al crear las tareas');
        }
        return response.json();
    })

    .then(task => {
        console.log('Tarea creada:', task);
        fetchTasks(); //haciendo fetchtasks se recargan las tareas y aparece la nueva
    })

    .catch(error => {
        console.error('Error:', error);
    });
}

function deleteTask (task) {

    fetch(`${apiUrl}?id=${task.id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
    })

    .then(response => {
        if (!response.ok) {
            throw new Error('Error al eliminar las tareas');
        }
        return response.json();
    })

    .then(task => {
        console.log('Tarea eliminada');
        fetchTasks(); //haciendo fetchtasks se recargan las tareas y aparece la nueva
    })

    .catch(error => {
        console.error('Error:', error);
    });
}



// abrir menu de crear tarea al pulsar el boton
const buttons_add_tarea = document.querySelectorAll(".tarea-button");
const menu = document.getElementById("menu-tarea");
const closeMenu = document.getElementById("close-create-menu");

let selectedColumnStatus;

// Abrir el menú
buttons_add_tarea.forEach(button => {
    button.addEventListener("click", () => {
        selectedColumnStatus = button.dataset.status; // cada botón debe tener un data-status
        menu.classList.add("visible");
    });
});

// Cerrar solo con botón
closeMenu.addEventListener("click", () => {
    menu.classList.remove("visible");
});


const button_save = document.getElementById("save-tarea");

button_save.addEventListener("click", () => {

    const title = document.getElementById("tarea-title").value;
    const priority = document.getElementById("tarea-priority").value;

    let tarea = new Task(title, selectedColumnStatus, priority);
    createTask(tarea);

    menu.classList.remove("visible");
});

// Cerrar menú de editar tarea
const closeEditMenu = document.getElementById("close-edit-menu");

closeEditMenu.addEventListener("click", () => {
    document.getElementById("edit-delete-tarea").classList.remove("visible");
});














window.onload = fetchTasks;
