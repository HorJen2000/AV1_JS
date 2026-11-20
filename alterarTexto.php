<?php
require "conexao.php";

if (!isset($_GET["id"])) {
    responder(["sucesso" => false, "mensagem" => "Informe o id."]);
}

$sql = $conexao->prepare("SELECT id, pergunta, resposta FROM perguntas_texto WHERE id = ?");
$sql->execute([$_GET["id"]]);

$pergunta = $sql->fetch();

if (!$pergunta) {
    responder(["sucesso" => false, "mensagem" => "Pergunta não encontrada."]);
}

responder(["sucesso" => true, "pergunta" => $pergunta]);
?>
