<?php
// Configurações de acesso ao banco (Padrão do XAMPP)
$host = "localhost";
$user = "root";
$pass = ""; // No XAMPP, a senha do usuário 'root' vem vazia por padrão
$db   = "arcana_games_db";

// Tenta estabelecer a conexão com o banco de dados
$mysqli = new mysqli($host, $user, $pass, $db);

// Se der erro (ex: banco não iniciado no painel do XAMPP), mata o script e avisa
if ($mysqli->connect_errno) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>