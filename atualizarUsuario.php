<?php
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["sucesso" => false, "mensagem" => "Use POST."], JSON_UNESCAPED_UNICODE);
    exit;
}

$emailAntigo = trim($_POST["emailAntigo"] ?? "");
$nome        = trim($_POST["nome"] ?? "");
$email       = trim($_POST["email"] ?? "");
$senha       = trim($_POST["senha"] ?? "");

if ($nome == "" || $email == "" || $senha == "") {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."], JSON_UNESCAPED_UNICODE);
    exit;
}

$linhas = file("usuarios.txt");

if ($email != $emailAntigo) {
    foreach ($linhas as $linha) {
        $dados = explode(";", trim($linha));
        if (isset($dados[1]) && $dados[1] == $email) {
            echo json_encode(["sucesso" => false, "mensagem" => "Este e-mail já está cadastrado."], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}

$arquivo = fopen("usuarios.txt", "w");

$encontrou = false;

foreach ($linhas as $linha) {

    $dados = explode(";", trim($linha));

    if (isset($dados[1]) && $dados[1] == $emailAntigo) {

        $novaLinha = $nome . ";" .
                     $email . ";" .
                     $senha . "\n";

        fwrite($arquivo, $novaLinha);
        $encontrou = true;

    } else {

        fwrite($arquivo, $linha);
    }
}

fclose($arquivo);

if ($encontrou) {
    echo json_encode(["sucesso" => true, "mensagem" => "Usuário atualizado com sucesso!"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
}
?>
