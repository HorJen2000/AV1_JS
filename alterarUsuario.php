<?php
header("Content-Type: application/json; charset=utf-8");

if (!isset($_GET["email"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "Informe o e-mail."], JSON_UNESCAPED_UNICODE);
    exit;
}

$email = $_GET["email"];

$linhas = file("usuarios.txt");
array_shift($linhas); // cabeçalho

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if (isset($dados[1]) && $dados[1] == $email) {

        echo json_encode([
            "sucesso" => true,
            "usuario" => [
                "nome"  => $dados[0],
                "email" => $dados[1],
                "senha" => $dados[2]
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
?>
