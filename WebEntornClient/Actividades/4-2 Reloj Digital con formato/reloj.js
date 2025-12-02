// Paso 1 crear mostarReloj
function mostrarReloj() {

    // Paso 2 obtener fecha y hora
    const ahora = new Date();
    let horas = ahora.getHours();
    let minutos = ahora.getMinutes();
    let segundos = ahora.getSeconds();
    let fecha = ahora.getDate();

    // Paso 3 formato horas:minutos:segundos
    horas = horas < 10 ? '0' + horas : horas;
    minutos = minutos < 10 ? '0' + minutos : minutos;
    segundos = segundos < 10 ? '0' + segundos : segundos;

    const horaFormateada = `${horas}:${minutos}:${segundos}`;

    // Paso 4 formatear fecha
    // 4.1 arrays dias semana
    const diasSemana = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Nov', 'Oct', 'Dic'];

    // 4.2 obtener indice dia mes
    const diaSemana = diasSemana[ahora.getDay()];
    const diaMes = ahora.getDate();
    const mes = meses[ahora.getMonth()];

    //4.3 cadena de texto de la fecha
    const fechaFormateada = `${diaSemana}. ${diaMes} ${mes}`;

    // Paso 5 mostrar valores dom
    document.getElementById('hora').textContent = horaFormateada;
    document.getElementById('fecha').textContent = fechaFormateada;
    
    // Paso 6 animacion
    const relojContainer = document.getElementById('contenedor');
    relojContainer.classList.toggle('animar');

}

// Paso 7 ejecutar
setInterval(mostrarReloj, 1000);

function iniciarCuentaAtras() {
    const finDeAno = new Date("2026-01-01 00:00:00");
    const ahora = new Date();

    let diferencia = finDeAno - ahora;
    let segundos = Math.floor((diferencia / 1000) % 60);
    var minutos = Math.floor((diferencia / 1000 / 60) % 60);
    var horas = Math.floor((diferencia / (1000 * 60 * 60)) % 24);
    var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));

    horas = horas < 10 ? '0' + horas : horas;
    minutos = minutos < 10 ? '0' + minutos : minutos;
    segundos = segundos < 10 ? '0' + segundos : segundos;

    const horaFormateada = `${dias}dias ${horas}:${minutos}:${segundos}`;
    document.getElementById('hora_atras').textContent = horaFormateada;

}

setInterval(iniciarCuentaAtras, 1000);