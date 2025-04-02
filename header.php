<?php
session_start();
?>

<!-- Навигация -->
<nav class="bg-white shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="index.php" class="text-2xl font-bold">Магазин</a>
        <ul class="flex space-x-6">
            <li><a href="index.php" class="hover:text-blue-500">Главная</a></li>
            <li><a href="contacts.php" class="hover:text-blue-500">Контакты</a></li>
            <li><a href="favorites.php" class="hover:text-blue-500">Избранное</a></li>
            <li><a href="admin.php" class="hover:text-blue-500">ADMINISTRATOR</a></li>
            <!-- Корзина должна быть доступна только если человек находится в профиле -->
            <li><a href="cart.php" class="hover:text-blue-500">Корзина</a></li>
            <?php
            if (isset($_SESSION["name"])) {
            ?>
                <li><a href="user.php" class="hover:text-blue-500"><?= $_SESSION["name"] ?></a></li>
            <?php
            } else {
            ?>
                <li><button id="openLogin" class="hover:text-blue-500">Войти</button></li>
            <?php
            }
            ?>
        </ul>


        
                    <!--Меню под мобильное устройство-->
                    <!-- Мобильное меню (изначально скрыто) -->
            <div id="dropdownDivider" class="hidden z-[1000] bg-white shadow-lg rounded-lg border dark:bg-gray-800 dark:border-gray-700 w-48 p-2">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                    <li><a href="index.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Главная</a></li>
                    <li><a href="contacts.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Контакты</a></li>
                    <li><a href="favorites.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Избранное</a></li>
                    <li><a href="cart.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Корзина</a></li>
                    <? if (isset($_SESSION["name"])) { ?>
                        <li><a href="user.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"><?= $_SESSION["name"] ?></a></li>
                    <? } ?>
                </ul>
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <button id="openLogin1" class="block w-full text-left px-4 py-2 text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700">Войти</button>
                </div>
            </div>
        </div>
        </nav>

<!-- Модальное окно ВХОДА -->
<!-- Добавлена <form>. Так же добавлен тип кнопки "sumbit" и "name" для полей -->

<div id="loginModal" class="fixed inset-0 bg-opacity-50 flex items-center justify-center hidden z-[1000]">
    <div class="bg-white p-6 rounded-lg w-96 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl" id="closeLogin">&times;</button>
        <form action="/php/session/auth.php"> <!-- NEW -->
            <h2 class="text-2xl font-bold text-center mb-4">Вход</h2>
            <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded mb-3">
            <input type="password" name="password" placeholder="Пароль" class="w-full p-2 border rounded mb-3">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Войти</button>
        </form> <!-- NEW END -->
        <p class="text-center mt-4">Нет аккаунта? <button id="openRegister" class="text-blue-500">Регистрация</button></p>
    </div>
</div>

<!-- Модальное окно РЕГИСТРАЦИИ -->
<!-- Добавлена <form>. Так же добавлен тип кнопки "sumbit" и "name" для полей -->

<div id="registerModal" class="fixed inset-0 bg-opacity-50 flex items-center justify-center hidden  z-[1000]">
    <div class="bg-white p-6 rounded-lg w-96 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl" id="closeRegister">&times;</button>
        <form action="/php/session/reg.php"> <!-- NEW -->
            <h2 class="text-2xl font-bold text-center mb-4">Регистрация</h2>
            <input type="text" name="name" placeholder="Имя" class="w-full p-2 border rounded mb-3">
            <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded mb-3">
            <input type="password" name="password" placeholder="Пароль" class="w-full p-2 border rounded mb-3">
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Зарегистрироваться</button>
        </form> <!-- NEW END -->
        <p class="text-center mt-4">Уже есть аккаунт? <button id="backToLogin" class="text-blue-500">Войти</button></p>
    </div>
</div>
<script>
    
    const loginModal = document.getElementById("loginModal");
    const registerModal = document.getElementById("registerModal");

    const navList = document.querySelector("nav ul"); // Десктопное меню
    const navContainer = document.querySelector("nav .container"); // Контейнер навигации
    const dropdownMenu = document.getElementById("dropdownDivider"); // Мобильное меню
    let burgerButton = document.getElementById("dropdownDividerButton"); // Бургер-кнопка

    function updateMenu() {
        const screenWidth = window.innerWidth;

        if (screenWidth < 1000) {
            // Скрываем основное меню
            if (navList) navList.classList.add("hidden");

            // Если кнопки нет, создаём её
            if (!burgerButton) {
                burgerButton = document.createElement("button");
                burgerButton.id = "dropdownDividerButton";
                burgerButton.className = "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";
                burgerButton.innerHTML = `<label class="cursor-pointer text-gray-700 text-3xl">&#9776;</label>`;

                // Вставляем кнопку перед меню
                navContainer.appendChild(burgerButton);

                // Добавляем обработчик клика
                burgerButton.addEventListener("click", function () {
                    dropdownMenu.classList.toggle("hidden");

                    // Располагаем меню НИЖЕ кнопки на всю ширину экрана
                    if (!dropdownMenu.classList.contains("hidden")) {
                        dropdownMenu.style.position = "absolute";
                        dropdownMenu.style.top = `${burgerButton.offsetTop + burgerButton.offsetHeight}px`; // Отступ вниз
                        dropdownMenu.style.left = "0";
                        dropdownMenu.style.width = "100vw"; // Полная ширина экрана
                    }
                });
            }
        } else {
            // Показываем десктопное меню и удаляем кнопку
            if (navList) navList.classList.remove("hidden");

            if (burgerButton) {
                burgerButton.remove();
                burgerButton = null;
            }

            // Закрываем меню, если было открыто
            dropdownMenu.classList.add("hidden");
        }
    }

    // Запускаем при загрузке и изменении размера окна
    updateMenu();
    window.addEventListener("resize", updateMenu);


    

    document.getElementById("openLogin").addEventListener("click", () => {
        loginModal.classList.remove("hidden");
    });
    document.getElementById("openLogin1").addEventListener("click", () => {
        loginModal.classList.remove("hidden");
    });

    document.getElementById("closeLogin").addEventListener("click", () => {
        loginModal.classList.add("hidden");
    });

    document.getElementById("openRegister").addEventListener("click", () => {
        loginModal.classList.add("hidden");
        registerModal.classList.remove("hidden");
    });

    document.getElementById("closeRegister").addEventListener("click", () => {
        registerModal.classList.add("hidden");
    });

    document.getElementById("backToLogin").addEventListener("click", () => {
        registerModal.classList.add("hidden");
        loginModal.classList.remove("hidden");
    });

    // Закрытие окна при клике вне формы
    window.addEventListener("click", (e) => {
        if (e.target === loginModal) {
            loginModal.classList.add("hidden");
        }
        if (e.target === registerModal) {
            registerModal.classList.add("hidden");
        }
    });

</script>
    