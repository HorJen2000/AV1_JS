<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    responder(["sucesso" => false, "mensagem" => "Use POST."]);
}

$id       = trim($_POST["id"] ?? "");
$pergunta = trim($_POST["pergunta"] ?? "");
$resposta = trim($_POST["resposta"] ?? "");

if ($pergunta == "" || $resposta == "") {
    responder(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
}

$sql = $conexao->prepare("SELECT id FROM perguntas_texto WHERE id = ?");
$sql->execute([$id]);

if (!$sql->fetch()) {
    responder(["sucesso" => false, "mensagem" => "Pergunta não encontrada."]);
}

$sql = $conexao->prepare("UPDATE perguntas_texto SET pergunta = ?, resposta = ? WHERE id = ?");
$sql->execute([$pergunta, $resposta, $id]);

responder(["sucesso" => true, "mensagem" => "Pergunta atualizada com sucesso!"]);
?>
