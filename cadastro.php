<?php
include('conexao.php');

if(isset($_POST['email'])) {
    // Sanitização básica para evitar SQL Injection nos dados de entrada
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    
    // Gera um hash seguro da senha antes de salvar no banco
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 

    // Verifica duplicidade de e-mail antes de inserir
    $sql_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $query_check = $mysqli->query($sql_check);

    if($query_check->num_rows > 0) {
        $erro = "Este e-mail já está cadastrado!";
    } else {
        $sql_code = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        $sql_query = $mysqli->query($sql_code) or die("Erro ao cadastrar: " . $mysqli->error);
        
        if($sql_query) {
            // Feedback visual via JS e redirecionamento para login
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
        } else {
            $erro = "Erro ao cadastrar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ArcanaGames — Cadastro</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>

<?php include('header.php'); ?>

    <main class="login-section">
        <div class="login-box glass-effect">
            <h2>Criar Conta</h2>

            <?php if(isset($erro)) echo "<p style='color:red; margin-bottom:10px;'>$erro</p>"; ?>

            <form action="" method="POST">
                <input type="text" name="nome" placeholder="Seu Nome Completo" required>
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Crie uma Senha" required>

                <button class="btn neon-btn" type="submit" style="margin-top:20px;">Cadastrar</button>

                <a href="login.php" class="link">Já tem conta? Faça Login</a>
            </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>