<?php
require "conexao.php";

if (!isset($_GET["id"])) {
    responder(["sucesso" => false, "mensagem" => "Informe o id."]);
}

$sql = $conexao->prepare("DELETE FROM perguntas WHERE id = ?");
$sql->execute([$_GET["id"]]);

if ($sql->rowCount() > 0) {
    responder(["sucesso" => true, "mensagem" => "Pergunta excluída com sucesso!"]);
} else {
    responder(["sucesso" => false, "mensagem" => "Pergunta não encontrada."]);
}
?>
