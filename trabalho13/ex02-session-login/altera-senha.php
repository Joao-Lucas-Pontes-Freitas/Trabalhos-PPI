<?php

// Não é suficiente usar apenas o método POST para proteger contra CSRF. Porque algum outro site pode fazer requisções falsas se passando pelo site verdadeiro, aproveitando da sessão e dos dados do cookie. Com o token, somente quem tem acesso direto ao arquivo de sessão tem acesso a esse token e pode usá-lo para validar que é uma requisção legítima. O que outros sites não podem.


require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();

// Se por algum motivo essa página foi chamada pelo navegador, se não tiver o token de validação ou o token de validação estiver errado, o servidor não deixará que nenhuma ação seja executada.

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
  exit('Operação não permitida.');

$pdo = mysqlConnect();
$email = $_POST['email'] ?? "";
$novaSenha = $_POST['novaSenha'] ?? "";
$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

try {
  $stmt = $pdo->prepare(
    <<<SQL
      UPDATE cliente
      SET senhaHash = ?
      WHERE email = ?
    SQL
  );
  $stmt->execute([$senhaHash, $email]);
  header("location: sucesso.html");
}
catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}