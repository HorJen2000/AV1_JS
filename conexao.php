<?php
header("Content-Type: application/json; charset=utf-8");

$dbHost    = "localhost";
$dbNome    = "av1_daw";
$dbUsuario = "root";
$dbSenha   = "";

function responder($dados)
{
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $conexao = new PDO("mysql:host=$dbHost;dbname=$dbNome;charset=utf8mb4", $dbUsuario, $dbSenha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    responder(["sucesso" => false, "mensagem" => "Erro ao conectar com o banco de dados."]);
}
?>
