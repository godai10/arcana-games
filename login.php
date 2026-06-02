<?php
include('conexao.php'); // Puxa a conexão com o banco de dados

// Verifica se o usuário clicou no botão de entrar (se mandou os dados)
if(isset($_POST['email']) && isset($_POST['senha'])) {

    // Validação básica pra não deixar campo vazio
    if(strlen($_POST['email']) == 0) {
        $erro = "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        $erro = "Preencha sua senha";
    } else {
        // Limpa os dados para evitar SQL Injection (segurança)
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $_POST['senha'];

        // Busca no banco se existe esse e-mail
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        // Se encontrou exatamente 1 usuário
        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc(); // Pega os dados do usuário encontrados

            // Confere se a senha digitada bate com a senha criptografada no banco
            if(password_verify($senha, $usuario['senha'])) {
                
                // Se a sessão não existir, cria uma nova
                if(!isset($_SESSION)) {
                    session_start();
                }

                // Salva os dados na sessão pro site saber que tá logado
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: index.php"); // Redireciona pra Home
            } else {
                $erro = "Falha ao logar! Senha incorreta.";
            }
        } else {
            $erro = "Falha ao logar! E-mail não encontrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ArcanaGames — Login</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/login.js" defer></script>
</head>
<body>

    <!-- Importa o cabeçalho padrão do site -->
    <?php include('header.php'); ?>

    <main class="login-section">
        <div class="login-box glass-effect">
            <h2>Login</h2>
            
            <!-- Se tiver algum erro (senha errada, etc), mostra aqui -->
            <?php if(isset($erro)) echo "<p style='color:red; margin-bottom:10px;'>$erro</p>"; ?>

            <form action="" method="POST">
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>

                <!-- O Captcha é controlado pelo Javascript -->
                <label style="margin-top:10px; display:block; color:#ccc;">Verificação:</label>
                <canvas id="captchaCanvas" width="150" height="40"></canvas>
                <input type="text" id="captchaInput" placeholder="Digite o código">

                <button class="btn neon-btn" type="submit">Entrar</button>

                <a href="cadastro.php" class="link">Não tem conta? Cadastre-se</a>
            </form>
        </div>
    </main>
    
    <!-- Importa o rodapé padrão -->
    <?php include('footer.php'); ?>
</body>
</html>