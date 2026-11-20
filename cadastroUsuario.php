<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    responder(["sucesso" => false, "mensagem" => "Use POST."]);
}

$nome  = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = trim($_POST["senha"] ?? "");

if ($nome == "" || $email == "" || $senha == "") {
    responder(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
}

$sql = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$sql->execute([$email]);

if ($sql->fetch()) {
    responder(["sucesso" => false, "mensagem" => "Este e-mail já está cadastrado."]);
}

$sql = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$sql->execute([$nome, $email, $senha]);

responder(["sucesso" => true, "mensagem" => "Usuário cadastrado com sucesso!"]);
?>
