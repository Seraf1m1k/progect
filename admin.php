<?php
header('Content-Type: text/html; charset=UTF-8');

// Функция для загрузки пользователей
function getUsers()
{
    return json_encode([
        ["id" => 1, "name" => "Иван", "email" => "ivan@mail.com", "password" => "1234"],
        ["id" => 2, "name" => "Анна", "email" => "anna@mail.com", "password" => "5678"]
    ]);
}

// Функция для загрузки товаров
function getProducts()
{
    return json_encode([
        ["id" => 101, "name" => "Ноутбук", "price" => 50000, "rating" => 4.5],
        ["id" => 102, "name" => "Смартфон", "price" => 30000, "rating" => 4.8]
    ]);
}

// Обработка AJAX-запросов
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data["action"])) {
        if ($data["action"] === "updateUser") {
            echo json_encode(["message" => "Пользователь обновлен: " . $data["name"]]);
        } elseif ($data["action"] === "deleteUser") {
            echo json_encode(["message" => "Пользователь с ID " . $data["id"] . " удален"]);
        }
    }
    exit();
}

// Запрос списка пользователей и товаров
if (isset($_GET["getUsers"])) {
    echo getUsers();
    exit();
} elseif (isset($_GET["getProducts"])) {
    echo getProducts();
    exit();
}

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="src\style-admin.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <nav class="sidebar">
        <ul>
            <li><a href="#" id="usersTab">Пользователи</a></li>
            <li><a href="#" id="productsTab">Товары</a></li>
        </ul>
    </nav>

    <main class="content">
        <section id="usersSection">
            <h2>Пользователи</h2>
            <input type="text" id="searchUser" placeholder="Поиск по имени или почте">
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Почта</th>
                        <th>Пароль</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>

        <section id="productsSection" style="display: none;">
            <h2>Товары</h2>
            <table id="productsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Рейтинг</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>
    </main>
</div>

<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Редактирование пользователя</h3>
        <input type="text" id="editUserName" placeholder="Имя">
        <input type="text" id="editUserPassword" placeholder="Пароль">
        <button id="saveUser">Сохранить</button>
        <button id="deleteUser">Удалить</button>
    </div>
</div>

<script>
    let currentUserId = null;

    document.getElementById('usersTab').addEventListener('click', function () {
        document.getElementById('usersSection').style.display = 'block';
        document.getElementById('productsSection').style.display = 'none';
        loadUsers();
    });

    document.getElementById('productsTab').addEventListener('click', function () {
        document.getElementById('usersSection').style.display = 'none';
        document.getElementById('productsSection').style.display = 'block';
        loadProducts();
    });

    function loadUsers() {
        fetch("admin.php?getUsers")
            .then(response => response.json())
            .then(users => {
                let tbody = document.querySelector("#usersTable tbody");
                tbody.innerHTML = "";
                users.forEach(user => {
                    let row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.password}</td>
                        <td><button onclick="editUser(${user.id}, '${user.name}', '${user.password}')">✏️</button></td>
                    `;
                });
            });
    }
    function loadProducts() {
    fetch("admin.php?getProducts")
        .then(response => response.json())
        .then(products => {
            let tbody = document.querySelector("#productsTable tbody");
            tbody.innerHTML = "";
            products.forEach(product => {
                let row = tbody.insertRow();
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td>${product.rating}</td>
                    <td><button onclick="deleteProduct(${product.id})">🗑️</button></td>
                `;
            });
        })
        .catch(error => console.error("Ошибка загрузки товаров:", error));
}

    function editUser(id, name, password) {
        currentUserId = id;
        document.getElementById("editUserName").value = name;
        document.getElementById("editUserPassword").value = password;
        document.getElementById("userModal").style.display = "block";
    }

    document.getElementById("saveUser").addEventListener("click", function () {
        fetch("admin.php", {
            method: "POST",
            body: JSON.stringify({
                action: "updateUser",
                id: currentUserId,
                name: document.getElementById("editUserName").value,
                password: document.getElementById("editUserPassword").value
            }),
            headers: { "Content-Type": "application/json" }
        }).then(() => {
            document.getElementById("userModal").style.display = "none";
            loadUsers();
        });
    });

    document.querySelectorAll(".close").forEach(el => {
        el.addEventListener("click", function () {
            document.getElementById("userModal").style.display = "none";
        });
    });

    loadUsers();
    document.getElementById("searchUser").addEventListener("input", function () {
    let searchValue = this.value.toLowerCase();
    let rows = document.querySelectorAll("#usersTable tbody tr");

    rows.forEach(row => {
        let name = row.cells[0].textContent.toLowerCase();
        let email = row.cells[1].textContent.toLowerCase();
        if (name.includes(searchValue) || email.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

document.getElementById('productsTab').addEventListener('click', function () {
    document.getElementById('usersSection').style.display = 'none';
    document.getElementById('productsSection').style.display = 'block';
    loadProducts();
});
</script>

</body>
</html>
