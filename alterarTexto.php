<?php
header("Content-Type: application/json; charset=utf-8");

if (!isset($_GET["id"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "Informe o id."], JSON_UNESCAPED_UNICODE);
    exit;
}

$id = $_GET["id"];

$linhas = file("perguntasTexto.txt");
array_shift($linhas); // cabeçalho

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if ($dados[0] == $id) {

        echo json_encode([
            "sucesso"  => true,
            "pergunta" => [
                "id"       => $dados[0],
                "pergunta" => $dados[1],
                "resposta" => $dados[2]
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

echo json_encode(["sucesso" => false, "mensagem" => "Pergunta não encontrada."], JSON_UNESCAPED_UNICODE);
?>
