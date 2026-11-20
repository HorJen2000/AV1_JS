<?php
require "conexao.php";

$sql = $conexao->query("SELECT id, pergunta, resposta1, resposta2, resposta3, correta FROM perguntas ORDER BY id");

$perguntas = $sql->fetchAll();

responder(["sucesso" => true, "perguntas" => $perguntas]);
?>
