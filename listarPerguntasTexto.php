<?php
require "conexao.php";

$sql = $conexao->query("SELECT id, pergunta, resposta FROM perguntas_texto ORDER BY id");

$perguntas = $sql->fetchAll();

responder(["sucesso" => true, "perguntas" => $perguntas]);
?>
