<?php 
require_once "header.php"; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товар</title>
    <link href="src\output.css" rel="stylesheet">
    <link href="src\style.css" rel="stylesheet">
    <script src="loader.js"></script>
    <script src="script.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">


    <main class="flex-grow">
        <section class="py-10">
            <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10">
                <img id="productImage" src="" alt="Товар" class="w-full rounded-lg">
                <div>
                    <h1 id="productName" class="text-3xl font-bold"></h1>
                    <div class="flex items-center space-x-2 mt-2">
                        <span id="productRating" class="text-yellow-500"></span>
                        <!-- считаем количество комментариев -->
                        <span class="text-gray-600">(123 отзыва)</span>
                    </div>
                    <p id="productStock" class="text-lg font-semibold mt-2"></p>
                    <p id="productPrice" class="text-2xl font-bold mt-4"></p>

                    <div class="flex items-center mt-4 space-x-4">
                        <button id="decreaseQty" class="bg-gray-300 px-3 py-2 rounded">-</button>
                        <input id="productQty" type="text" value="1" class="w-16 text-center text-xl font-bold border border-gray-300 rounded">
                        <button id="increaseQty" class="bg-gray-300 px-3 py-2 rounded">+</button>
                    </div>

                    <!-- Кнопки -->
                    <div class="mt-6 flex space-x-4">
                        <button class="bg-blue-500 text-white py-3 px-6 rounded hover:bg-blue-600">Добавить в корзину</button>
                        <button id="addToFav" class="border border-red-500 text-red-500 py-3 px-6 rounded hover:bg-red-500 hover:text-white">❤️ В избранное</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Описание, характеристики, отзывы -->
        <section class="container mx-auto px-6 mt-10">
            <!-- Описание -->
            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <h2 class="text-2xl font-bold mb-4">Описание</h2>
                <p id="productDesc" class="text-gray-700 overflow-hidden transition-all duration-300 
                    md:max-h-full max-h-[5.5rem] md:line-clamp-none line-clamp-4">
                </p>
                <button id="toggleDesc" class="text-blue-500 mt-2 hidden md:hidden">Читать полностью</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <h2 class="text-2xl font-bold mb-4">Характеристики</h2>
                <p id="productSpecs" class="text-gray-700"></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <h2 class="text-2xl font-bold mb-4">Отзывы</h2>
                <div id="reviews" class="space-y-4">
                    <!-- Отзывы будут добавляться через JS -->
                </div>
            </div>
        </section>
    </main>

    <!-- Добавление комментария -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Оставить отзыв</h2>

        <!-- Звездный рейтинг -->
        <div class="flex items-center space-x-1 mb-4" id="ratingStars">
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="1">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="2">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="3">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="4">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="5">★</span>
        </div>

        <textarea id="commentText" class="w-full p-3 border border-gray-300 rounded-md" 
            rows="4" placeholder="Напишите ваш отзыв..."></textarea>

        <button id="submitComment" 
            class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
            Отправить отзыв
        </button>
    </div>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Магазин. Все права защищены.</p>
        </div>
    </footer>


