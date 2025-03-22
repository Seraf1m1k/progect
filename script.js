
// Для карзины 
//  document.addEventListener("DOMContentLoaded", () => {

//     // Не работает 
//     const buttons = document.querySelectorAll("button");

//     buttons.forEach(button => {
//         button.addEventListener("click", () => {
//             alert("Товар добавлен в корзину!");
//         });
//     });
// });
 
// 🔹 Уведомления пользователя
function showNotification(message, type = "info", duration = 3000) {
    let container = document.getElementById("notification-container");
    if (!container) {
        container = document.createElement("div");
        container.id = "notification-container";
        container.style.position = "fixed";
        container.style.top = "20px";
        container.style.left = "50%";
        container.style.transform = "translateX(-50%)";
        container.style.zIndex = "9999";
        container.style.display = "flex";
        container.style.flexDirection = "column";
        container.style.alignItems = "center";
        container.style.width = "100%";
        container.style.maxWidth = "400px";
        document.body.appendChild(container);
    }

    const notification = document.createElement("div");
    notification.style.display = "flex";
    notification.style.justifyContent = "space-between";
    notification.style.alignItems = "center";
    notification.style.padding = "12px 16px";
    notification.style.marginBottom = "10px";
    notification.style.borderRadius = "8px";
    notification.style.boxShadow = "0px 4px 6px rgba(0, 0, 0, 0.1)";
    notification.style.fontSize = "16px";
    notification.style.fontWeight = "500";
    notification.style.color = "white";
    notification.style.opacity = "0";
    notification.style.transition = "opacity 0.3s ease-in-out, transform 0.3s ease-in-out";
    notification.style.transform = "translateY(-10px)";

    // Цвет фона в зависимости от типа уведомления
    switch (type) {
        case "success":
            notification.style.backgroundColor = "#4CAF50"; // Зеленый
            break;
        case "error":
            notification.style.backgroundColor = "#F44336"; // Красный
            break;
        case "warning":
            notification.style.backgroundColor = "#FF9800"; // Желтый
            break;
        case "info":
        default:
            notification.style.backgroundColor = "#2196F3"; // Синий
            break;
    }

    // Добавляем текст
    notification.innerHTML = `
        <span>${message}</span>
        <button style="background: none; border: none; color: white; font-size: 20px; cursor: pointer; margin-left: 10px;">&times;</button>
    `;

    // Добавляем в контейнер
    container.appendChild(notification);

    // Анимация появления
    setTimeout(() => {
        notification.style.opacity = "1";
        notification.style.transform = "translateY(0)";
    }, 10);

    // Закрытие по кнопке
    notification.querySelector("button").addEventListener("click", () => {
        hideNotification(notification);
    });

    // Авто-скрытие через duration мс
    setTimeout(() => {
        hideNotification(notification);
    }, duration);
}

function hideNotification(notification) {
    notification.style.opacity = "0";
    notification.style.transform = "translateY(-10px)";
    setTimeout(() => {
        notification.remove();
    }, 200);
}



// Как использовать?
// showNotification("Данные успешно сохранены!", "success");            Зеленый
// showNotification("Ошибка при загрузке!", "error");                   Красный
// showNotification("Проверьте введенные данные", "warning");           Желтый
// showNotification("Обновление завершено", "info", 5000);              Синий, 5 секунд