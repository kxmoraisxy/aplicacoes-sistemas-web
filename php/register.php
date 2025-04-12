<?php
// Incluir o arquivo de conexão com o banco de dados
include 'abreconexao.php';



// Verificar se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
    $nif = isset($_POST["nif"]) ? $_POST["nif"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    require_once 'functions.php';
    
    // Validar os dados recebidos (exemplo básico)
    if (emptyInputSignup($name, $phone, $nif, $email, $password) !== false) {
        header("Location: ../register.html?error=emptyinput");
        exit();
    }

    if (emailExists($conn, $email) !== false) {
        header("Location: ../register.html?error=emailtaken");
        exit();
    }

    if (phoneExists($conn, $phone) !== false) {
        header("Location: ../register.html?error=phonetaken");
        exit();
    }

    if (nifExists($conn, $nif) !== false) {
        header("Location: ../register.html?error=niftaken");
        exit();
    }

    createUser($conn, $name, $phone, $nif, $email, $password);
    
    // Aqui você pode adicionar lógica para inserir os dados no banco de dados
    // Por exemplo:
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // $sql = "INSERT INTO users (name, phone, nif, email, password) VALUES (?, ?, ?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sssss", $name, $phone, $nif, $email, $hashedPassword);
    // if ($stmt->execute()) {
    //     echo json_encode(["success" => true, "message" => "Usuário registrado com sucesso"]);
    // } else {
    //     echo json_encode(["success" => false, "message" => "Erro ao registrar usuário: " . $stmt->error]);
    // }
    
    // Para teste, retornar os dados recebidos
    
} else {
    // Se não for uma requisição POST
    header("Location: ../projeto.php");
}
?>
