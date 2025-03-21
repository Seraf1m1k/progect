document.addEventListener("DOMContentLoaded", () => {
    // Создаем контейнер для лоадера
    const loaderContainer = document.createElement("div");
    loaderContainer.id = "loader-container";
    document.body.appendChild(loaderContainer);

    // Загружаем `loader.html`
    fetch("loader.html")
        .then(response => response.text())
        .then(html => {
            loaderContainer.innerHTML = html;
        });

    // Скрываем лоадер после полной загрузки страницы
    window.addEventListener("load", () => {
        setTimeout(() => {
            const loader = document.getElementById("loader");
            if (loader) {
                loader.style.display = "none";
            }
        }, 500); // Можно изменить задержку скрытия
    });
});
