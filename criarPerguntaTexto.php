<?php
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["sucesso" => false, "mensagem" => "Use POST."], JSON_UNESCAPED_UNICODE);
    exit;
}

$id       = trim($_POST["id"] ?? "");
$pergunta = trim($_POST["pergunta"] ?? "");
$resposta = trim($_POST["resposta"] ?? "");

if ($id == "" || $pergunta == "" || $resposta == "") {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."], JSON_UNESCAPED_UNICODE);
    exit;
}

$linhas = file("perguntasTexto.txt");
foreach ($linhas as $linha) {
    $dados = explode(";", trim($linha));
    if ($dados[0] == $id) {
        echo json_encode(["sucesso" => false, "mensagem" => "Já existe uma pergunta com o id $id."], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$conteudo = file_get_contents("perguntasTexto.txt");

$arquivo = fopen("perguntasTexto.txt", "a");

if ($conteudo != "" && substr($conteudo, -1) != "\n") {
    fwrite($arquivo, "\n");
}

$novaLinha = $id . ";" . $pergunta . ";" . $resposta . "\n";

fwrite($arquivo, $novaLinha);
fclose($arquivo);

echo json_encode(["sucesso" => true, "mensagem" => "Pergunta criada com sucesso!"], JSON_UNESCAPED_UNICODE);
?>
