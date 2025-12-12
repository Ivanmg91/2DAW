const estrellas = document.querySelector('.estrellas');
const estrellaRellena = document.querySelectorAll('.fa-star');

const emojis = document.querySelectorAll('.emoji .far');

function pulsar(n) {
    for (let i = 0; i < estrellaRellena.length; i++) {
        if (i <= n) {
            estrellaRellena[i].classList.add("active");
        } else {
            estrellaRellena[i].classList.remove("active");
        }
    }

    const mover = (n+1) * -50;

    emojis.forEach(emoji => {
        emoji.style.transform = `translate(${mover}px)`;

        switch (mover) {
            case -50:
                emoji.style.color = 'red';
                break;
            case -100:
                emoji.style.color = 'orange';
                break;
            case -150:
                emoji.style.color = 'gray';
                break;
            case -200:
                emoji.style.color = 'blue';
                break;
            case -250:
                emoji.style.color = 'green';
                break;
            default:
                break;
        }
    });
}



estrellaRellena[0].addEventListener("click", () => pulsar(0)); // Usando arrow function, pulsar() no se ejecuta hasta clickar
estrellaRellena[1].addEventListener("click", () => pulsar(1));
estrellaRellena[2].addEventListener("click", () => pulsar(2));
estrellaRellena[3].addEventListener("click", () => pulsar(3));
estrellaRellena[4].addEventListener("click", () => pulsar(4));
