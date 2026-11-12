<?php
header("Content-Type: application/json; charset=utf-8");

if (!isset($_GET["email"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "Informe o e-mail."], JSON_UNESCAPED_UNICODE);
    exit;
}

$email = $_GET["email"];

$linhas = file("usuarios.txt");

$arquivo = fopen("usuarios.txt", "w");

$encontrou = false;

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if (isset($dados[1]) && $dados[1] == $email) {
        $encontrou = true;
    } else {
        fwrite($arquivo, $linha);
    }
}

fclose($arquivo);

if ($encontrou) {
    echo json_encode(["sucesso" => true, "mensagem" => "Usuário excluído com sucesso!"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
}
?>
