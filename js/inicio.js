let currentSlide = 0;

function showSlide(index) {
    const track = document.querySelector('.slides');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    // Validação simples para garantir que os elementos existem antes de manipular
    if (!track || slides.length === 0) return;

    // Lógica circular: reseta para o início ou fim dependendo do limite do índice
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    // Obtém a largura renderizada atual do slide (clientWidth) para calcular o deslocamento exato
    const width = slides[0].clientWidth;
    
    // Move o container usando transform CSS baseado no índice atual
    track.style.transform = `translateX(-${currentSlide * width}px)`;

    // Atualiza o estado ativo das bolinhas de navegação
    dots.forEach(dot => dot.classList.remove('active'));
    if (dots[currentSlide]) {
        dots[currentSlide].classList.add('active');
    }
}

// Navegação pelas setas (anterior/próximo)
function moveSlide(n) {
    showSlide(currentSlide + n);
}

// Navegação direta pelos indicadores (bolinhas)
function setSlide(n) {
    showSlide(n);
}

document.addEventListener('DOMContentLoaded', () => {
    showSlide(0);
    
    // Recalcula a posição do slide ao redimensionar a janela para manter o alinhamento correto
    window.addEventListener('resize', () => {
        showSlide(currentSlide);
    });

    // Define o intervalo para troca automática de slides (5 segundos)
    setInterval(() => { moveSlide(1); }, 5000);
});