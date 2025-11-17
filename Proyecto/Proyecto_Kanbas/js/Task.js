// task.js

export class Task {
    constructor(description, status = "Some day", priority = "medium", id = null) {
        this.id = id;                 // Opcional, si viene del backend
        this.description = description;
        this.status = status;
        this.priority = priority;
    }
}
