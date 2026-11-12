<?php
header("Content-Type: application/json; charset=utf-8");

$usuarios = [];

$linhas = file("usuarios.txt");
array_shift($linhas);

foreach ($linhas as $linha) {

    if (trim($linha) == "") continue;

    $dados = explode(";", trim($linha));

    $usuarios[] = [
        "nome"  => $dados[0],
        "email" => $dados[1],
        "senha" => $dados[2]
    ];
}

echo json_encode(["sucesso" => true, "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
?>
