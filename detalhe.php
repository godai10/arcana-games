<?php
include('conexao.php');

// Validação de segurança: garante que o ID seja numérico e busca os dados do jogo.
// Caso o ID não exista ou a busca retorne vazio, redireciona para a home.
if(isset($_GET['id'])) {
    $id_jogo = intval($_GET['id']);
    
    $sql_code = "SELECT * FROM jogos WHERE id = '$id_jogo'";
    $sql_query = $mysqli->query($sql_code) or die("Erro SQL: " . $mysqli->error);
    
    $jogo = $sql_query->fetch_assoc();
    
    if(!$jogo) {
        header("Location: index.php");
        die();
    }
} else {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $jogo['titulo']; ?> - ArcanaGames</title>
    
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="./css/shop.css"> 
</head>
<body>

    <?php include('header.php'); ?>

    <div class="container-central">
        <div class="detalhe-wrapper">
            
            <div class="detalhe-img-box hologram">
                <img src="<?php echo $jogo['imagem']; ?>" alt="<?php echo $jogo['titulo']; ?>">
                <div class="tag-plataforma"><?php echo $jogo['plataforma']; ?></div>
            </div>

            <div class="detalhe-info">
                <h1 class="neon-text"><?php echo $jogo['titulo']; ?></h1>
                
                <div class="info-grid">
                    <span><strong>Mídia:</strong> <?php echo $jogo['tipo_midia']; ?></span>
                    <span><strong>Desenvolvedora:</strong> <?php echo $jogo['desenvolvedora']; ?></span>
                    <span><strong>Lançamento:</strong> --</span> 
                </div>

                <p class="descricao">
                    <?php echo $jogo['descricao']; ?>
                </p>

                <div class="price-box">
                    <span class="current-price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></span>
                </div>

                <div class="actions">
                    <form action="carrinho_add.php" method="POST" style="width:100%; display:flex; gap:20px;">
                        <input type="hidden" name="id_jogo" value="<?php echo $jogo['id']; ?>">
                                                
                        <button type="submit" name="redirect" value="pagamento" class="btn-buy neon-btn">
                            Comprar Agora
                        </button>
                                                
                        <button type="submit" name="redirect" value="carrinho" class="btn-cart">
                            Adicionar ao Carrinho 🛒
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>

</body>
</html>