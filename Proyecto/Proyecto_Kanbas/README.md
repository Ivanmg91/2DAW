# 📋 Kanban Board

Una aplicación web de gestión de tareas con tablero Kanban, desarrollada con tecnologías frontend modernas y backend en PHP.

## 🚀 Tecnologías Utilizadas

### Frontend
- **HTML5** - Estructura semántica
- **CSS3** - Diseño moderno con glassmorphism y gradientes
- **JavaScript ES6+** - Módulos y funcionalidad interactiva
- **Fetch API** - Comunicación con el backend

### Backend
- **PHP** - API RESTful
- **MySQL** - Base de datos relacional
- **PDO** - Capa de abstracción de base de datos

### Servidor
- **XAMPP/LAMPP** - Entorno de desarrollo local

## ✨ Características

- ✅ **7 columnas de estado**: Eliminada, Por hacer, Esta semana, Mañana, Hoy, En progreso, Completado
- 🎯 **Sistema de prioridades**: Muy alta, Alta, Media, Baja
- 🖱️ **Drag & Drop**: Arrastra tareas entre columnas
- ✏️ **CRUD completo**: Crear, leer, actualizar y eliminar tareas
- 🗑️ **Papelera inteligente**: Las tareas se mueven a "Eliminada" antes del borrado definitivo
- 📱 **Diseño responsive**: Optimizado para móviles, tablets y desktop
- 🎨 **UI moderna**: Efectos glassmorphism, animaciones suaves y tema oscuro

## 📁 Estructura del Proyecto

```
Proyecto_Kanbas/
├── index.html              # Página principal
├── css/
│   └── styles.css         # Estilos globales
├── js/
│   ├── app.js            # Lógica principal
│   └── Task.js           # Clase modelo Task
└── php/
    ├── api/
    │   └── tasks.php     # API RESTful
    └── config/
        └── db.php        # Configuración de BD
```

## 🔧 Instalación y Configuración

### 1. Requisitos previos
```bash
sudo apt-get install php-mysql
```

### 2. Iniciar servicios LAMPP
```bash
# Detener MySQL del sistema
sudo systemctl stop mysql

# Iniciar LAMPP
sudo /opt/lampp/lampp startmysql
sudo /opt/lampp/lampp startapache

# Verificar estado
sudo /opt/lampp/lampp status
```

### 3. Configurar base de datos
Accede a phpMyAdmin en `http://localhost/phpmyadmin` y ejecuta el siguiente script SQL:

```sql
-- Crear base de datos
CREATE DATABASE IF NOT EXISTS kanban_board;
USE kanban_board;

-- Crear tabla tasks
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    status ENUM('deleted',
                'Some day', 
                'This week', 
                'Tomorrow', 
                'Today', 
                'In progress',
                'Done') DEFAULT 'Some day',
    priority ENUM('top',
                  'high', 
                  'medium', 
                  'low') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON 
    UPDATE CURRENT_TIMESTAMP
);

-- Insertar datos de ejemplo
INSERT INTO tasks (description, status, priority) VALUES
('Diseñar la interfaz del tablero', 'Today', 'high'),
('Preparar la reunión semanal', 'This week', 'medium'),
('Actualizar documentación técnica', 'Some day', 'low'),
('Implementar API REST', 'In progress', 'top'),
('Revisar código del frontend', 'Tomorrow', 'high');
```

### 4. Acceso
- **Aplicación**: Abre `index.html` en tu navegador
- **API**: `http://127.0.0.1:8000/php/api/tasks.php`

## 🔌 API Endpoints

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| `GET` | `/tasks.php` | Obtener todas las tareas |
| `POST` | `/tasks.php` | Crear nueva tarea |
| `PUT` | `/tasks.php?id={id}` | Actualizar tarea completa |
| `PATCH` | `/tasks.php?id={id}` | Actualizar campos específicos |
| `DELETE` | `/tasks.php?id={id}` | Eliminar tarea permanentemente |

## 🎮 Uso

1. **Crear tarea**: Haz clic en "+ Añadir tarea" en cualquier columna
2. **Mover tarea**: Arrastra y suelta entre columnas
3. **Editar/Eliminar**: Haz clic en una tarea para abrir el menú de opciones
4. **Borrado definitivo**: Las tareas en "Eliminada" se borran permanentemente

## 🛠️ Comandos Útiles

```bash
# Acceder a MySQL
mysql -u root -h 127.0.0.1

# Detener LAMPP
sudo /opt/lampp/lampp stop

# Reiniciar servicios
sudo /opt/lampp/lampp restart
```

## 📱 Responsive Design

- Desktop: Vista completa horizontal con 7 columnas
- Tablet: Optimización de espaciado y tamaños
- Móvil: Columnas apiladas verticalmente

## 🎨 Paleta de Colores

- Fondo principal: `#1a1a2e` → `#16213e` → `#0f3460`
- Acento primario: `#546dfe` (azul)
- Acento secundario: `#7877c6` (púrpura)
- Eliminadas: `#ff5050` (rojo)

---
