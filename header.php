<?php
// Garante o início da sessão para acessar variáveis globais como carrinho e usuário logado
if (session_status() === PHP_SESSION_NONE) { session_start(); }

$qtd_carrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;

// Define se mostra o botão de Login ou a saudação ao usuário
$nome_usuario = "Login";
$link_login = "./login.php";

if(isset($_SESSION['nome'])) {
    $partes = explode(" ", $_SESSION['nome']);
    $nome_usuario = "Olá, " . $partes[0]; // Pega apenas o primeiro nome
    $link_login = "./logout.php";
}
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">


<header class="header">
    <a href="./index.php">
        <img src="./img/ArcanaGames.png" alt="Arcana Games" class="logo-img">
    </a>

    <nav class="navbar">
        <ul>
            <li><a href="./index.php">Início</a></li>
            <li><a href="./jogos.php">Jogos</a></li>
            <li><a href="./contato.php">Contato</a></li>
        </ul>
    </nav>

    <div class="header-actions">
        <form action="busca.php" method="GET" class="search-box">
            <input type="text" name="q" placeholder="Buscar..." required>
            <button type="submit">🔍</button>
        </form>

        <a href="<?php echo $link_login; ?>" class="btn-login" style="text-decoration:none; text-align:center; min-width: 80px;">
            <?php echo $nome_usuario; ?>
        </a>
        
        <a href="./carrinho.php" class="cart-btn-wrapper" style="display:inline-flex;align-items:center;gap:6px;background:#2ea3ff;color:#001d33;padding:8px 14px;border-radius:8px;text-decoration:none;font-weight:bold;font-size:14px; position:relative;">
            🛒
            <?php if($qtd_carrinho > 0): ?>
                <span style="position:absolute; top:-8px; right:-8px; background:red; color:white; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; font-size:12px; border:2px solid #0e0d2a;">
                    <?php echo $qtd_carrinho; ?>
                </span>
            <?php endif; ?>
        </a>
    </div>
</header>