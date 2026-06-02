<?php
session_start();

// Verifica se o usuário está autenticado antes de carregar a página
if(!isset($_SESSION['id'])) {
    header("Location: login.php"); 
    exit;
}

// Impede acesso direto à página se não houver itens no carrinho
if(empty($_SESSION['carrinho'])) {
    header("Location: index.php"); 
    exit;
}

include('conexao.php');

$itens = [];
$total = 0;

// Recupera os produtos adicionados na sessão para exibir o resumo
if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    
    // Agrupa itens iguais para contar a quantidade (ex: 2x FIFA 23)
    $contagem = array_count_values($_SESSION['carrinho']);
    $ids = implode(',', array_keys($contagem));
    
    // Busca apenas os jogos que estão no carrinho
    $sql = "SELECT * FROM jogos WHERE id IN ($ids)";
    $query = $mysqli->query($sql);
    
    // Monta o array final com dados do jogo + quantidade calculada
    while($row = $query->fetch_assoc()) {
        $row['qtd'] = $contagem[$row['id']];
        $itens[] = $row;
        $total += ($row['preco'] * $row['qtd']); // Somatório do valor total
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - ArcanaGames</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/shop.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>

    <!-- Inclui o cabeçalho padrão do sistema -->
    <?php include('header.php'); ?>

    <div class="container-central">
        <h2 class="page-title">Finalizar Pedido 🔒</h2>

        <div class="checkout-grid">
            
            <!-- Área de resumo do pedido (gerada dinamicamente) -->
            <div class="cart-summary glass-panel">
                <h3>Resumo do Pedido</h3>
                
                <?php if(count($itens) > 0): ?>
                    <?php foreach($itens as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>">
                        <div class="item-details">
                            <h4><?php echo $item['titulo']; ?></h4>
                            <p><?php echo $item['plataforma']; ?> - <?php echo $item['tipo_midia']; ?></p>
                            <span class="item-price">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></span>
                        </div>
                        <div class="item-qty">
                            <span>x<?php echo $item['qtd']; ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color:#ccc; padding:20px;">Seu carrinho está vazio.</p>
                <?php endif; ?>

                <div class="cart-total">
                    <div class="row">
                        <span>Subtotal</span>
                        <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </div>
                    <div class="row">
                        <span>Frete</span>
                        <span>Grátis</span>
                    </div>
                    <div class="row total">
                        <span>TOTAL</span>
                        <span class="neon-text">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Formulário de checkout -->
            <div class="payment-details glass-panel">
                <h3>Dados de Pagamento</h3>
                
                <!-- Envia os dados para processamento e registro no banco -->
                <form class="payment-form" action="sucesso.php" method="POST">
                    <label>CEP</label>
                    <input type="text" name="cep" placeholder="00000-000" maxlength="9" required>
                    
                    <label>Endereço</label>
                    <input type="text" name="endereco" required>

                    <hr style="border-color:rgba(255,255,255,0.1); margin:20px 0;">

                    <label>Nome no Cartão</label>
                    <input type="text" name="nome_cartao" required>

                    <label>Número do Cartão</label>
                    <input type="text" name="num_cartao" placeholder="0000 0000 0000 0000" maxlength="19" required>

                    <div class="form-row">
                        <div>
                            <label>Validade</label>
                            <input type="text" name="validade" placeholder="MM/AA" maxlength="5" required>
                        </div>
                        <div>
                            <label>CVV</label>
                            <input type="text" name="cvv" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                    <label>CPF do Titular</label>
                    <input type="text" name="cpf" placeholder="000.000.000-00" maxlength="14" required>

                    <button type="submit" class="btn-checkout neon-btn">FINALIZAR PEDIDO</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Rodapé global -->
    <?php include('footer.php'); ?>

</body>
</html>