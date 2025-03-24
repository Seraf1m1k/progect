<?php
require_once "php/shop/catalog.php";
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
        <!-- Поиск и фильтр -->
        <section class="py-6 bg-white shadow">
            <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
                <input id="search" type="text" placeholder="Поиск товаров..." class="w-full md:w-1/3 p-2 border border-gray-300 rounded">
                <select id="categoryFilter" class="mt-4 md:mt-0 p-2 border border-gray-300 rounded">
                    <option value="all">Все категории</option>
                    <?php
                    while($category = $queryCategory->fetch_assoc())
                    {
                    ?>
                    <option value="<?=$category["name"]?>"><?=$category["name"]?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </section>

    <!-- Контент -->
    <main class="flex-grow">
        <section class="py-10">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-6">Каталог товаров</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Товар 1 -->
                    <?php
                    while ($product = $queryProducts->fetch_assoc())
                    {
                    ?>     
                    <a href="product.php?id=<?=$product["id"]?>" class="product bg-white p-4 rounded-lg shadow-md text-center cursor-pointer transition-transform transform hover:scale-105" data-category="<?=$product["categoryProductID"]?>">
                    <!-- Ещё не известно как картинки будут сохронять  -->
                    <img src="<?=$product["imageProduct"]?>" 
                            alt="<?=$product["nameProduct"]?>" 
                            class="max-w-full h-auto md:w-[200px] md:h-[300px] aspect-[2/3] object-cover mx-auto rounded">
                        <h3 class="text-lg font-bold mt-2"><?=$product["nameProduct"]?></h3>
                        <p class="text-xl font-bold mt-2"><?=$product["priceProduct"]?> ₽</p>
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Футер -->
    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Магазин. Все права защищены.</p>
        </div>
    </footer>


    <script>
        document.getElementById("search").addEventListener("input", function () {
            let query = this.value.toLowerCase().trim();
            let products = Array.from(document.querySelectorAll(".product"));
    
            if (query === "") {
                products.forEach(product => product.style.display = "block");
                return;
            }
    
            let startsWithQuery = [];
            let containsQuery = [];
    
            products.forEach(product => {
                let name = product.querySelector("h3").textContent.toLowerCase();
    
                if (name.startsWith(query)) {
                    startsWithQuery.push(product);
                } else if (name.includes(query)) {
                    containsQuery.push(product);
                }
            });
    
            // Показываем сначала те, которые начинаются с введенной строки
            let sortedProducts = [...startsWithQuery, ...containsQuery];
    
            products.forEach(product => product.style.display = "none"); // Скрываем все товары
            sortedProducts.forEach(product => product.style.display = "block"); // Показываем только нужные
        });
    
        
        document.getElementById("categoryFilter").addEventListener("change", function () {
            let selectedCategory = this.value;
            document.querySelectorAll(".product").forEach(product => {
                let category = product.getAttribute("data-category");
                product.style.display = (selectedCategory === "all" || category === selectedCategory) ? "block" : "none";
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
        const urlParams = new URLSearchParams(window.location.search);
        const selectedCategory = urlParams.get("category");

        if (selectedCategory) {
            document.getElementById("categoryFilter").value = selectedCategory;
            filterByCategory(selectedCategory);
        }

        document.getElementById("categoryFilter").addEventListener("change", function () {
            filterByCategory(this.value);
        });

        function filterByCategory(category) {
            document.querySelectorAll(".product").forEach(product => {
                let productCategory = product.getAttribute("data-category");
                product.style.display = (category === "all" || productCategory === category) ? "block" : "none";
            });
        }
    });
    </script>
</body>
</html>