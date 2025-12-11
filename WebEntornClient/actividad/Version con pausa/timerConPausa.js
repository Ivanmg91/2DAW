// ====================================================================
// 1. DECLARACIÓN DE VARIABLES Y ELEMENTOS GLOBALES
// ====================================================================

let idIntervalo = null;
let segundosRestantes = 0;
let enPausa = true; 
// NUEVA VARIABLE: Rastrea los minutos cargados para detectar cambios en pausa.
let minutosInicialesCargados = 0; 

// Constantes para la lógica de alerta (segundos)
const UMBRAL_ALERTA = 3 * 60; 
const UMBRAL_CRITICO = 10; 

// Referencias a los elementos del DOM
const inputMinutos = document.getElementById('minutos-input');
const botonControl = document.getElementById('boton-control');
const contenedorTemporizador = document.getElementById('temporizador');
const displayTiempo = document.getElementById('tiempo');
const displayEstado = document.getElementById('estado');

// ====================================================================
// 2. FUNCIONES DE SETUP, DATOS Y FORMATO
// ====================================================================

/**
 * Función de Responsabilidad Única (Formato): Convierte segundos totales a una cadena MM:SS.
 */
function formatearTiempo(totalSegundos) {
    const minutos = Math.floor(totalSegundos / 60);
    const segundos = totalSegundos % 60;

    const minFormateados = String(minutos).padStart(2, '0');
    const secFormateados = String(segundos).padStart(2, '0');

    return `${minFormateados}:${secFormateados}`;
}

/**
 * Función de Responsabilidad Única (Cálculo): Lee el input, establece segundosRestantes
 * Y GUARDA el valor inicial en la nueva variable global.
 */
function calcularTiempo() {
    const minutos = parseInt(inputMinutos.value);
    let minutosValidados = 0;

    if (isNaN(minutos) || minutos < 1) {
        minutosValidados = 15;
    } else {
        minutosValidados = minutos;
    }

    // Guardamos el valor validado en ambas variables.
    minutosInicialesCargados = minutosValidados;
    segundosRestantes = minutosValidados * 60;
}

/**
 * Función de Responsabilidad Única (Interfaz): Limpia el DOM y establece el estado inicial.
 */
function resetearInterfaz() {
    contenedorTemporizador.classList.remove('alerta', 'finalizado');
    enPausa = true;
    inputMinutos.disabled = false;
    botonControl.textContent = 'Iniciar Sesión';
    displayEstado.textContent = '✅ Sesión Lista';

    actualizarTiempo();
}

// ====================================================================
// 3. FUNCIONES DE CONTROL DE MOTOR (BOM)
// ====================================================================

function pausarSesion() {
    clearInterval(idIntervalo);
    enPausa = true;
    botonControl.textContent = 'Reanudar Sesión';
    inputMinutos.disabled = false; 
    displayEstado.textContent = '⏸ Sesión Pausada';
}

function reanudarSesion() {
    idIntervalo = setInterval(actualizarTiempo, 1000);
    enPausa = false;
    botonControl.textContent = 'Pausar Sesión';
    inputMinutos.disabled = true; 
    displayEstado.textContent = '🏃 Sesión Activa';
}

// ====================================================================
// 4. EL MOTOR DEL RELOJ (BUCLE DE ACTUALIZACIÓN)
// ====================================================================

function actualizarTiempo() {
    if (!enPausa && segundosRestantes > 0) {
        segundosRestantes--;
    }

    displayTiempo.textContent = formatearTiempo(segundosRestantes);

    // Lógica Condicional Multiumbral (omitiendo por brevedad, el código es el mismo)
    if (segundosRestantes > 0) {
        if (segundosRestantes <= UMBRAL_CRITICO) { 
            contenedorTemporizador.classList.add('finalizado'); 
            contenedorTemporizador.classList.remove('alerta');
            displayEstado.textContent = '🔴 ¡ALERTA CRÍTICA! 🔴';
        } else if (segundosRestantes <= UMBRAL_ALERTA) {
            contenedorTemporizador.classList.add('alerta');
            contenedorTemporizador.classList.remove('finalizado');
            displayEstado.textContent = '🟠 Alerta: ¡Tiempo cerca!';
        } else {
            contenedorTemporizador.classList.remove('alerta', 'finalizado');
        }
    }

    // DETENCIÓN FINAL
    if (segundosRestantes <= 0) {
        segundosRestantes = 0;
        clearInterval(idIntervalo);
        idIntervalo = null; 

        displayTiempo.textContent = formatearTiempo(0);
        
        contenedorTemporizador.classList.add('finalizado');
        botonControl.textContent = 'Reiniciar Sesión';
        displayEstado.textContent = '🏁 Sesión Finalizada';
        inputMinutos.disabled = false;
    }
}

// ====================================================================
// 5. EL DESPACHADOR PRINCIPAL (`controlClick`) - Lógica de Control de Estado
// ====================================================================

function controlClick() {
    // Caso 1: REINICIAR SESIÓN (El tiempo ya es cero)
    if (segundosRestantes <= 0) {
        calcularTiempo();
        resetearInterfaz();
        return; 
    }

    // Caso 2: INICIAR o REANUDAR (Si está en pausa)
    if (enPausa) {
        const minutosActuales = parseInt(inputMinutos.value);

        // CONDICIÓN CLAVE para la nueva característica:
        // Si el valor actual en el input es diferente del valor inicial cargado,
        // significa que el usuario editó el tiempo mientras estaba pausado.
        if (minutosActuales !== minutosInicialesCargados && minutosActuales > 0) {
            // Tratamos el evento como un REINICIO FORZADO, para que tome el nuevo valor
            calcularTiempo(); 
            resetearInterfaz(); // Limpia el estado de pausa y actualiza el display
            
            // Ahora que el tiempo ha sido recalculado, iniciamos la sesión
            reanudarSesion();
            return; 
        }
        
        // Si no hay cambios, simplemente reanudamos desde donde se quedó.
        reanudarSesion();

    // Caso 3: PAUSAR (Si no está en pausa)
    } else {
        pausarSesion();
    }
}

// ====================================================================
// 6. INICIO DE LA APLICACIÓN
// ====================================================================

botonControl.addEventListener('click', controlClick);

// Inicialización
calcularTiempo();
resetearInterfaz();