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
// Iniciar a sessão para armazenar as respostas do usuário
session_start();
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar a resposta do usuário e avançar para a próxima pergunta
    $pergunta_atual = $_POST['pergunta_atual'];
    $resposta_usuario = $_POST['resposta_usuario'];
    // Armazenar a resposta na sessão
    $_SESSION['respostas'][$pergunta_atual] = $resposta_usuario;
    // Redirecionar para a próxima pergunta
    header("Location: quiz.php?pergunta_atual=" . ($pergunta_atual + 1));
    exit();
}
// Obter o número da pergunta atual
$pergunta_atual = isset($_GET['pergunta_atual']) ? intval($_GET['pergunta_atual']) : 1;
// Obter a pergunta do banco de dados
$sql = "SELECT * FROM perguntas WHERE id = $pergunta_atual";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }
            form {
                text-align: center;
            }
            button {
                margin: 10px 0;
                padding: 15px 30px;
                font-size: 18px;
                background-color: #3498db;
                color: #fff;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                display: block;
                width: 100%;
            }
          </style>";
    echo "<form method='post' action='quiz.php'>";
    echo "<h3>{$row['pergunta']}</h3>";
    for ($i = 1; $i <= 4; $i++) {
        echo "<button type='submit' name='resposta_usuario' value='$i'>{$row["opcao$i"]}</button>";
    }
    echo "<input type='hidden' name='pergunta_atual' value='$pergunta_atual'>";
    echo "</form>";
    // Exibir imagem se estiver presente
    if (!empty($row['imagem'])) {
        echo "<img src='imagens/{$row['imagem']}' alt='Imagem da pergunta'>";
    }
} else {
    // Exibir pontuação final e limpar a sessão
    $pontuacao = calcularPontuacao($_SESSION['respostas']);
    echo "<h2>Sua pontuação final: $pontuacao pontos</h2>";
    unset($_SESSION['respostas']);
}
// Função para calcular a pontuação total
function calcularPontuacao($respostas)
{
    $pontuacao = 0;
    foreach ($respostas as $pergunta_id => $resposta) {
        $sql = "SELECT resposta FROM perguntas WHERE id = $pergunta_id";
        $result = $GLOBALS['conn']->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($resposta == $row['resposta']) {
                $pontuacao++;
            }
        }
    }
    return $pontuacao;
}
$conn->close();
?>
