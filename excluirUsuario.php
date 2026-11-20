<?php
require "conexao.php";

if (!isset($_GET["email"])) {
    responder(["sucesso" => false, "mensagem" => "Informe o e-mail."]);
}

$sql = $conexao->prepare("DELETE FROM usuarios WHERE email = ?");
$sql->execute([$_GET["email"]]);

if ($sql->rowCount() > 0) {
    responder(["sucesso" => true, "mensagem" => "Usuário excluído com sucesso!"]);
} else {
    responder(["sucesso" => false, "mensagem" => "Usuário não encontrado."]);
}
?>
