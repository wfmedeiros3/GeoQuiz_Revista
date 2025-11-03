<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz";
// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
// Processar o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];
    $opcao1 = $_POST["opcao1"];
    $opcao2 = $_POST["opcao2"];
    $opcao3 = $_POST["opcao3"];
    $opcao4 = $_POST["opcao4"];
    // Processar o upload da imagem
    $imagem_nome = "";
    if ($_FILES["imagem"]["error"] == 0) {
        $imagem_nome = $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "imagens/" . $imagem_nome);
    }
    // Inserir a pergunta no banco de dados
    $sql = "INSERT INTO perguntas (pergunta, resposta, opcao1, opcao2, opcao3, opcao4, imagem) 
            VALUES ('$pergunta', '$resposta', '$opcao1', '$opcao2', '$opcao3', '$opcao4', '$imagem_nome')";
    if ($conn->query($sql) === TRUE) {
        echo "Pergunta adicionada com sucesso!";
    } else {
        echo "Erro ao adicionar pergunta: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
</head>
<body>
    <h2>Adicionar Pergunta</h2>
    <form method="post" action="admin.php" enctype="multipart/form-data">
        <label for="pergunta">Pergunta:</label>
        <input type="text" name="pergunta" required>
        <br>
        <label for="resposta">Resposta (Número da opção correta):</label>
        <input type="number" name="resposta" required>
        <br>
        <label for="opcao1">Opção 1:</label>
        <input type="text" name="opcao1" required>
        <br>
        <label for="opcao2">Opção 2:</label>
        <input type="text" name="opcao2" required>
        <br>
        <label for="opcao3">Opção 3:</label>
        <input type="text" name="opcao3" required>
        <br>
        <label for="opcao4">Opção 4:</label>
        <input type="text" name="opcao4" required>
        <br>
        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem">
        <br>
        <button type="submit">Adicionar Pergunta</button>
    </form>
</body>
</html>
