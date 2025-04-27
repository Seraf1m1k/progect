<?php 
require_once "header.php"; 
require_once "php/shop/product.php";
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
  <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 max-h-[400px] overflow-hidden">
    <?
    ?>
    <div class="w-fit rounded-lg">
      <img style="height: 400px;" src="<?=$resultProduct["imageProduct"]?>" alt="Товар">
    </div>
    <div>
      <h1 class="text-3xl font-bold"><?=$resultProduct["nameProduct"]?></h1>
      <div class="flex items-center space-x-2 mt-2">
        <span class="text-yellow-500"><?=$countString?></span>
        <span class="text-gray-600">( Отзывов: <?=$resultCountReviews["total_rating"]?> )</span>
      </div>
      <p id="productStock" class="text-lg font-semibold mt-2"></p>
      <p class="text-2xl font-bold mt-4"> Стоимость: <?=$resultProduct["priceProduct"]?> 	&#8381</p>
      <form action="php/shop/addbasket.php">
      <!-- Блок количества и кнопки -->
        <div class="mt-6 flex items-center gap-4">
          <!-- Контейнер количества -->
          <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm">
            <button id="decreaseQty" class="px-3 py-2 text-xl bg-gray-100 hover:bg-gray-200 transition">−</button>
            <input
              id="quantity"
              name="count"
              type="text"
              value="1"
              class="w-14 text-center outline-none py-2 text-lg"
              inputmode="numeric"
              pattern="[0-9]*"
            />
            <input type="hidden" name="productid" value="<?=$resultProduct["id"]?>"/>
            <button id="increaseQty" class="px-3 py-2 text-xl bg-gray-100 hover:bg-gray-200 transition">+</button>
          </div>

          <!-- Кнопка -->
          <div class="p-4 bg-gray-100 rounded-lg w-fit">
            <div class="flex flex-col gap-4">
              <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition">
                Добавить в корзину
              </button>
              <button type="button" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-2 rounded-lg transition">
                Добавить в избранное
              </button>
            </div>
          </div>
        </div>
      </form>  
    </div>
  </div>
</section>


    <!-- Блок описания и характеристик -->
    <section class="container mx-auto px-6 mt-10">
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Описание</h2>
        <p class="text-gray-700"><?=$resultProduct["descriptionProduct"]?></p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Характеристики</h2>
        <p class="text-gray-700"><?=$resultProduct["descriptionProduct2"]?></p>
      </div>
    </section>

    <!-- Отзывы -->
    <section class="container mx-auto px-6 mt-10">
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Отзывы</h2>
        <div class="space-y-4">
          <?
          while($result = $resultReviews->fetch_assoc())
          {
          ?>
          <div class="p-4 bg-gray-100 rounded-lg">
            <p class="font-bold"><?=$result["name"]?></p>
            <?
                $countStars = (int)$result["reviewsStars"];
                $starsStrig = "";
                for ($i = 5; $i > 0; $i--)
                {
                    if ($countStars - 1 > 0)
                    {
                        $starsStrig = $starsStrig."⭐";
                        $countStars--; 
                    }
                    else
                    {
                        $starsStrig = $starsStrig."☆";
                    }
                }
            ?>
            <p class="text-yellow-500"><?=$starsStrig?></p>
            <p><?=$result["reviewsText"]?></p>
          </div>
          <?
          }
          ?>
        </div>
        <h1 id="comments"></h1>
      </di>
    </section>
<? if(isset($_SESSION["name"]))
{
?>
    <!-- Форма для добавления комментария -->
    <section class="container mx-auto px-6 mt-10">
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <form action="php/shop/addreviews.php">
          <h2 class="text-2xl font-bold mb-4">Оставить отзыв</h2>
          <!-- Звездный рейтинг -->
          <div class="flex items-center space-x-1 mb-4" id="ratingStars">
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="1">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="2">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="3">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="4">★</span>
            <span class="text-gray-400 cursor-pointer text-2xl" data-value="5">★</span>
          </div>
          <input type="hidden" name="rating" id="rating" value="0">
          <input type="hidden" name="productid" value="<?=$resultProduct["id"]?>">
          <textarea name="text" id="commentText" class="w-full p-3 border border-gray-300 rounded-md" rows="4" placeholder="Напишите ваш отзыв..."></textarea>
          <button type="submit" id="submitComment" class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Отправить отзыв</button>
        </form>
      </div>
    </section>
<?
}
?>
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
              stock: true,
            });
          }, 500);
        });
      }

  
      fetchProductData().then(product => {
        // Заполняем данные продукта
        document.getElementById("productStock").textContent = product.stock ? "В наличии" : "Отсутствует";
        document.getElementById("productStock").classList.toggle("text-green-600", product.stock);
        document.getElementById("productStock").classList.toggle("text-red-600", !product.stock);
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
          document.getElementById("rating").value = selectedRating;
          stars.forEach((s, i) => {
            if (i < selectedRating) {
              s.classList.add("text-yellow-500");
            } else {
              s.classList.remove("text-yellow-500");
            }
          });
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