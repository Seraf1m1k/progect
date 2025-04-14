<?php 
require_once "header.php"; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Товар</title>
  <link href="src/output.css" rel="stylesheet">
  <link href="src/style.css" rel="stylesheet">
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
        <span id="reviewCount" class="text-gray-600"></span>
      </div>
      <p id="productStock" class="text-lg font-semibold mt-2"></p>
      <p id="productPrice" class="text-2xl font-bold mt-4"></p>

      <!-- Блок количества и кнопки -->
      <div class="mt-6 flex items-center gap-4">
        <!-- Контейнер количества -->
        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm">
          <button id="decreaseQty" class="px-3 py-2 text-xl bg-gray-100 hover:bg-gray-200 transition">−</button>
          <input
            id="quantity"
            type="text"
            value="1"
            class="w-14 text-center outline-none py-2 text-lg"
            inputmode="numeric"
            pattern="[0-9]*"
          />
          <button id="increaseQty" class="px-3 py-2 text-xl bg-gray-100 hover:bg-gray-200 transition">+</button>
        </div>

        <!-- Кнопка -->
        <button id="addToCart" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition">
          Добавить в корзину
        </button>
      </div>
    </div>
  </div>
</section>


    <!-- Блок описания и характеристик -->
    <section class="container mx-auto px-6 mt-10">
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Описание</h2>
        <p id="productDesc" class="text-gray-700"></p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Характеристики</h2>
        <p id="productSpecs" class="text-gray-700"></p>
      </div>
    </section>

    <!-- Отзывы -->
    <section class="container mx-auto px-6 mt-10">
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Отзывы</h2>
        <div id="reviews" class="space-y-4"></div>
      </div>
    </section>

    <!-- Форма для добавления комментария -->
    <section class="container mx-auto px-6 mt-10">
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
        <textarea id="commentText" class="w-full p-3 border border-gray-300 rounded-md" rows="4" placeholder="Напишите ваш отзыв..."></textarea>
        <button id="submitComment" class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
          Отправить отзыв
        </button>
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
      // Эмуляция загрузки данных с бэкенда
      function fetchProductData() {
        return new Promise(resolve => {
          setTimeout(() => {
            resolve({
              name: "RHJCJDJR",
              image: "https://source.unsplash.com/500x500/?shoes",
              price: "5 990 ₽",
              stock: true,
              desc: "Эти кроссовки сочетают комфорт и стиль. Идеальный выбор для активного образа жизни.",
              specs: "Материал: кожа, Размеры: 38-45, Цвет: черный",
              reviews: [
                { name: "Иван", text: "Отличные кроссовки!", rating: 5 },
                { name: "Анна", text: "Качество на высоте.", rating: 4 },
                { name: "Петр", text: "Хорошие, но быстро пачкаются.", rating: 3 }
              ]
            });
          }, 500);
        });
      }

      fetchProductData().then(product => {
        // Заполняем данные продукта
        document.getElementById("productName").textContent = product.name;
        document.getElementById("productImage").src = product.image;
        document.getElementById("productPrice").textContent = product.price;
        document.getElementById("productStock").textContent = product.stock ? "В наличии" : "Отсутствует";
        document.getElementById("productStock").classList.toggle("text-green-600", product.stock);
        document.getElementById("productStock").classList.toggle("text-red-600", !product.stock);

        // Описание и характеристики
        document.getElementById("productDesc").textContent = product.desc;
        document.getElementById("productSpecs").textContent = product.specs;

        const reviewCount = product.reviews.length;
        document.getElementById("reviewCount").textContent = `(${reviewCount} ${reviewCount === 1 ? "отзыв" : reviewCount < 5 ? "отзыва" : "отзывов"})`;

        if (reviewCount > 0) {
          const totalRating = product.reviews.reduce((sum, review) => sum + review.rating, 0);
          const avgRating = totalRating / reviewCount;
          document.getElementById("productRating").textContent = "⭐".repeat(Math.round(avgRating)) + "☆".repeat(5 - Math.round(avgRating));
        } else {
          document.getElementById("productRating").textContent = "☆☆☆☆☆";
        }

        const reviewsContainer = document.getElementById("reviews");
        product.reviews.forEach(review => {
          const reviewEl = document.createElement("div");
          reviewEl.classList.add("p-4", "bg-gray-100", "rounded-lg");
          reviewEl.innerHTML = `
            <p class="font-bold">${review.name}</p>
            <p class="text-yellow-500">${"⭐".repeat(review.rating)}${"☆".repeat(5 - review.rating)}</p>
            <p>${review.text}</p>
          `;
          reviewsContainer.appendChild(reviewEl);
        });
      });

      // Реализация звездного рейтинга для оставления отзыва
      const stars = document.querySelectorAll("#ratingStars span");
      let selectedRating = 0;
      stars.forEach((star, index) => {
        star.addEventListener("mouseover", () => {
          stars.forEach((s, i) => {
            if (i <= index) {
              s.classList.add("text-yellow-500");
            } else {
              s.classList.remove("text-yellow-500");
            }
          });
        });
        star.addEventListener("mouseout", () => {
          stars.forEach((s, i) => {
            if (i < selectedRating) {
              s.classList.add("text-yellow-500");
            } else {
              s.classList.remove("text-yellow-500");
            }
          });
        });
        star.addEventListener("click", () => {
          selectedRating = index + 1;
          stars.forEach((s, i) => {
            if (i < selectedRating) {
              s.classList.add("text-yellow-500");
            } else {
              s.classList.remove("text-yellow-500");
            }
          });
        });
      });

      // Обработчик отправки комментария
      const submitComment = document.getElementById("submitComment");
      submitComment.addEventListener("click", () => {
        const commentText = document.getElementById("commentText").value.trim();
        if (selectedRating === 0) {
          alert("Пожалуйста, выберите рейтинг.");
          return;
        }
        if (commentText.length < 5) {
          alert("Комментарий слишком короткий.");
          return;
        }
        // Эмуляция отправки данных на сервер
        console.log('Отправить отзыв:', { rating: selectedRating, comment: commentText });
        alert('Отзыв отправлен!');
        // Очистка формы
        document.getElementById("commentText").value = "";
        selectedRating = 0;
        stars.forEach(s => s.classList.remove("text-yellow-500"));
      });
    });



    
  </script>

  <!-- кнопки добавления в карзину и - + -->
  <script>
  const qtyInput = document.getElementById('quantity');
  const increaseBtn = document.getElementById('increaseQty');
  const decreaseBtn = document.getElementById('decreaseQty');
  const addToCartBtn = document.getElementById('addToCart');

  // Увеличение
  increaseBtn.addEventListener('click', () => {
    let value = parseInt(qtyInput.value) || 1;
    qtyInput.value = value + 1;
  });

  // Уменьшение
  decreaseBtn.addEventListener('click', () => {
    let value = parseInt(qtyInput.value) || 1;
    if (value > 1) {
      qtyInput.value = value - 1;
    }
  });

  // Разрешаем ввод только цифр
  qtyInput.addEventListener('input', (e) => {
    qtyInput.value = qtyInput.value.replace(/[^0-9]/g, '');
    if (qtyInput.value === '') qtyInput.value = '1';
  });

  // Обработка кнопки
  addToCartBtn.addEventListener('click', () => {
    const quantity = parseInt(qtyInput.value) || 1;
    const productName = document.getElementById('productName').textContent;
    const price = document.getElementById('productPrice').textContent;

    alert(`🛒 Вы добавили ${quantity} x "${productName}" в корзину (Цена: ${price})`);
    console.log(`Добавлено: ${quantity} x ${productName}`);
  });
</script>


</body>
</html>