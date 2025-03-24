<?php
require_once "header.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное</title>
    <link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <main class="flex-grow">
        <section class="py-10">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-6">Избранные товары</h2>
                <div id="favoritesList" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Товары добавляются динамически через JS -->
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Магазин. Все права защищены.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const favoritesList = document.getElementById("favoritesList");
            let favorites = JSON.parse(localStorage.getItem("favorites")) || [];

            function renderFavorites() {
                favoritesList.innerHTML = "";
                if (favorites.length === 0) {
                    favoritesList.innerHTML = "<p class='text-center text-xl col-span-3'>Нет товаров в избранном</p>";
                    return;
                }
                favorites.forEach(product => {
                    const productEl = document.createElement("div");
                    productEl.classList.add("bg-white", "p-4", "rounded-lg", "shadow-md", "text-center");
                    productEl.innerHTML = `
                        <img src="${product.image}" alt="${product.name}" class="w-full rounded">
                        <h3 class="text-lg font-bold mt-2">${product.name}</h3>
                        <p class="text-xl font-bold mt-2">${product.price}</p>
                        <button class="mt-4 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 removeFav" data-id="${product.id}">Удалить</button>
                    `;
                    favoritesList.appendChild(productEl);
                });

                document.querySelectorAll(".removeFav").forEach(button => {
                    button.addEventListener("click", (e) => {
                        const id = e.target.getAttribute("data-id");
                        favorites = favorites.filter(item => item.id !== id);
                        localStorage.setItem("favorites", JSON.stringify(favorites));
                        renderFavorites();
                    });
                });
            }

            renderFavorites();
        });
    </script>

</body>
</html>
