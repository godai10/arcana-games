<?php 
include('conexao.php'); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca - Arcana Games</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/card.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    
    <?php include('header.php'); ?>

    <div class="container-central" style="padding: 50px;">
        <h2 style="color:white; margin-bottom:30px;">Resultados para: "<?php echo htmlspecialchars($_GET['q']); ?>"</h2>

        <section class="cards-container">
            <?php
            if(isset($_GET['q'])) {
                // Previne SQL Injection antes de inserir a variável na consulta
                $busca = $mysqli->real_escape_string($_GET['q']);
                
                // O operador LIKE com % permite encontrar resultados que contenham o termo em qualquer parte do texto
                $sql = "SELECT * FROM jogos WHERE titulo LIKE '%$busca%' OR descricao LIKE '%$busca%'";
                $query = $mysqli->query($sql);

                if($query->num_rows == 0) {
                    echo "<p style='color:#ccc; font-size:1.2rem;'>Nenhum jogo encontrado.</p>";
                } else {
                    while($jogo = $query->fetch_assoc()) {
            ?>
                <div class="card">
                    <div class="etiqueta">-10%</div>
                    <img src="<?php echo $jogo['imagem']; ?>" alt="<?php echo $jogo['titulo']; ?>">
                    <h2><?php echo $jogo['titulo']; ?></h2>
                    <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
                    <p class="description"><?php echo $jogo['plataforma']; ?></p>
                    <a href="detalhe.php?id=<?php echo $jogo['id']; ?>">
                        <button class="buy-btn neon-border">Ver Detalhes</button>
                    </a>
                </div>
            <?php 
                    }
                }
            }
            ?>
        </section>
    </div>

<?php include('footer.php'); ?>

</body>
</html>