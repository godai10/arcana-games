document.addEventListener("DOMContentLoaded", () => {
  
  // --- Lógica de Tooltips para Botões de Compra ---
  const botoes = document.querySelectorAll(".buy-btn");

  botoes.forEach(botao => {
    botao.addEventListener("mouseenter", (e) => {
      // Navega pelo DOM para recuperar o título do jogo no contexto do card atual
      const nomeDoJogo = botao.closest(".card").querySelector("h2").textContent;

      const tooltip = document.createElement("span");
      tooltip.innerText = "Comprar " + nomeDoJogo;
      tooltip.classList.add("tooltip");

      // Cálculo de posicionamento dinâmico relativo ao viewport
      const rect = botao.getBoundingClientRect();
      tooltip.style.top = (rect.top - 35 + window.scrollY) + "px";
      tooltip.style.left = (rect.left + rect.width / 2) + "px";

      document.body.appendChild(tooltip);

      // Listener 'once' garante que o evento de remoção ocorra apenas uma vez por interação
      botao.addEventListener("mouseleave", () => {
        tooltip.remove();
      }, { once: true });
    });
  });


  // --- Lógica de Tooltips para Etiquetas de Desconto ---
  const etiquetas = document.querySelectorAll(".etiqueta");

  etiquetas.forEach(etiqueta => {
    etiqueta.addEventListener("mouseenter", () => {
      const card = etiqueta.closest(".card");
      const nomeJogo = card.querySelector("h2").innerText.trim();
      const valorDesconto = etiqueta.innerText.trim().replace("-", "");

      const tooltip = document.createElement("span");
      tooltip.innerText = `${valorDesconto} de desconto em ${nomeJogo}`;
      tooltip.classList.add("tooltip");

      // Ajuste de posição lateral para não sobrepor a etiqueta
      const rect = etiqueta.getBoundingClientRect();
      tooltip.style.top = (rect.top - 40 + window.scrollY) + "px";
      tooltip.style.left = (rect.left - 40) + "px";

      document.body.appendChild(tooltip);

      etiqueta.addEventListener("mouseleave", () => {
        tooltip.remove();
      }, { once: true });
    });
  });


  // ==========================================================
  // MÓDULO DO CARROSSEL (SLIDER)
  // ==========================================================

  const track = document.getElementById('track');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const thumbsContainer = document.getElementById('thumbs');

  // Verifica se o elemento track existe para evitar erros em páginas sem carrossel
  if (track) {

    let games = null;
    let index = 0;
    let autoPlayTimer = null;
    const AUTOPLAY_INTERVAL = 4000;

    // Dataset estático para fallback em caso de falha na requisição JSON
    const fallbackData = [
      { id: 1, title: 'Jogo 1', img: 'img/DemonslayerSlide.png' },
      { id: 2, title: 'Jogo 2', img: 'img/Forzahorizon5Slide.png' },
      { id: 3, title: 'Jogo 3', img: 'img/streetfighter6Slide.png' },
      { id: 4, title: 'Jogo 4', img: 'img/AssassinscreedSlide.png' }
    ];

    // Carregamento assíncrono dos dados
    async function loadData() {
      try {
        const r = await fetch('./games.json');
        if (!r.ok) throw new Error("JSON indisponível");
        return await r.json();
      } catch {
        console.warn("Usando dados de fallback para o slider.");
        return fallbackData;
      }
    }

    // Renderização dos slides e thumbnails
    function buildSlides(items) {
      track.innerHTML = '';
      thumbsContainer.innerHTML = '';

      items.forEach((g, i) => {
        // Criação dos elementos do slide
        const slide = document.createElement('div');
        slide.className = 'slide';

        const img = document.createElement('img');
        img.src = g.img;
        img.alt = g.title;
        slide.appendChild(img);
        track.appendChild(slide);

        // Criação dos indicadores (dots)
        const btn = document.createElement('button');
        btn.dataset.index = i;
        if (i === 0) btn.classList.add('active');
        
        btn.addEventListener('click', () => {
          goTo(parseInt(btn.dataset.index));
          resetAutoplay();
        });

        thumbsContainer.appendChild(btn);
      });

      index = 0;
      updateCarousel();
    }

    // Atualiza a posição do track usando transform CSS
    function updateCarousel() {
      const percent = index * 100;
      track.style.transform = `translateX(-${percent}%)`;

      // Atualiza classes ativas nos thumbnails
      [...thumbsContainer.children].forEach(btn => btn.classList.remove('active'));
      if (thumbsContainer.children[index]) {
        thumbsContainer.children[index].classList.add('active');
      }
    }

    function prev() {
      // Lógica circular para voltar do primeiro ao último
      index = (index - 1 + track.children.length) % track.children.length;
      updateCarousel();
    }

    function next() {
      // Lógica circular para ir do último ao primeiro
      index = (index + 1) % track.children.length;
      updateCarousel();
    }

    function goTo(i) {
      index = i % track.children.length;
      updateCarousel();
    }

    // Gerenciamento do Autoplay
    function startAutoplay() {
      stopAutoplay();
      autoPlayTimer = setInterval(() => next(), AUTOPLAY_INTERVAL);
    }

    function stopAutoplay() {
      if (autoPlayTimer) clearInterval(autoPlayTimer);
      autoPlayTimer = null;
    }

    function resetAutoplay() {
      stopAutoplay();
      startAutoplay();
    }

    // Navegação via teclado (Acessibilidade)
    function bindKeyboard() {
      window.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") { prev(); resetAutoplay(); }
        if (e.key === "ArrowRight") { next(); resetAutoplay(); }
      });
    }

    // Implementação de Swipe para dispositivos móveis (Touch Events)
    function bindSwipe() {
      let startX = 0;
      let dx = 0;

      track.addEventListener("touchstart", e => {
        startX = e.touches[0].clientX;
        stopAutoplay();
      });

      track.addEventListener("touchmove", e => {
        // Calcula o delta do movimento
        dx = e.touches[0].clientX - startX;
      });

      track.addEventListener("touchend", () => {
        // Define um limiar (threshold) de 50px para considerar como swipe
        if (Math.abs(dx) > 50) {
          dx < 0 ? next() : prev();
        }
        dx = 0;
        resetAutoplay();
      });
    }

    function bindResize() {
      window.addEventListener("resize", updateCarousel);
    }

    function bindButtons() {
      if (prevBtn) prevBtn.addEventListener("click", () => { prev(); resetAutoplay(); });
      if (nextBtn) nextBtn.addEventListener("click", () => { next(); resetAutoplay(); });

      // Pausa o carrossel ao passar o mouse
      const container = document.querySelector(".carousel-container");
      if (container) {
        container.addEventListener("mouseenter", stopAutoplay);
        container.addEventListener("mouseleave", startAutoplay);
      }
    }

    // Inicialização assíncrona
    async function initCarousel() {
      games = await loadData();
      buildSlides(games);
      bindButtons();
      bindKeyboard();
      bindSwipe();
      bindResize();
      startAutoplay();
    }

    initCarousel();
  }
});