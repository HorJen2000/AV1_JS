<?php
header("Content-Type: application/json; charset=utf-8");

if (!isset($_GET["id"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "Informe o id."], JSON_UNESCAPED_UNICODE);
    exit;
}

$id = $_GET["id"];

$linhas = file("perguntas.txt");

$arquivo = fopen("perguntas.txt", "w");

$encontrou = false;

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if ($dados[0] != $id) {
        fwrite($arquivo, $linha);
    } else {
        $encontrou = true;
    }
}

fclose($arquivo);

if ($encontrou) {
    echo json_encode(["sucesso" => true, "mensagem" => "Pergunta excluída com sucesso!"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Pergunta não encontrada."], JSON_UNESCAPED_UNICODE);
}
?>
