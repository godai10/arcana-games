<?php
session_start(); // Inicia a sessão
include('conexao.php'); // Conecta ao banco

// Verifica se veio do formulário de pagamento
if(isset($_POST['cpf'])) {
    
    // Pega os dados do post e limpa
    $nome = $mysqli->real_escape_string($_POST['nome_cartao']); 
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $cep = $mysqli->real_escape_string($_POST['cep']);
    $endereco = $mysqli->real_escape_string($_POST['endereco']);
    
    // Calcula o total real direto do banco
    $total = 0;
    if(isset($_SESSION['carrinho'])) {
        $ids = implode(',', $_SESSION['carrinho']);
        $sql_total = "SELECT sum(preco) as total FROM jogos WHERE id IN ($ids)";
        $query_total = $mysqli->query($sql_total);
        $row = $query_total->fetch_assoc();
        $total = $row['total'];
    }

    // Salva o pedido na tabela
    $sql_insert = "INSERT INTO pedidos (cliente_nome, cpf, endereco, cep, valor_total) VALUES ('$nome', '$cpf', '$endereco', '$cep', '$total')";
    $mysqli->query($sql_insert);
}

// Esvazia o carrinho após a compra
unset($_SESSION['carrinho']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Compra Realizada!</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="./css/shop.css">
    <style>
        /* Estilo da caixa de sucesso */
        .success-box {
            text-align: center;
            padding: 50px;
            max-width: 600px;
            margin: 100px auto;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px var(--blue);
        }
        .icon-check { font-size: 5rem; margin-bottom: 20px; display: block; }
    </style>
</head>
<body>
    
    <?php include('header.php'); ?> <!-- Cabeçalho -->

    <div class="success-box">
        <span class="icon-check">✅</span>
        <h1 class="neon-text">Pagamento Aprovado!</h1>
        <p style="font-size:1.2rem; margin-top:20px; color:#ccc;">
            Obrigado, <strong><?php echo isset($nome) ? $nome : 'Gamer'; ?></strong>!<br>
            Seu pedido foi registrado com sucesso no sistema.
        </p>
        
        <!-- Botão para voltar -->
        <a href="index.php" class="btn neon-btn" style="display:inline-block; margin-top:30px; text-decoration:none;">
            Voltar para a Loja
        </a>
    </div>

    <?php include('footer.php'); ?> <!-- Rodapé -->

</body>
</html>