<?php
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["sucesso" => false, "mensagem" => "Use POST."], JSON_UNESCAPED_UNICODE);
    exit;
}

$nome  = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = trim($_POST["senha"] ?? "");

if ($nome == "" || $email == "" || $senha == "") {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos."], JSON_UNESCAPED_UNICODE);
    exit;
}

$linhas = file("usuarios.txt");
foreach ($linhas as $linha) {
    $dados = explode(";", trim($linha));
    if (isset($dados[1]) && $dados[1] == $email) {
        echo json_encode(["sucesso" => false, "mensagem" => "Este e-mail já está cadastrado."], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$conteudo = file_get_contents("usuarios.txt");

$arquivo = fopen("usuarios.txt", "a");

if ($conteudo != "" && substr($conteudo, -1) != "\n") {
    fwrite($arquivo, "\n");
}

$novaLinha = $nome . ";" .
             $email . ";" .
             $senha . "\n";

fwrite($arquivo, $novaLinha);
fclose($arquivo);

echo json_encode(["sucesso" => true, "mensagem" => "Usuário cadastrado com sucesso!"], JSON_UNESCAPED_UNICODE);
?>
