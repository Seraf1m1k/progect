<?php
require_once "php/session.php";
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    
    <?php require 'header.php'; ?>


    <!-- Главный баннер -->
    <header class="relative w-full h-96 bg-cover bg-center flex items-center justify-center text-white" 
        style="background-image: url('https://i.pinimg.com/1200x/98/05/c6/9805c6a10f9b1da39314e0a09e77dd89.jpg');">
        <div class="text-center bg-black bg-opacity-50 p-6 rounded">
            <h1 class="text-4xl font-bold">Добро пожаловать в наш магазин</h1>
            <p class="text-lg mt-2">Лучшие товары по выгодным ценам</p>
            <a href="catalog.php" class="mt-4 inline-block bg-blue-500 px-6 py-2 rounded text-white hover:bg-blue-600">Перейти в каталог</a>
        </div>
    </header>
        
    <!-- Категории -->
    <section class="py-10">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-6">Категории товаров</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="catalog.php?category=shoes" class="bg-white p-4 rounded-lg shadow-md text-center block transition-transform transform cursor-pointer hover:scale-105">
                    <img src="https://i.pinimg.com/736x/61/70/9b/61709b7bec77ffab3d0b684ad78a2c58.jpg" 
                        alt="Обувь" 
                        class="w-full h-[200px] md:h-[250px] object-cover object-center rounded">
                    <h3 class="text-lg font-bold mt-2">Обувь</h3>
                </a>

                <a href="catalog.php?category=clothes" class="bg-white p-4 rounded-lg shadow-md text-center block">
                    <img src="https://i.pinimg.com/736x/23/e2/a7/23e2a7bcf47406e46eccd3e249621e26.jpg" 
                        alt="Одежда" 
                        class="w-full h-[200px] md:h-[250px] object-cover object-center rounded">
                    <h3 class="text-lg font-bold mt-2">Одежда</h3>
                </a>

                <a href="catalog.php?category=electronics" class="bg-white p-4 rounded-lg shadow-md text-center block">
                    <img src="https://i.pinimg.com/736x/0a/9e/e9/0a9ee98bc57b4e317f9590895e1ae4cf.jpg" 
                        alt="Электроника" 
                        class="w-full h-[200px] md:h-[250px] object-cover object-center rounded">
                    <h3 class="text-lg font-bold mt-2">Электроника</h3>
                </a>

            </div>
        </div>
    </section>

    <!-- Популярные товары -->
    <section class="py-10 bg-gray-200">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-6">Популярные товары</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <img src="https://i.pinimg.com/736x/6a/16/e0/6a16e0c15c269b8df76730d99359f1eda.jpg" alt="" class="w-full rounded">
                    <h3 class="text-lg font-bold mt-2">Часы</h3>
                    <p class="text-xl font-bold mt-2">12 990 ₽</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <img src="https://i.pinimg.com/736x/dc/83/0d/dc830d29ef745d02c123917764644f33.jpg" alt="Наушники" class="w-full rounded">
                    <h3 class="text-lg font-bold mt-2">Наушники</h3>
                    <p class="text-xl font-bold mt-2">7 490 ₽</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md text-center">
                    <img src="https://i.pinimg.com/736x/d6/93/8e/d6938e031c086a89942d2b8cd16829a3.jpg" alt="Смартфон" class="w-full rounded">
                    <h3 class="text-lg font-bold mt-2">Смартфон</h3>
                    <p class="text-xl font-bold mt-2">39 990 ₽</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Подвал -->
    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Магазин. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>