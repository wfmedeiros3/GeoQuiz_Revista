<?php
// Iniciar a sessão
session_start();
// Exibir a pontuação
if (isset($_SESSION['pontuacao'])) {
    echo "<h2>Sua pontuação: {$_SESSION['pontuacao']} pontos</h2>";
} else {
    echo "<h2>Não há pontuação disponível.</h2>";
}
// Limpar a sessão
unset($_SESSION['pontuacao']);
?>
