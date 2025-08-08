<?php
require "usuarios.php";

$erro = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $u = buscaUsuarioPorEmail($email);
    if ($u && password_verify($senha, $u->senhaHash)) {
        header('Location: sucesso.html');
        exit;
    }
    $erro = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h3>Login</h3>
    <?php if ($erro || isset($_GET['erro'])): ?>
        <div class="alert alert-danger">Usuário ou senha inválidos</div>
    <?php endif; ?>
    <form action="login.php" method="post" class="vstack gap-3 mt-3" autocomplete="off">
        <div>
            <label class="form-label">E-mail</label>
            <input class="form-control" type="email" name="email" required>
        </div>
        <div>
            <label class="form-label">Senha</label>
            <input class="form-control" type="password" name="senha" required>
        </div>
        <button class="btn btn-success">Entrar</button>
    </form>
    <a class="d-block mt-3" href="index.html">Voltar</a>
</div>
</body>
</html>
