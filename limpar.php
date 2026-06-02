<?php
// Inicia a sessão para conseguir acessar os dados do usuário
session_start();

// Remove apenas a variável do carrinho da sessão, limpando os itens
unset($_SESSION['carrinho']);

// Redireciona de volta para a página do carrinho (agora vazia)
header("Location: carrinho.php");
?>