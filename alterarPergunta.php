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

if ($pergunta == "" || $resposta1 == "" || $resposta2 == "" || $resposta3 == "") {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!in_array($correta, ["1", "2", "3"])) {
    echo json_encode(["sucesso" => false, "mensagem" => "A resposta correta deve ser 1, 2 ou 3."], JSON_UNESCAPED_UNICODE);
    exit;
}

$linhas = file("perguntas.txt");

$arquivo = fopen("perguntas.txt", "w");

$encontrou = false;

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if ($dados[0] == $id) {

        $novaLinha = $id . ";" .
                     $pergunta . ";" .
                     $resposta1 . ";" .
                     $resposta2 . ";" .
                     $resposta3 . ";" .
                     $correta . "\n";

        fwrite($arquivo, $novaLinha);
        $encontrou = true;

    } else {

        fwrite($arquivo, $linha);
    }
}

fclose($arquivo);

if ($encontrou) {
    echo json_encode(["sucesso" => true, "mensagem" => "Pergunta alterada com sucesso!"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Pergunta não encontrada."], JSON_UNESCAPED_UNICODE);
}
?>
