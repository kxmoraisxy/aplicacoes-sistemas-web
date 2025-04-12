<?php
session_start();
include 'abreconexao.php';

if (!isset($_SESSION["useremail"])) {
    echo json_encode(["success" => false, "message" => "Usuário não autenticado"]);
    exit();
}

$name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
$phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : '';
$nif = isset($_POST["nif"]) ? trim($_POST["nif"]) : '';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';

$user_email = $_SESSION["useremail"];

if (empty($name) || empty($phone) || empty($nif) || empty($email)) {
    echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios"]);
    exit();
}

$sql = "UPDATE user SET name=?, phone=?, nif=?, email=? WHERE email=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Erro na preparação da query"]);
    exit();
}

$stmt->bind_param("sssss", $name, $phone, $nif, $email, $user_email);

if ($stmt->execute()) {
    $_SESSION["useremail"] = $email;
    echo json_encode(["success" => true, "message" => "Perfil atualizado com sucesso"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao atualizar o perfil"]);
}

$stmt->close();
$conn->close();
?>
