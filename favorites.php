<?php
require_once "header.php";
require_once "php/session/favourites.php";
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?
                while($queryFavourites = $queryFavouritesALL->fetch_assoc())
                {
                ?>    
                    <div class="bg-white p-4 rounded-lg shadow-md text-center">
                        <a href="product.php?id=<?=$queryFavourites["id"]?>" class="block">
                            <img src="<?=$queryFavourites["imageProduct"]?>" alt="<?=$queryFavourites["nameProduct"]?>" class="w-full rounded">
                            <h3 class="text-lg font-bold mt-2"><?=$queryFavourites["nameProduct"]?></h3>
                        </a>
                        <p class="text-xl font-bold mt-2"><?=$queryFavourites["priceProduct"]?></p>
                        <button id="removeFav" data-file-url="php/shop/favourite.php?productid=<?=$queryFavourites["id"]?>&i=1" class="mt-4 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 removeFav">Удалить</button>
                    </div>
                <?
                }
                ?>
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
        document.getElementById("removeFav").onclick = function() { 
                const url = this.getAttribute("data-file-url");
                window.location.href = url;
            };
    </script>
</body>
</html>
