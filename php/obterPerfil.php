<?php
session_start();
include 'abreconexao.php';

if (!isset($_SESSION["useremail"])) {
    echo json_encode(["success" => false, "message" => "Usuário não autenticado"]);
    exit();
}

$email = $_SESSION["useremail"];
$sql = "SELECT name, phone, nif, email FROM user WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "user" => $user]);
} else {
    echo json_encode(["success" => false, "message" => "Usuário não encontrado"]);
}

$stmt->close();
$conn->close();
?>
