<?php
require_once "php/admins/admins.php";
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
                <tbody>
                    <?php
                    while ($user = $queryUsersForAdmins->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?=$user["name"]?></td>
                        <td><?=$user["email"]?></td>
                        <td><?=$user["password"]?></td>
                        <td><button onclick="editUser('<?=$user['id']?>', '<?=$user['name']?>', '<?=$user['password']?>')">✏️</button></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
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
                <tbody>
                    <?php
                    while ($product = $queryCatalogForAdmins->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?=$product["id"]?></td>
                        <td><?=$product["nameProduct"]?></td>
                        <td><?=$product["priceProduct"]?></td>
                        <td>0</td>
                        <td><button><a href="php/admins/deproduct.php?id='<?=$product['id']?>'">🗑️</a></button></button></td>
                    </tr>
                    <?php
                    }
                    ?>    
                </tbody>
            </table>
        </section>
    </main>
</div>

<div id="userModal" class="modal">
    <form action="php/admins/reuser.php">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Редактирование пользователя</h3>
            <input style="display: none;" id="editUserId" type="text" name="id">
            <input type="text" id="editUserName" name="name" placeholder="Имя">
            <input type="text" id="editUserPassword" name="password" placeholder="Пароль">
            <button name="btn" value="upd" type="submit" >Сохранить</button>             
            <button name="btn" value="del" type="submit">Удалить</button>
        </div>
    </form>
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

    function editUser(id, name, password) {
        document.getElementById("editUserId").value = id;
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
