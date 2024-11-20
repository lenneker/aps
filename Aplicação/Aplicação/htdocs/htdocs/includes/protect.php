<?php
// Inicia a sessão se ainda não estiver iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION["username"])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: ../../index.php');
    exit(); 
}

// Verifica se o usuário é um administrador
if (isset($_SESSION["user_type"]) && strtolower($_SESSION["user_type"]) === 'admin') {
    // Se for um administrador, redireciona para a área do administrador
    header('Location: ../../admin-area/admin-home.php');
    exit();
}

// Aqui você pode adicionar o restante do código para a área de usuário normal
?>
