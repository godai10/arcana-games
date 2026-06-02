<?php include('conexao.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArcanaGames</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="./js/inicio.js" defer></script>
</head>
<body>

   <?php include('header.php'); ?>

    <section class="home-container">
        <div class="content fade-in">
            <h2>Você acaba de entrar no universo dos games —<br> 
                bem-vindo à <span>Arcana Games!</span>
            </h2>
            <h3>Os melhores jogos, lançamentos e promoções imperdíveis</h3>
            <p>A Arcana Games é a sua central definitiva de jogos. Aqui você descobre novidades, encontra preços especiais e garante seus títulos favoritos de forma rápida e segura.</p>
            <a href="#menu" class="btn neon-btn">Compre Agora</a>
        </div>
    </section>

    <section class="banner-slider">
        <div class="slider-container glass-effect">
            
            <button class="arrow left" onclick="moveSlide(-1)">❮</button>

            <div class="slides">
                <?php
                // Filtra apenas os jogos que possuem banner promocional configurado no banco
                $sql_banner = "SELECT * FROM jogos WHERE banner IS NOT NULL";
                $query_banner = $mysqli->query($sql_banner);
                $total_slides = $query_banner->num_rows;
                
                if($total_slides == 0) { echo ""; }

                // Renderização dinâmica dos slides
                while($banner = $query_banner->fetch_assoc()) {
                ?>
                    <div class="slide">
                        <a href="detalhe.php?id=<?php echo $banner['id']; ?>">
                            <img src="<?php echo $banner['banner']; ?>" alt="<?php echo $banner['titulo']; ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>

            <button class="arrow right" onclick="moveSlide(1)">❯</button>
        </div>

        <div class="dots">
            <?php 
            // Gera os indicadores de navegação dinamicamente baseado na contagem do SQL
            for($i = 0; $i < $total_slides; $i++): 
            ?>
                <span class="dot <?php echo ($i == 0) ? 'active' : ''; ?>" onclick="setSlide(<?php echo $i; ?>)"></span>
            <?php endfor; ?>
        </div>
        
        <h1>Jogos mais Vendidos</h1>
    </section>


    <section class="cards-container" id="menu">
        <?php
        // Consulta geral para popular o grid de produtos da loja
        $sql = "SELECT * FROM jogos";
        $query = $mysqli->query($sql);

        while($jogo = $query->fetch_assoc()) {
        ?>
            <div class="card">
                <a href="detalhe.php?id=<?php echo $jogo['id']; ?>" style="color:inherit;">
                    <div class="etiqueta">-10%</div>
                    <img src="<?php echo $jogo['imagem']; ?>" alt="<?php echo $jogo['titulo']; ?>">
                    <h2><?php echo $jogo['titulo']; ?></h2>
                    <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
                    <p class="description">Mídia <?php echo $jogo['tipo_midia']; ?> - <?php echo $jogo['plataforma']; ?></p>
                    <button class="buy-btn neon-border">Ver Detalhes</button>
                </a>
            </div>
        <?php } ?>
    </section>

<?php include('footer.php'); ?>

</body>
</html>