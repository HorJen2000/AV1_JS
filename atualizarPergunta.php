<?php
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["sucesso" => false, "mensagem" => "Use POST."], JSON_UNESCAPED_UNICODE);
    exit;
}

$id       = trim($_POST["id"] ?? "");
$pergunta = trim($_POST["pergunta"] ?? "");
$resposta = trim($_POST["resposta"] ?? "");

if ($pergunta == "" || $resposta == "") {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."], JSON_UNESCAPED_UNICODE);
    exit;
}

$linhas = file("perguntasTexto.txt");

$arquivo = fopen("perguntasTexto.txt", "w");

$encontrou = false;

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if ($dados[0] == $id) {

        $novaLinha = $id . ";" . $pergunta . ";" . $resposta . "\n";

        fwrite($arquivo, $novaLinha);
        $encontrou = true;

    } else {

        fwrite($arquivo, $linha);
    }
}

fclose($arquivo);

if ($encontrou) {
    echo json_encode(["sucesso" => true, "mensagem" => "Pergunta atualizada com sucesso!"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Pergunta não encontrada."], JSON_UNESCAPED_UNICODE);
}
?>
