// Garante que o script execute apenas após o carregamento completo do DOM (HTML)
document.addEventListener("DOMContentLoaded", function () {
  
  // Captura o elemento canvas e obtém o contexto 2D, que é a "caneta" usada para desenhar nele
  const canvas = document.getElementById("captchaCanvas");
  const ctx = canvas.getContext("2d");
  const captchaInput = document.getElementById("captchaInput");
  
  const loginForm = document.getElementById("loginForm");
  const logarButton = document.getElementById("btn-logar");

  let textoCaptcha = ""; // Variável de escopo global para armazenar o código gerado atual

  // Função responsável por criar a string aleatória
  function gerarTexto() {
    let texto = "";
    // Conjunto de caracteres permitidos (removidos similares como 'O' e '0' para evitar confusão na leitura)
    const possiveis = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz123456789"; 
    
    // Loop que roda 5 vezes para montar o código caractere por caractere
    for (let i = 0; i < 5; i++) {
      // Math.random gera um número entre 0 e 1, multiplicamos pelo tamanho da string e arredondamos para baixo
      texto += possiveis.charAt(Math.floor(Math.random() * possiveis.length));
    }
    return texto;
  }

  // Função principal de renderização visual
  function desenharCaptcha() {
    textoCaptcha = gerarTexto(); // Atualiza a variável com um novo código
    
    // Limpa a área total do canvas para não sobrepor desenhos anteriores
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Desenha o fundo cinza
    ctx.fillStyle = "#f0f0f0";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Configurações tipográficas e alinhamento para centralizar o texto
    ctx.font = "bold 24px Arial";
    ctx.fillStyle = "#333";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    
    // Escreve o texto nas coordenadas centrais do canvas (width/2, height/2)
    ctx.fillText(textoCaptcha, canvas.width / 2, canvas.height / 2);

    // Adiciona "ruído" visual (linhas aleatórias) para dificultar a leitura por bots
    for (let i = 0; i < 3; i++) {
      // Gera uma cor hexadecimal aleatória para cada linha
      ctx.strokeStyle = "#" + Math.floor(Math.random()*16777215).toString(16);
      
      ctx.beginPath();
      // Define ponto de início e fim da linha em posições aleatórias dentro do canvas
      ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
      ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
      ctx.stroke();
    }
  }

  // Função de validação disparada no submit
  function validarCaptcha(event) {
    // Previne o envio padrão do formulário (refresh da página) para validar o captcha primeiro
    event.preventDefault(); 

    // Comparação simples entre o input do usuário e o texto gerado
    if (captchaInput.value === textoCaptcha) {
      alert("Captcha correto! Logando...");
      // Aqui seria chamado o loginForm.submit() para enviar os dados ao backend
    } else {
      alert("Código incorreto. Tente novamente.");
      captchaInput.value = ""; // Reseta o campo para facilitar nova tentativa
      desenharCaptcha(); // Força a geração de um novo código para segurança
    }
  }

  // Inicialização: Gera o primeiro captcha assim que a página abre
  desenharCaptcha();
  
  // Adiciona o ouvinte de evento para interceptar o envio do formulário
  loginForm.addEventListener("submit", validarCaptcha);

});