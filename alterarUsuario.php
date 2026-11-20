<?php
require "conexao.php";

if (!isset($_GET["email"])) {
    responder(["sucesso" => false, "mensagem" => "Informe o e-mail."]);
}

$sql = $conexao->prepare("SELECT nome, email, senha FROM usuarios WHERE email = ?");
$sql->execute([$_GET["email"]]);

$usuario = $sql->fetch();

if (!$usuario) {
    responder(["sucesso" => false, "mensagem" => "Usuário não encontrado."]);
}

responder(["sucesso" => true, "usuario" => $usuario]);
?>
