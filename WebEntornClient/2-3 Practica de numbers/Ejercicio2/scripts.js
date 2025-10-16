function obtenerNumeroComensales() {
    let numeroComensales = parseInt(prompt("¿Con cuántos comensales vamos a contar?"));

    while (isNaN(numeroComensales) || numeroComensales <= 0) {
        alert("Por favor, introduce un número de comensales");
        numeroComensales = parseInt(prompt("¿Con cuántos comensales vamos a contar?"));
    }

    return numeroComensales;
}

function obtenerNumeroComensalesAbuelos(comensalesTotales) {
    let numeroComensalesAbuelos = parseInt(prompt("¿Cuántos comensales tenemos mayores de 65 años?"));

    while (isNaN(numeroComensalesAbuelos) || numeroComensalesAbuelos > comensalesTotales) {
        alert("Por favor, introduce un número de comensales mayores de 65 años válido.");
        numeroComensalesAbuelos = parseInt(prompt("¿Cuántos comensales tenemos mayores de 65 años?"));
    }

    return numeroComensalesAbuelos;
}

function obtenerNumeroComensalesNinios(comensalesTotales, comensalesAbuelos) {
    let numeroComensalesNinios = parseInt(prompt("¿Cuántos comensales tenemos menores de 10 años con menú infantil?"));

    while (isNaN(numeroComensalesNinios) || numeroComensalesNinios > (comensalesTotales - comensalesAbuelos)) {
        alert("Por favor, introduce un número de comensales menores de 10 años válido.");
        numeroComensalesNinios = parseInt(prompt("¿Cuántos comensales tenemos menores de 10 años con menú infantil?"));
    }

    return numeroComensalesNinios;
}

function mostrarInfoMenus() {
    alert("Estas son las opciones de menús para adultos...\n\n1.- Menú del dia --> 12,5€\n\n2.- Menú del día PREMIUM --> 17,45€\n\n3.- Menú Buffet Libre --> 23,85€\n\nNOTA: Todos los precios son sin IVA")
}

function mostrarCuantosPorElegir (menusElegidos, menusPorElegir) {
    alert(`De momento llevas ${menusElegidos} menús elegidos...\nTe quedan ${menusPorElegir}`)
}

function mostrarResultadoMenus(numeroComensales,numeroComensalesNinios, numeroComensalesAdultos, menu1, menu2, menu3, menu4) {
    alert(`Contamos con un total de ${numeroComensales}: ${numeroComensalesNinios} niños y ${numeroComensalesAdultos} adultos\n\nLos menús que servirán serán los siguientes:\n\n${menu1} menú/s del día\n\n${menu2} menú/s PREMIUM\n\n${menu3} menú/s Buffet Libre\n\n${menu4} menú/s infatil/es`);
}

// Start program
let numeroComensales = obtenerNumeroComensales();
let numeroComensalesAbuelos = obtenerNumeroComensalesAbuelos(numeroComensales);
let numeroComensalesNinios = obtenerNumeroComensalesNinios(numeroComensales, numeroComensalesAbuelos);
let numeroComensalesAdultos = numeroComensales - numeroComensalesNinios;

let menu1 = 0; // daily menu
let menu2 = 0; // daily menu premium
let menu3 = 0; // free buffet menu
let menu4 = numeroComensalesNinios;

// User select menus
mostrarInfoMenus();

let menusElegidos = 0;
let menusPorElegir = numeroComensales - numeroComensalesNinios;
mostrarCuantosPorElegir(menusElegidos, menusPorElegir);

if (menusPorElegir > 0) {
    let cuantosQuieren = parseInt(prompt("¿Cuántos comensales quieren el menú?\n1.- Menú del día --> 12,5€"), 10);

    if (isNaN(cuantosQuieren)) {
        cuantosQuieren = 0;
    }

    menusElegidos += cuantosQuieren;
    menu1 = cuantosQuieren;
    menusPorElegir = numeroComensales - numeroComensalesNinios - menusElegidos;
    mostrarCuantosPorElegir(menusElegidos, menusPorElegir);
}

if (menusPorElegir > 0) {
    cuantosQuieren = parseInt(prompt("¿Cuántos comensales quieren el menú?\n2.- Menú del día PREMIUM --> 17,45€"), 10);

    if (isNaN(cuantosQuieren)) {
        cuantosQuieren = 0;
    }

    menusElegidos += cuantosQuieren;
    menu2 = cuantosQuieren;
    menusPorElegir = numeroComensales - numeroComensalesNinios - menusElegidos;
    mostrarCuantosPorElegir(menusElegidos, menusPorElegir);
}

menu3 = menusPorElegir;

mostrarResultadoMenus(numeroComensales, numeroComensalesNinios, numeroComensalesAdultos, menu1, menu2, menu3, menu4);

