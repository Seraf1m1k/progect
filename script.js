document.addEventListener("DOMContentLoaded", () => {

    // Не работает 
    const buttons = document.querySelectorAll("button");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            alert("Товар добавлен в корзину!");
        });
    });
});