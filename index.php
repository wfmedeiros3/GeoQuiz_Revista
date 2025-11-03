<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Início</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }
        .admin-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <button onclick="window.location.href='quiz.php'">Iniciar Quiz</button>
    <!-- Botão de Administração -->
    <button class="admin-button" onclick="window.location.href='admin.php'">Administração</button>
</body>
</html>
