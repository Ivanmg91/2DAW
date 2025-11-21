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

    document.getElementById("edit-title").value = task.description;  // Usar value en lugar de placeholder
    document.getElementById("edit-priority").value = task.priority;

    menu.classList.add("visible");

    const button_delete_task = document.getElementById("delete-task");
    const button_edit_task = document.getElementById("edit-task");
    
    const newDeleteButton = button_delete_task.cloneNode(true);
    const newEditButton = button_edit_task.cloneNode(true);
    
    button_delete_task.parentNode.replaceChild(newDeleteButton, button_delete_task);
    button_edit_task.parentNode.replaceChild(newEditButton, button_edit_task);

    newDeleteButton.addEventListener("click", () => {
        console.log("DELETE ejecutado");
        deleteTask(task);
        document.getElementById("edit-delete-tarea").classList.remove("visible");
    });

    newEditButton.addEventListener("click", () => {
        console.log("EDIT ejecutado");
        editTask(task);
        document.getElementById("edit-delete-tarea").classList.remove("visible");
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

function deleteTask(task) {
    // Si la tarea está en "deleted", eliminarla permanentemente
    if (task.status.toLowerCase() === 'deleted') {
        // Confirmar antes de borrar permanentemente
        if (confirm('¿Estás seguro de que quieres eliminar esta tarea permanentemente?')) {
            fetch(`${apiUrl}?id=${task.id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al eliminar la tarea');
                }
                return response.json();
            })
            .then(result => {
                console.log('Tarea eliminada permanentemente');
                fetchTasks(); // Recargar las tareas
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    } else {
        // Si NO está en "deleted", moverla a la columna eliminada
        const data = {
            status: 'deleted'
        };

        fetch(`${apiUrl}?id=${task.id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al mover la tarea a eliminadas');
            }
            return response.json();
        })
        .then(updatedTask => {
            console.log('Tarea movida a eliminadas:', updatedTask);
            fetchTasks(); // Recargar las tareas
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function editTask(task) {
    // Obtener los nuevos valores del formulario
    const newTitle = document.getElementById("edit-title").value;
    const newPriority = document.getElementById("edit-priority").value;

    // Si el input está vacío, usar la descripción original
    const finalTitle = newTitle.trim() !== '' ? newTitle : task.description;

    const data = {
        description: finalTitle,
        priority: newPriority,
        status: task.status  // Mantenemos el status actual
    };

    fetch(`${apiUrl}?id=${task.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al editar la tarea');
        }
        return response.json();
    })
    .then(updatedTask => {
        console.log('Tarea editada:', updatedTask);
        fetchTasks(); // Recargar las tareas para mostrar los cambios
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



// TEMA DRAG AND DROP

// Función para actualizar solo el status de una tarea
function updateTaskStatus(taskId, newStatus) {
    const data = {
        status: newStatus
    };

    fetch(`${apiUrl}?id=${taskId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar el estado de la tarea');
        }
        return response.json();
    })
    .then(updatedTask => {
        console.log('Estado actualizado:', updatedTask);
    })
    .catch(error => {
        console.error('Error:', error);
        fetchTasks();
    });
}

// Función para hacer las tareas arrastrables
function makeDraggable(taskElement, task) {
    taskElement.draggable = true;
    
    taskElement.addEventListener('dragstart', (e) => {
        taskElement.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', JSON.stringify(task));
    });
    
    taskElement.addEventListener('dragend', (e) => {
        taskElement.classList.remove('dragging');
    });
}

// Función para hacer las columnas receptoras de drops
function makeDroppable() {
    const columns = document.querySelectorAll('.kanban-items');
    
    columns.forEach(column => {
        column.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            
            const dragging = document.querySelector('.dragging');
            const afterElement = getDragAfterElement(column, e.clientY);
            
            if (afterElement == null) {
                column.appendChild(dragging);
            } else {
                column.insertBefore(dragging, afterElement);
            }
        });
        
        column.addEventListener('drop', (e) => {
            e.preventDefault();
            const taskData = JSON.parse(e.dataTransfer.getData('text/plain'));
            
            // Determinar el nuevo status según la columna
            const columnParent = column.parentElement;
            let newStatus = '';
            
            if (columnParent.id === 'deleted') {
                newStatus = 'deleted';
            } else if (columnParent.id === 'some-day') {
                newStatus = 'some day';
            } else if (columnParent.id === 'this-week') {
                newStatus = 'this week';
            } else if (columnParent.id === 'tomorrow') {
                newStatus = 'tomorrow';
            } else if (columnParent.id === 'today') {
                newStatus = 'today';
            } else if (columnParent.id === 'in-progress') {
                newStatus = 'in progress';
            } else if (columnParent.id === 'done') {
                newStatus = 'done';
            }
            
            // Solo actualizar si el status cambió
            if (newStatus && newStatus !== taskData.status) {
                updateTaskStatus(taskData.id, newStatus);
            }
        });
        
        column.addEventListener('dragenter', (e) => {
            e.preventDefault();
            column.parentElement.classList.add('drag-over');
        });
        
        column.addEventListener('dragleave', (e) => {
            if (e.target === column) {
                column.parentElement.classList.remove('drag-over');
            }
        });
    });
}

// Función auxiliar para determinar dónde insertar el elemento
function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.task:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

function displayTasks(tasks) {
    document.querySelectorAll('.kanban-items').forEach(col => col.innerHTML = '');    

    tasks.forEach(task => {
        const taskElement = document.createElement('div');
        taskElement.classList.add('task');
        
        // Si la tarea está eliminada, añadir un indicador visual
        const deletedBadge = task.status.toLowerCase() === 'deleted' 
            ? '<span class="deleted-badge">🗑️ Eliminada</span>' 
            : '';
        
        taskElement.innerHTML = `
            <h3>${task.description}</h3>
            <p><strong>Prioridad:</strong> ${task.priority}</p>
            ${deletedBadge}
        `;

        // Hacer la tarea arrastrable
        makeDraggable(taskElement, task);

        // AL PULSAR UNA TAREA
        taskElement.addEventListener("click", (e) => {
            // Evitar abrir el menú si se está arrastrando
            if (!taskElement.classList.contains('dragging')) {
                openEditMenu(task);
            }
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
        } else if (task.status.toLowerCase() === 'done') {
            document.querySelector('#done .kanban-items').appendChild(taskElement);
        }
    });
    
    // Inicializar las zonas drop después de añadir las tareas
    makeDroppable();
}













window.onload = fetchTasks;
