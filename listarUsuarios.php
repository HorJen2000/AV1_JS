<?php
require "conexao.php";

$sql = $conexao->query("SELECT nome, email, senha FROM usuarios ORDER BY nome");

$usuarios = $sql->fetchAll();

responder(["sucesso" => true, "usuarios" => $usuarios]);
?>
