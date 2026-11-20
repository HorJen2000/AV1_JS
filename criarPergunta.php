<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    responder(["sucesso" => false, "mensagem" => "Use POST."]);
}

$id        = trim($_POST["id"] ?? "");
$pergunta  = trim($_POST["pergunta"] ?? "");
$resposta1 = trim($_POST["resposta1"] ?? "");
$resposta2 = trim($_POST["resposta2"] ?? "");
$resposta3 = trim($_POST["resposta3"] ?? "");
$correta   = trim($_POST["correta"] ?? "");

if ($id == "" || $pergunta == "" || $resposta1 == "" || $resposta2 == "" || $resposta3 == "") {
    responder(["sucesso" => false, "mensagem" => "Preencha todos os campos."]);
}

if (!is_numeric($id)) {
    responder(["sucesso" => false, "mensagem" => "O id deve ser um número."]);
}

if (!in_array($correta, ["1", "2", "3"])) {
    responder(["sucesso" => false, "mensagem" => "A resposta correta deve ser 1, 2 ou 3."]);
}

$sql = $conexao->prepare("SELECT id FROM perguntas WHERE id = ?");
$sql->execute([$id]);

if ($sql->fetch()) {
    responder(["sucesso" => false, "mensagem" => "Já existe uma pergunta com o id $id."]);
}

$sql = $conexao->prepare("INSERT INTO perguntas (id, pergunta, resposta1, resposta2, resposta3, correta) VALUES (?, ?, ?, ?, ?, ?)");
$sql->execute([$id, $pergunta, $resposta1, $resposta2, $resposta3, $correta]);

responder(["sucesso" => true, "mensagem" => "Pergunta criada com sucesso!"]);
?>
