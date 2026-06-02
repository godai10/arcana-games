<?php
session_start();

// Bloqueia a adição ao carrinho se o usuário não estiver logado, redirecionando via JS
if(!isset($_SESSION['id'])) {
    echo "<script>
            alert('Faça login para comprar!'); 
            window.location.href='login.php';
          </script>";
    exit;
}

if(isset($_POST['id_jogo'])) {
    $id = intval($_POST['id_jogo']);
    
    // Inicializa o array de sessão do carrinho caso seja a primeira inserção
    if(!isset($_SESSION['carrinho'])) { 
        $_SESSION['carrinho'] = array(); 
    }
    
    // Adiciona o novo ID do jogo ao final do array
    $_SESSION['carrinho'][] = $id;
}

// Verifica o valor do input 'redirect' para definir o fluxo:
// Se veio do botão "Comprar Agora", vai direto para o pagamento. Caso contrário, exibe o carrinho.
if(isset($_POST['redirect']) && $_POST['redirect'] == 'pagamento') {
    header("Location: pagamento.php");
} else {
    header("Location: carrinho.php");
}
?>