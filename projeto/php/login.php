<?php
// Incluir o arquivo de conexão com o banco de dados
include 'abreconexao.php';

// Verificar se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once 'functions.php';

    echo $email;
    echo $password;

    // Validar os dados recebidos
    if (emptyInputLogin($email, $password) !== false) {
        header("Location: ../login.html?error=emptyinput");
        exit();
    }

    loginUser($conn, $email, $password);
} else {
    header("Location: ../projeto.php?login=false");
    exit();
}


?>