<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    responder(["sucesso" => false, "mensagem" => "Use POST."]);
}

$emailAntigo = trim($_POST["emailAntigo"] ?? "");
$nome        = trim($_POST["nome"] ?? "");
$email       = trim($_POST["email"] ?? "");
$senha       = trim($_POST["senha"] ?? "");

if ($nome == "" || $email == "" || $senha == "") {
    responder(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
}

$sql = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$sql->execute([$emailAntigo]);

if (!$sql->fetch()) {
    responder(["sucesso" => false, "mensagem" => "Usuário não encontrado."]);
}

if ($email != $emailAntigo) {
    $sql = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
    $sql->execute([$email]);

    if ($sql->fetch()) {
        responder(["sucesso" => false, "mensagem" => "Este e-mail já está cadastrado."]);
    }
}

$sql = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE email = ?");
$sql->execute([$nome, $email, $senha, $emailAntigo]);

responder(["sucesso" => true, "mensagem" => "Usuário atualizado com sucesso!"]);
?>
