<?php
session_start();
include('conexao.php');

$itens = array();
$total = 0;

// Verifica a existência do carrinho na sessão e constrói a query SQL
if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    
    // O implode transforma o array de IDs em uma string (ex: "1,2,5") para usar na cláusula IN do SQL
    $ids = implode(',', $_SESSION['carrinho']);
    
    $sql = "SELECT * FROM jogos WHERE id IN ($ids)";
    $query = $mysqli->query($sql);
    
    // Itera sobre os resultados para exibir na tabela e calcular o total
    while($row = $query->fetch_assoc()) {
        $itens[] = $row;
        $total += $row['preco'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - Arcana Games</title>
    
    <link rel="stylesheet" href="./css/sim.css">
    <link rel="stylesheet" href="./css/style.css"> 
    <link rel="shortcut icon" href="./img/Persona.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>

    <?php include('header.php'); ?>

    <div class="container">
        <h2>Seu Carrinho</h2>
        
        <?php if(count($itens) > 0): ?>
            
            <table id="cart">
                <tr>
                    <th>Jogo</th>
                    <th>Preço</th>
                    <th>Qtd</th>
                </tr>
                
                <?php foreach($itens as $item): ?>
                <tr>
                    <td style="display:flex; align-items:center; gap:10px; justify-content:center;">
                        <img src="<?php echo $item['imagem']; ?>" width="50" style="border-radius:5px;"> 
                        <?php echo $item['titulo']; ?>
                    </td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td>1</td>
                </tr>
                <?php endforeach; ?>
            </table>

            <div class="total">
                <strong>Total: R$ <span id="total" style="color: #4cd9ff;"><?php echo number_format($total, 2, ',', '.'); ?></span></strong>
            </div>

            <a href="pagamento.php" style="text-decoration:none;">
                <button class="checkout-btn">Ir para Pagamento</button>
            </a>
            
            <br><br>
            <a href="limpar.php" style="color:red; display:block; text-align:center;">Esvaziar Carrinho</a>

        <?php else: ?>
            
            <div class="empty" id="empty-message" style="display:block;">
                Sem jogos aqui irmão 
                <br>o senhor precisa comprar
            </div>
            
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>