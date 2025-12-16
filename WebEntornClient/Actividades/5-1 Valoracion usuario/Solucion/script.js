document.addEventListener("DOMContentLoaded", () => {
    const starsContainer = document.querySelector(".estrellas");
    const stars = starsContainer.querySelectorAll(".fa-solid.fa-star");
    const emojiContainer = document.querySelector(".emoji");
    const emojis = emojiContainer.querySelectorAll(".far");

    const emojiColors = [
        "#888", // índice 0: '?' (Gris - Inicial)
        "#d9534f", // índice 1: Angry (Rojo)
        "#f0ad4e", // 2: Frown (Naranja)
        "#f0e68c", // 3: Meh (Amarillo)
        "#5cb85c", // 4: Smile (Verde claro)
        "#008000", // 5: Laugh (Verde oscuro)
    ];

    let fixedRating = 0;

    function highlightStars(value) {
        stars.forEach((star, index) => {
        // Recorremos el Nodelist de stars con index
        // Comparamos el índice de la estrella (0 a 4) con el valor deseado ‘value’ (1 a 5).
        if (index < value) {
            star.classList.add("active"); // Pone la estrella dorada (por CSS)
        } else {
            star.classList.remove("active"); // sino la pone gris
        }
        });
    }

    function updateEmoji(rating) {
        // 1. MOVIMIENTO: (Desplazamiento Horizontal). Cada emoji tiene 50px de ancho.
        const shiftValue = rating * -50;
        emojis.forEach((emoji) => {
        emoji.style.transform = `translateX(${shiftValue}px)`;
        });
        // 2. COLOR: Aplicamos el color en línea usando la variable 'emojiColors'
        const selectedColor = emojiColors[rating];

        emojis.forEach((emoji, index) => {
        if (index === rating) {
            // Solo pintamos el que está visible (su índice coincide con el rating)
            emoji.style.color = selectedColor;
        } else {
            // Limpiamos los colores en línea de los demás emojis por seguridad
            emoji.style.color = "";
        }
        });
    }

    starsContainer.addEventListener("mouseover", (e) => {
        // 1. Verificamos que el evento haya ocurrido en una estrella hija.
        if (e.target.matches(".fa-star")) {
        // 2. Encontramos la posición de la estrella en nuestra lista
        const hoverStar = Array.from(stars).indexOf(e.target);
        // 3. El valor de la calificación es el índice + 1
        const hoverValue = hoverStar + 1;
        // 4. Previsualizar el resaltado
        highlightStars(hoverValue);
        }
    });

    starsContainer.addEventListener("mouseout", () => {
        // Restauramos el estado fijo que está guardado en la variable 'fixedRating'.
        highlightStars(fixedRating);
    });

    starsContainer.addEventListener("click", (e) => {
        if (e.target.matches(".fa-star")) {
        // 1. Calcular el valor de la estrella clicada (igual que en mouseover)
        const clickStar = Array.from(stars).indexOf(e.target);
        const clickValue = clickStar + 1;
        // 2. ACTUALIZAR EL ESTADO
        fixedRating = clickValue;
        // 3. Pintar estrellas permanentemente
        highlightStars(fixedRating);
        // 4. Actualizar el emoji (posición y color)
        updateEmoji(fixedRating);
        }
    });

    fixedRating = 0;
    highlightStars(0);
    updateEmoji(0);
});
