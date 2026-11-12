<?php
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["sucesso" => false, "mensagem" => "Use POST."], JSON_UNESCAPED_UNICODE);
    exit;
}

$id        = trim($_POST["id"] ?? "");
$pergunta  = trim($_POST["pergunta"] ?? "");
$resposta1 = trim($_POST["resposta1"] ?? "");
$resposta2 = trim($_POST["resposta2"] ?? "");
$resposta3 = trim($_POST["resposta3"] ?? "");
$correta   = trim($_POST["correta"] ?? "");

if ($id == "" || $pergunta == "" || $resposta1 == "" || $resposta2 == "" || $resposta3 == "") {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!in_array($correta, ["1", "2", "3"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "A resposta correta deve ser 1, 2 ou 3."], JSON_UNESCAPED_UNICODE);
    exit;
}

$linhas = file("perguntas.txt");
foreach ($linhas as $linha) {
    $dados = explode(";", trim($linha));
    if ($dados[0] == $id) {
        echo json_encode(["sucesso" => false, "mensagem" => "Já existe uma pergunta com o id $id."], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$conteudo = file_get_contents("perguntas.txt");

$arquivo = fopen("perguntas.txt", "a");

if ($conteudo != "" && substr($conteudo, -1) != "\n") {
    fwrite($arquivo, "\n");
}

$novaLinha = $id . ";" .
             $pergunta . ";" .
             $resposta1 . ";" .
             $resposta2 . ";" .
             $resposta3 . ";" .
             $correta . "\n";

fwrite($arquivo, $novaLinha);
fclose($arquivo);

echo json_encode(["sucesso" => true, "mensagem" => "Pergunta criada com sucesso!"], JSON_UNESCAPED_UNICODE);
?>
