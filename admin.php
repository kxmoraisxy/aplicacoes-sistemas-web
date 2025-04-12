<?php
include 'php/abreconexao.php'; // Conexão com a base de dados

// Buscar contagens de usuários, passageiros e condutores
$sql_users = "SELECT COUNT(*) AS total_users FROM user";
$sql_passengers = "SELECT COUNT(*) AS total_passengers FROM passageiros";
$sql_condutores = "SELECT COUNT(*) AS total_condutores FROM condutores";
$sql_viagens = "SELECT COUNT(*) AS total_viagens FROM viagem";

$total_users = $conn->query($sql_users)->fetch_assoc()['total_users'];
$total_passengers = $conn->query($sql_passengers)->fetch_assoc()['total_passengers'];
$total_condutores = $conn->query($sql_condutores)->fetch_assoc()['total_condutores'];
$total_viagens = $conn->query($sql_viagens)->fetch_assoc()['total_viagens'];

// Buscar dados dos usuários
$sql_user_data = "SELECT NIF, name, email, phone, foto_de_perfil FROM user";
$user_data = $conn->query($sql_user_data);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração | EcoRide</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 200px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            background-color: #243D25;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #1E2F1E;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .stats-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            display: inline-block;
            width: 20%;
            margin: 10px;
        }
        .user-list {
            display: none;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
    <script>
        function showUserData() {
            document.getElementById('dashboard').style.display = 'none';
            document.getElementById('user-data').style.display = 'block';
        }
        function showDashboard() {
            document.getElementById('dashboard').style.display = 'block';
            document.getElementById('user-data').style.display = 'none';
        }

        // Função para filtrar os utilizadores com base no texto da pesquisa
        function searchUsers() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("userTable");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var tds = rows[i].getElementsByTagName("td");
                var match = false;

                // Verificar se o nome, email ou telefone contém o texto da pesquisa
                for (var j = 1; j < tds.length; j++) {
                    if (tds[j] && tds[j].textContent.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                    }
                }

                if (match) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</head>
<body>

<div class="sidebar">
    <h2>EcoRide</h2>
    <a href="#" onclick="showDashboard()">📊 Dashboard</a>
    <a href="#" onclick="showUserData()">👥 User Data</a>
</div>

<div class="content">
    <div id="dashboard">
        <h2>Painel de Administração</h2>
        <h3>Resumo da Plataforma</h3>
        <div class="stats-card">
            <h3>👤 Utilizadores</h3>
            <p><b><?= $total_users ?></b></p>
        </div>
        <div class="stats-card">
            <h3>🚶 Passageiros</h3>
            <p><b><?= $total_passengers ?></b></p>
        </div>
        <div class="stats-card">
            <h3>🚗 Condutores</h3>
            <p><b><?= $total_condutores ?></b></p>
        </div>
        <div class="stats-card">
            <h3>📍 Viagens</h3>
            <p><b><?= $total_viagens ?></b></p>
        </div>
    </div>

    <div id="user-data" class="user-list">
        <h2>Lista de Utilizadores</h2>

        <!-- Barra de pesquisa -->
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchUsers()" placeholder="Pesquisar utilizadores...">
        </div>

        <table id="userTable" class="w3-table w3-bordered w3-striped">
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>NIF</th>
            </tr>
            <?php while($row = $user_data->fetch_assoc()): ?>
                <tr>
                    <td><img src="images/natureBackground.jpg?= htmlspecialchars($row['foto_de_perfil']) ?>" width="50" height="50" style="border-radius: 50%;"></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['NIF']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
