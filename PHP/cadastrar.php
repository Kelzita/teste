<?php
// Configurações do banco
$host = "localhost";
$usuario = "root";
$senha = "123456";
$banco = "chronipedia";

// Conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebe os dados
$email = $_POST['email'];
$username = $_POST['username'];
$senha_bruta = $_POST['senha'];
$data_nascimento = $_POST['data-nascimento'];
$genero = $_POST['genero'];
$senha_hash = password_hash($senha_bruta, PASSWORD_DEFAULT);

// Prepara a query com os novos campos
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha_hash, username, data_nascimento, genero) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $username, $email, $senha_hash, $username, $data_nascimento, $genero);

// Executa e responde
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