<!-- отображение рейтинга в отзывах и на товаре-->
<script>
    const products = {
        "1": {
            name: "RHJCJDJR",
            image: "https://source.unsplash.com/500x500/?shoes",
            desc: "Удобные и стильные кроссовки.",
            price: "5 990 ₽",
            stock: true,
            specs: "Материал: кожа, Размеры: 38-45",
            reviews: [
                { name: "Иван", time: "1 год назад", text: "Отличные кроссовки!", rating: 5 },
                { name: "Анна", time: "3 месяца назад", text: "Качество на высоте.", rating: 4 },
                { name: "Петр", time: "1 месяц назад", text: "Хорошие, но быстро пачкаются.", rating: 3 }
            ]
        }
    };

    document.addEventListener("DOMContentLoaded", () => {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get("id");

        if (!productId || !products[productId]) {
            document.querySelector("main").innerHTML = "<p class='text-center text-2xl'>Товар не найден</p>";
            return;
        }

        const product = products[productId];

        // Заполняем информацию о товаре
        document.getElementById("productName").textContent = product.name;
        document.getElementById("productImage").src = product.image;
        document.getElementById("productDesc").textContent = product.desc;
        document.getElementById("productPrice").textContent = product.price;
        document.getElementById("productStock").textContent = product.stock ? "В наличии" : "Отсутствует";
        document.getElementById("productStock").classList.toggle("text-green-600", product.stock);
        document.getElementById("productStock").classList.toggle("text-red-600", !product.stock);
        document.getElementById("productSpecs").textContent = product.specs;

        // Подсчет количества отзывов
        const reviewCount = product.reviews.length;
        document.querySelector(".text-gray-600").textContent = `(${reviewCount} ${reviewCount === 1 ? "отзыв" : reviewCount < 5 ? "отзыва" : "отзывов"})`;

        // Подсчет средней оценки
        if (reviewCount > 0) {
            const totalRating = product.reviews.reduce((sum, review) => sum + review.rating, 0);
            const avgRating = totalRating / reviewCount;

            // Создание звездного рейтинга
            const stars = "⭐".repeat(Math.round(avgRating)) + "☆".repeat(5 - Math.round(avgRating));
            document.getElementById("productRating").textContent = stars;
        } else {
            document.getElementById("productRating").textContent = "☆☆☆☆☆"; // Если отзывов нет
        }

        // Загружаем отзывы
        const reviewsContainer = document.getElementById("reviews");
        reviewsContainer.innerHTML = ""; // Очищаем перед вставкой

        product.reviews.forEach(review => {
            const reviewEl = document.createElement("div");
            reviewEl.classList.add("p-4", "bg-gray-100", "rounded-lg");

            let stars = "⭐".repeat(review.rating) + "☆".repeat(5 - review.rating);

            reviewEl.innerHTML = `
                <div class="flex items-center space-x-3">
                    <img src="https://source.unsplash.com/50x50/?person" class="rounded-full">
                    <div>
                        <p class="font-bold">${review.name}</p>
                        <p class="text-sm text-gray-600">${review.time}</p>
                        <p class="text-yellow-500">${stars}</p>
                    </div>
                </div>
                <p class="mt-2">${review.text}</p>
            `;
            reviewsContainer.appendChild(reviewEl);
        });
    });
</script>

        <!-- Увеличение и уменьшение количества товара -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const qtyInput = document.getElementById("productQty");
                const decreaseBtn = document.getElementById("decreaseQty");
                const increaseBtn = document.getElementById("increaseQty");

                // Разрешаем ввод только цифр
                qtyInput.addEventListener("input", function () {
                    this.value = this.value.replace(/\D/g, ""); // Удаляем все нечисловые символы
                    if (this.value === "" || parseInt(this.value) < 1) {
                        this.value = "1"; // Минимальное значение 1
                    }
                });

                // Уменьшение количества
                decreaseBtn.addEventListener("click", function () {
                    let value = parseInt(qtyInput.value) || 1;
                    if (value > 1) {
                        qtyInput.value = value - 1;
                    }
                });

                // Увеличение количества
                increaseBtn.addEventListener("click", function () {
                    let value = parseInt(qtyInput.value) || 1;
                    qtyInput.value = value + 1;
                });

                // Запрещаем ввод минуса и букв с клавиатуры
                qtyInput.addEventListener("keypress", function (event) {
                    if (event.key < "0" || event.key > "9") {
                        event.preventDefault();
                    }
                });

                const stars = document.querySelectorAll("#ratingStars span");
                const commentText = document.getElementById("commentText");
                const submitBtn = document.getElementById("submitComment");
                let selectedRating = 0;

                // Обработчик кликов по звездам
                stars.forEach(star => {
                    star.addEventListener("click", function () {
                        selectedRating = parseInt(this.getAttribute("data-value"));
                        updateStars(selectedRating);
                    });
                });

                function updateStars(rating) {
                    stars.forEach(star => {
                        star.classList.toggle("text-yellow-500", star.getAttribute("data-value") <= rating);
                        star.classList.toggle("text-gray-400", star.getAttribute("data-value") > rating);
                    });
                }

                // Обработчик отправки отзыва
                submitBtn.addEventListener("click", function () {
                    const comment = commentText.value.trim();
                    if (selectedRating === 0) {
                        alert("Пожалуйста, поставьте оценку.");
                        return;
                    }
                    if (comment.length < 5) {
                        alert("Комментарий слишком короткий.");
                        return;
                    }

                    // Отправка данных (примерно, замените на ваш бэкенд)
                    console.log("Отправка:", { rating: selectedRating, comment });

                    alert("Спасибо за ваш отзыв!");
                    commentText.value = "";
                    updateStars(0);
                });
            });



        </script>
    </body>
</html>
