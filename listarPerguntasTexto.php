<?php
header("Content-Type: application/json; charset=utf-8");

$perguntas = [];

$linhas = file("perguntasTexto.txt");
array_shift($linhas);

foreach ($linhas as $linha) {

    if (trim($linha) == "") continue;

    $dados = explode(";", trim($linha));

    $perguntas[] = [
        "id"       => $dados[0],
        "pergunta" => $dados[1],
        "resposta" => $dados[2]
    ];
}

echo json_encode(["sucesso" => true, "perguntas" => $perguntas], JSON_UNESCAPED_UNICODE);
?>
