<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ArcamaGames - Contato</title>

    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/contato.css" /> 
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    <script src="./js/script.js" defer></script>
  </head>

  <body>
    <?php include('header.php'); ?>

    <section class="contato-container">
      <div class="contato-header">
        <h2>Fale Conosco 💬</h2>
        <p>Tire suas dúvidas, faça sugestões ou converse com nossa equipe de suporte!</p>
      </div>

      <div class="contato-info-cards">
        <div class="contato-card">
          <i class="fas fa-phone-alt"></i> <h3>Telefone de Suporte</h3>
          <p class="contato-detail">(11) 99999-9999</p>
          <p class="contato-obs">Atendimento das 9h às 18h (Seg-Sex)</p>
        </div>

        <div class="contato-card">
          <i class="fas fa-envelope"></i> <h3>E-mail para Contato</h3>
          <p class="contato-detail">arcanagames@gmail.com</p>
          <p class="contato-obs">Responderemos o mais breve possível!</p>
        </div>

        <div class="contato-card">
          <i class="fas fa-map-marker-alt"></i> <h3>Sobre nós</h3>
          <p class="contato-detail">Arcana Games é um e-commerce dedicado a jogos em mídia física e digital. A loja reúne variedade, preço justo e praticidade para quem busca novas aventuras no mundo dos games.</p>
          <p class="contato-obs">Arcana Games — onde cada jogo revela uma nova Arcana da sua jornada gamer</p>
        </div>
      </div>

      <div class="contato-form-area">
          <h3>Envie uma Mensagem Rápida</h3>
          <form class="contato-form">
              <input type="text" placeholder="Seu Nome" required>
              <input type="email" placeholder="Seu Email" required>
              <textarea placeholder="Sua Mensagem" rows="5" required></textarea>
              <button type="submit" class="btn-enviar">Enviar Mensagem</button>
          </form>
      </div>
    </section>

    <?php include('footer.php'); ?>
  </body>
</html>