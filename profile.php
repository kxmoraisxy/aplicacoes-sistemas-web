<?php
session_start();
include 'php/abreconexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["useremail"])) {
    header("Location: login.html");
    exit();
}

// Busca os dados do usuário no banco
$email = $_SESSION["useremail"];
$sql = "SELECT name, phone, nif, email FROM user WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil | EcoRide</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .profile-container {
            background-color: #243D25;
            width: 50%;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            color: white;
            text-align: center;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #FFD700;
        }
        .info-card {
            background: white;
            color: black;
            padding: 10px;
            border-radius: 8px;
            margin: 10px auto;
            display: flex;
            align-items: center;
            justify-content: left;
            width: 80%;
        }
        .info-card input {
            border: none;
            background: none;
            font-size: 16px;
            width: 100%;
        }
        .edit-button, .save-button {
            background-color: #A67B5B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .edit-button:hover, .save-button:hover {
            background-color: #8B5E3C;
        }

        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex; /* Alinha os botões horizontalmente */
            gap: 10px; /* Espaçamento entre os botões */
            z-index: 1000;
        }

        .back-button {
            background-color: #243D25;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }


        .back-button:hover {
            background-color: #1E2F1E;
        }
    </style>
</head>
<body>
    <div class="w3-bar w3-white w3-padding w3-border-bottom" style="position: relative;">
        <h2 class="w3-left w3-margin-left" style="color: #243D25;"><b>EcoRide</b></h2>
        <div class="button-container">
            <a class="back-button" href="projeto.php">Voltar</a>
            <a class="back-button" href="projeto.php">Logout</a>
        </div>
    </div>
    
    <div class="profile-container">
        <h3><span id="user-name"><?php echo htmlspecialchars($user['name']); ?></span></h3>
        <img src="images/natureBackground.jpg" alt="Avatar" class="profile-avatar">

        <form id="profileForm">
            <div class="info-card">
                <i class="w3-small w3-opacity">&#128100;</i> 
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" disabled>
            </div>
            <div class="info-card">
                <i class="w3-small w3-opacity">&#9993;</i> 
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>
            <div class="info-card">
                <i class="w3-small w3-opacity">&#9742;</i> 
                <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?>" disabled>
            </div>
            <div class="info-card">
                <i class="w3-small w3-opacity">&#128179;</i> 
                <input type="text" name="nif" id="nif" value="<?= htmlspecialchars($user['nif']) ?>" disabled>
            </div>

            <button type="button" class="edit-button" id="editButton">Editar</button>
            <button type="submit" class="save-button" id="saveButton" style="display: none;">Salvar</button>
        </form>
    </div>

    <script src="scripts/perfil.js"></script>
</body>
</html>
