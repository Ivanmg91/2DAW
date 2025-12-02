let getRandomNumber = size => {
    return Math.floor(Math.random() * size);
}

const tesoro = {
    x: getRandomNumber(400),
    y: getRandomNumber(400),

    calcularDistacia: function(clickX, clickY) {
        const dx = this.x - clickX;
        const dy = this.y - clickY;

        return Math.sqrt(dx * dx + dy * dy);
    }
}
console.log("Tesoro en:", tesoro.x, tesoro.y);
console.log("Distancia a un clic en (100, 100):", tesoro.calcularDistancia(100, 100));

let getDistance = (e, target) => {
    let diffX = e.offsetX - target.x;
    let diffY = e.offsetY - target.y;
    return Math.sqrt((diffX * diffX) + (diffY * diffY));
}

let getDistanceHint = distance => {
    if (distance < 30) {
        return "Te estás quemando"
    } else if (distance < 40) {
        return "Muy caliente"
    } else if (distance < 60) {
        return "Caliente"
    } else if (distance < 100) {
        return "Templado"
    } else if (distance < 180) {
        return "Frio"
    } else if (distance < 360) {
        return "Te congelas"
    } else {
        return "Congelado"
    }
}