<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    responder(["sucesso" => false, "mensagem" => "Use POST."]);
}

$id       = trim($_POST["id"] ?? "");
$pergunta = trim($_POST["pergunta"] ?? "");
$resposta = trim($_POST["resposta"] ?? "");

if ($id == "" || $pergunta == "" || $resposta == "") {
    responder(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
}

if (!is_numeric($id)) {
    responder(["sucesso" => false, "mensagem" => "O id deve ser um número."]);
}

$sql = $conexao->prepare("SELECT id FROM perguntas_texto WHERE id = ?");
$sql->execute([$id]);

if ($sql->fetch()) {
    responder(["sucesso" => false, "mensagem" => "Já existe uma pergunta com o id $id."]);
}

$sql = $conexao->prepare("INSERT INTO perguntas_texto (id, pergunta, resposta) VALUES (?, ?, ?)");
$sql->execute([$id, $pergunta, $resposta]);

responder(["sucesso" => true, "mensagem" => "Pergunta criada com sucesso!"]);
?>
