<?php
header("Content-Type: application/json; charset=utf-8");

$perguntas = [];

$linhas = file("perguntas.txt");

// Pula o cabeçalho
array_shift($linhas);

foreach ($linhas as $linha) {

    if (trim($linha) == "") continue;

    $dados = explode(";", trim($linha));

    $perguntas[] = [
        "id"        => $dados[0],
        "pergunta"  => $dados[1],
        "resposta1" => $dados[2],
        "resposta2" => $dados[3],
        "resposta3" => $dados[4],
        "correta"   => $dados[5]
    ];
}

echo json_encode(["sucesso" => true, "perguntas" => $perguntas], JSON_UNESCAPED_UNICODE);
?>
