<?php
require_once "php/session.php";
require_once "header.php";
require_once "php/shop/catalog.php";
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

    


    <!-- Главный баннер -->
    <header class="relative w-full h-96 bg-cover bg-center flex items-center justify-center text-white" 
    style="background-image: url('src/img/imgSize.jpg');">
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
            <?
            while ($category = $queryCategory->fetch_assoc())
            {
            ?>
                <a href="catalog.php?category=shoes" class="bg-white p-4 rounded-lg shadow-md text-center block transition-transform transform cursor-pointer hover:scale-105">
                    <img src="<?=$category['img']?>" 
                        alt="<?=$category['name']?>" 
                        class="w-full h-[200px] md:h-[250px] object-cover object-center rounded">
                    <h3 class="text-lg font-bold mt-2"><?=$category["name"]?></h3>
                </a>
            <?
            }
            ?>
            </div>
        </div>
    </section>

    <!-- Популярные товары -->
<section class="py-10 bg-gray-200">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-6">Популярные товары</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?
        while($top = $queryTopProducts->fetch_assoc())
        {
        ?>    
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <img src="<?=$top['imageProduct']?>" alt="" class="w-full rounded">
                <h3 class="text-lg font-bold mt-2"><?=$top["nameProduct"]?></h3>
                <p class="text-xl font-bold mt-2"><?=$top["priceProduct"]?></p>
            </div>
        <?
        }
        ?>
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