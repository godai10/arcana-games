<?php
include('conexao.php');

// Monta a query SQL dinamicamente. O implode ajuda a tratar o array de plataformas para o formato IN do SQL.
// A lógica separa 'Indie' dos demais para evitar que jogos indie apareçam nas seções de consoles principais.
function buscarJogos($mysqli, $plataformas, $midia, $categoria = 'AAA') {
    $plats_sql = "'" . implode("','", $plataformas) . "'";
    
    $sql = "SELECT * FROM jogos WHERE plataforma IN ($plats_sql)";
    
    if($midia != 'Qualquer') {
        $sql .= " AND tipo_midia = '$midia'";
    }
    
    if($categoria == 'Indie') {
        $sql .= " AND categoria = 'Indie'";
    } else {
        $sql .= " AND categoria != 'Indie'";
    }
    
    return $mysqli->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jogos - Arcana Games</title>

    <link rel="stylesheet" href="./css/card.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <script src="./js/script.js" defer></script>
    
    <script src="./js/inicio.js" defer></script>
  </head>

  <body>

    <?php include('header.php'); ?>

    <div class="container-central">

      <section class="home-container" id="home">
        <div class="content">

          <div class="navegacao-secoes">
            <a href="#ps-fisica" class="btn">PS Física</a>
            <a href="#ps-digital" class="btn">PS Digital</a>
            <a href="#xbox-fisica" class="btn">Xbox Física</a>
            <a href="#xbox-digital" class="btn">Xbox Digital</a>
            <a href="#nintendo" class="btn">Nintendo</a>
            <a href="#indie" class="btn">Indie Games</a>
          </div>

          <style>
          .navegacao-secoes { display: flex; flex-wrap: wrap; gap: 15px; justify-content: center; margin-bottom: 40px; }
          .navegacao-secoes .btn { background: linear-gradient(90deg, var(--blue), var(--cyan)); padding: 12px 22px; border-radius: 10px; font-weight: bold; font-size: 1rem; color: #fff; box-shadow: 0 0 12px var(--blue); border: none; cursor: pointer; text-decoration: none; }
          .navegacao-secoes .btn:hover { transform: scale(1.05); box-shadow: 0 0 20px var(--cyan); }
          </style>

          <section class="banner-slider">
            <div class="slider-container glass-effect">
                
                <button class="arrow left" onclick="moveSlide(-1)">❮</button>

                <div class="slides">
                    <?php
                    // Verifica se existem banners cadastrados antes de renderizar para evitar erros visuais
                    $sql_banner = "SELECT * FROM jogos WHERE banner IS NOT NULL";
                    $query_banner = $mysqli->query($sql_banner);
                    $total_slides = $query_banner->num_rows;
                    $contador = 0;

                    if($total_slides == 0) { echo ""; }

                    while($banner = $query_banner->fetch_assoc()) {
                    ?>
                        <div class="slide">
                            <a href="detalhe.php?id=<?php echo $banner['id']; ?>">
                                <img src="<?php echo $banner['banner']; ?>" alt="<?php echo $banner['titulo']; ?>">
                            </a>
                        </div>
                    <?php 
                        $contador++;
                    } 
                    ?>
                </div>

                <button class="arrow right" onclick="moveSlide(1)">❯</button>
            </div>

            <div class="dots">
                <?php for($i = 0; $i < $total_slides; $i++): ?>
                    <span class="dot <?php echo ($i == 0) ? 'active' : ''; ?>" onclick="setSlide(<?php echo $i; ?>)"></span>
                <?php endfor; ?>
            </div>
            
            <h1>Destaques da Loja</h1>
          </section>

        </div>
      </section>


      <section class="secao-jogos" id="ps-fisica">
        <div class="titulo-diagonal"><h2>Jogos PlayStation - Mídia Física</h2></div>
        <div class="grid-cards">
          <?php
            $query = buscarJogos($mysqli, ['PS4', 'PS5'], 'Física');
            while($jogo = $query->fetch_assoc()) {
          ?>
          <div class="card">
            <div class="etiqueta">-10%</div>
            <img src="<?php echo $jogo['imagem']; ?>">
            <h2><?php echo $jogo['titulo']; ?></h2>
            <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
            <p class="description">Mídia <?php echo $jogo['tipo_midia']; ?> - <?php echo $jogo['plataforma']; ?></p>
            
            <a href="detalhe.php?id=<?php echo $jogo['id']; ?>"><button class="buy-btn">Comprar</button></a>
          </div>
          <?php } ?>
        </div>
      </section>


      <section class="secao-jogos" id="ps-digital">
        <div class="titulo-diagonal"><h2>Jogos PlayStation - Mídia Digital</h2></div>
        <div class="grid-cards">
          <?php
            $query = buscarJogos($mysqli, ['PS4', 'PS5'], 'Digital');
            while($jogo = $query->fetch_assoc()) {
          ?>
          <div class="card">
            <img src="<?php echo $jogo['imagem']; ?>">
            <h2><?php echo $jogo['titulo']; ?></h2>
            <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
            <p class="description">Mídia Digital - <?php echo $jogo['plataforma']; ?></p>
            <a href="detalhe.php?id=<?php echo $jogo['id']; ?>"><button class="buy-btn">Comprar</button></a>
          </div>
          <?php } ?>
        </div>
      </section>


      <section class="secao-jogos" id="xbox-fisica">
        <div class="titulo-diagonal"><h2>Jogos Xbox - Mídia Física</h2></div>
        <div class="grid-cards">
          <?php
            $query = buscarJogos($mysqli, ['Xbox One', 'Xbox Series'], 'Física');
            while($jogo = $query->fetch_assoc()) {
          ?>
          <div class="card">
            <img src="<?php echo $jogo['imagem']; ?>">
            <h2><?php echo $jogo['titulo']; ?></h2>
            <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
            <p class="description">Mídia Física - <?php echo $jogo['plataforma']; ?></p>
            <a href="detalhe.php?id=<?php echo $jogo['id']; ?>"><button class="buy-btn">Comprar</button></a>
          </div>
          <?php } ?>
        </div>
      </section>


      <section class="secao-jogos" id="xbox-digital">
        <div class="titulo-diagonal"><h2>Jogos Xbox - Mídia Digital</h2></div>
        <div class="grid-cards">
          <?php
            $query = buscarJogos($mysqli, ['Xbox One', 'Xbox Series', 'Xbox 360'], 'Digital');
            while($jogo = $query->fetch_assoc()) {
          ?>
          <div class="card">
            <img src="<?php echo $jogo['imagem']; ?>">
            <h2><?php echo $jogo['titulo']; ?></h2>
            <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
            <p class="description">Mídia Digital - <?php echo $jogo['plataforma']; ?></p>
            <a href="detalhe.php?id=<?php echo $jogo['id']; ?>"><button class="buy-btn">Comprar</button></a>
          </div>
          <?php } ?>
        </div>
      </section>


      <section class="secao-jogos" id="nintendo">
        <div class="titulo-diagonal"><h2>Jogos Nintendo Switch</h2></div>
        <div class="grid-cards">
          <?php
            $query = buscarJogos($mysqli, ['Switch'], 'Qualquer');
            while($jogo = $query->fetch_assoc()) {
          ?>
          <div class="card">
            <img src="<?php echo $jogo['imagem']; ?>">
            <h2><?php echo $jogo['titulo']; ?></h2>
            <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
            <p class="description"><?php echo $jogo['tipo_midia']; ?> - Switch</p>
            <a href="detalhe.php?id=<?php echo $jogo['id']; ?>"><button class="buy-btn">Comprar</button></a>
          </div>
          <?php } ?>
        </div>
      </section>


      <section class="secao-jogos" id="indie">
        <div class="titulo-diagonal"><h2>Jogos Independentes - Mídia Digital</h2></div>
        <div class="grid-cards">
          <?php
            // Query direta para contornar a filtragem de plataforma, focando apenas na categoria Indie
            $sql = "SELECT * FROM jogos WHERE categoria = 'Indie'";
            $query = $mysqli->query($sql);
            
            while($jogo = $query->fetch_assoc()) {
          ?>
          <div class="card">
            <img src="<?php echo $jogo['imagem']; ?>">
            <h2><?php echo $jogo['titulo']; ?></h2>
            <p class="price">R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></p>
            <p class="description"><?php echo $jogo['tipo_midia']; ?> - <?php echo $jogo['plataforma']; ?></p>
            <a href="detalhe.php?id=<?php echo $jogo['id']; ?>"><button class="buy-btn">Comprar</button></a>
          </div>
          <?php } ?>
        </div>
      </section>

      <div style="text-align:center; margin-top:50px; padding:20px; color:#ccc; font-family:'Cinzel', serif;">
        <h3>Loja em expansão. Logo teremos mais jogos :)</h3>
        <p>Fique ligado nas novidades!</p>
      </div>

    </div>

    <?php include('footer.php'); ?>

  </body>
</html>