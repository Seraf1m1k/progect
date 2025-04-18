<?php
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>

<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    <section class="py-10">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-6">Контакты</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p><strong>Телефон:</strong> +7 (999) 123-45-67</p>
                <p><strong>Email:</strong> info@shop.ru</p>
                <p><strong>Адрес:</strong> г. Москва, ул. Примерная, 10</p>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Магазин. Все права защищены.</p>
        </div>
    </footer>

</body>
</html>