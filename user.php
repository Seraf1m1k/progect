<?php
require_once "php/session.php";
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Страница пользователя</title>
	<link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>

<body class="bg-gray-100">

    <!-- 🔹 Фиксированная шапка -->
    <header class="bg-white shadow-md py-4 fixed w-full top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="index.php" class="text-2xl font-bold">Магазин</a>
            <ul class="flex space-x-6">
                <li><a href="index.php" class="hover:text-blue-500">Главная</a></li>
                <li><a href="contacts.html" class="hover:text-blue-500">Контакты</a></li>
                <li><button id="logoutBtn" class="hover:text-red-500">Выход</button></li>
            </ul>
        </div>
    </header>

    <!-- 🔹 Основной контент -->
    <div class="flex h-screen mt-20">  <!-- Добавлен отступ mt-20, чтобы контент не перекрывался хедером -->
        <!-- Меню слева -->
        <div class="w-64 bg-white shadow-md p-6">
            <h2 class="text-2xl font-semibold text-center mb-6">Меню</h2>
            <ul class="space-y-4">
                <li><button id="ordersTab" class="w-full text-left text-lg">История заказов</button></li>
                <li><button id="addressTab" class="w-full text-left text-lg">Адрес доставки</button></li>
                <li><button id="contactTab" class="w-full text-left text-lg">Контактные данные</button></li>
                <li><button id="logoutBtnMenu" class="w-full text-left text-lg text-red-500">Выход</button></li>
            </ul>
        </div>

        <!-- Основной контент -->
        <div class="flex-1 p-6">
            <!-- 🔹 История заказов -->
            <div id="ordersSection" class="hidden">
                <h2 class="text-2xl font-semibold mb-4">История заказов</h2>
                <ul id="ordersList" class="space-y-2">
                    <!-- Заказы загружаются сюда -->
                </ul>
            </div>

            <!-- 🔹 Адрес доставки -->
            <div id="addressSection" class="hidden">
                <h2 class="text-2xl font-semibold mb-4">Адрес доставки</h2>
                <div class="space-y-4">
                    <div>
                        <label for="city" class="block text-lg">Город</label>
                        <input id="city" type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите город" />
                        <ul id="citySuggestions" class="bg-white border border-gray-300 mt-2 rounded-md hidden"></ul>
                    </div>
                    <div>
                        <label for="address" class="block text-lg">Адрес</label>
                        <input id="address" type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите адрес" />
                    </div>
                </div>
            </div>

            <!-- 🔹 Контактные данные -->
		<div id="contactSection" class="hidden">
			<h2 class="text-2xl font-semibold mb-4">Контактные данные</h2>
			<div class="space-y-4">
				<div>
					<label for="fullName" class="block text-lg">ФИО</label>
					<input id="fullName" type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите ФИО" value="<?=$_SESSION["name"]?>"/>
				</div>
				<div>
					<label for="phone" class="block text-lg">Номер телефона</label>
					<input id="phone" type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите номер телефона" value="<?=$_SESSION["phone_number"]?>" />
				</div>
				<div>
					<label for="email" class="block text-lg">Email</label>
					<input id="email" type="email" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите email" value="<?=$_SESSION["email"]?>" />
				</div>

				<!-- ✅ Чекбокс для смены пароля -->
				<div class="flex items-center space-x-2">
					<input id="changePasswordCheckbox" type="checkbox" class="w-5 h-5">
					<label for="changePasswordCheckbox" class="text-lg">Сменить пароль</label>
				</div>

				<!-- 🔹 Поля смены пароля (скрыты по умолчанию) -->
    			<!-- Добавлена <form>. Так же добавлен тип кнопки "sumbit" и "name" для полей -->

				<div id="passwordFields" class="hidden space-y-4">
					<form action="php/session/repass.php"> <!-- NEW -->
						<div>
							<label for="oldPassword" class="block text-lg">Текущий пароль</label>
							<input id="oldPassword" name="oldPassword" type="password" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите текущий пароль" />
						</div>
						<div>
							<label for="newPassword" class="block text-lg">Новый пароль</label>
							<input id="newPassword" name="newPassword" type="password" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Введите новый пароль" />
						</div>
						<div>
							<label for="confirmNewPassword" class="block text-lg">Подтвердите новый пароль</label>
							<input id="confirmNewPassword" name="newPassword2" type="password" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Повторите новый пароль" />
						</div>
						<button type="sumbit" id="updatePasswordBtn" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
							Обновить пароль
						</button>
					</form> <!-- END NEW -->
				</div>

				</div>
			</div>

        </div>
    </div>

    <script>
        // Функции для переключения вкладок
        const ordersTab = document.getElementById("ordersTab");
        const addressTab = document.getElementById("addressTab");
        const contactTab = document.getElementById("contactTab");
        const logoutBtn = document.getElementById("logoutBtn");
        const logoutBtnMenu = document.getElementById("logoutBtnMenu");

        const ordersSection = document.getElementById("ordersSection");
        const addressSection = document.getElementById("addressSection");
        const contactSection = document.getElementById("contactSection");

		document.addEventListener("DOMContentLoaded", () => {
		// Открываем "Историю заказов" по умолчанию
		ordersSection.classList.remove("hidden");
		addressSection.classList.add("hidden");
		contactSection.classList.add("hidden");
		});
        ordersTab.addEventListener("click", () => {
            ordersSection.classList.remove("hidden");
            addressSection.classList.add("hidden");
            contactSection.classList.add("hidden");
        });

        addressTab.addEventListener("click", () => {
            addressSection.classList.remove("hidden");
            ordersSection.classList.add("hidden");
            contactSection.classList.add("hidden");
        });

        contactTab.addEventListener("click", () => {
            contactSection.classList.remove("hidden");
            ordersSection.classList.add("hidden");
            addressSection.classList.add("hidden");
        });

        logoutBtn.addEventListener("click", () => {
			window.location.href = "php/session/logout.php";
        });

        logoutBtnMenu.addEventListener("click", () => {
			window.location.href = "php/session/logout.php";
        });


				// JS для пароля
			document.addEventListener("DOMContentLoaded", () => {
			const changePasswordCheckbox = document.getElementById("changePasswordCheckbox");
			const passwordFields = document.getElementById("passwordFields");
			const updatePasswordBtn = document.getElementById("updatePasswordBtn");

			// ✅ Показать/скрыть поля смены пароля при активации чекбокса
			changePasswordCheckbox.addEventListener("change", () => {
				if (changePasswordCheckbox.checked) {
					passwordFields.classList.remove("hidden");
				} else {
					passwordFields.classList.add("hidden");
				}
			});



		// 	Удалено. Было использована другая схема.
		//
		// 	// ✅ Обработчик кнопки смены пароля
		// 	updatePasswordBtn.addEventListener("click", async () => {
		// 		const oldPassword = document.getElementById("oldPassword").value;
		// 		const newPassword = document.getElementById("newPassword").value;
		// 		const confirmNewPassword = document.getElementById("confirmNewPassword").value;

		// 		if (!newPassword) {
		// 			showNotification("Новый пароль не может быть пустым", "warning");
		// 			return;
		// 		}

		// 		if (newPassword !== confirmNewPassword) {
		// 			showNotification("Пароли не совпадают", "error");;
		// 			return;
		// 		}

		// 		try {
		// 			// 🔹 Запрос на сервер (заготовка для бэкенда)
		// 			const response = await axios.post("/api/update-password", {
		// 				oldPassword,
		// 				newPassword,
		// 			});

		// 			if (response.status === 200) {
		// 				showNotification("Данные успешно сохранены!", "success");
		// 			} else {
		// 				showNotification("Проверьте введенные данные", "warning"); 
		// 			}
		// 		} catch (error) {
		// 			alert("Ошибка сервера: " + error.response?.data?.message || "Попробуйте позже.");
		// 		}
		// 	});
		});

    </script>


</body>
</html>