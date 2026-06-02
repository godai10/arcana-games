<?php
// Recupera a sessão atual para que possamos encerrá-la corretamente
session_start();

// Destrói todos os dados da sessão (isso efetua o logout e também limpa o carrinho)
session_destroy(); 

// Redireciona o usuário de volta para a página inicial
header("Location: index.php");
exit; // Garante que o código pare de rodar aqui
?>