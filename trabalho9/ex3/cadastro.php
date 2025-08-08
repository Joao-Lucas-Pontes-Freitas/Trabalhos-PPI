<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h3>Cadastrar novo usuário</h3>
  <form action="register.php" method="post" class="vstack gap-3 mt-3" autocomplete="off">
    <div>
      <label class="form-label">E-mail</label>
      <input class="form-control" type="email" name="email" required>
    </div>
    <div>
      <label class="form-label">Senha</label>
      <input class="form-control" type="password" name="senha" required>
    </div>
    <button class="btn btn-primary">Cadastrar</button>
  </form>
  <a class="d-block mt-3" href="index.html">Voltar</a>
</div>
</body>
</html>
