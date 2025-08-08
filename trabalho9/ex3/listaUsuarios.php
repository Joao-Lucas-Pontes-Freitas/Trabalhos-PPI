<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuários Cadastrados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h3>Usuários cadastrados (email e hash da senha)</h3>
  <table class="table table-striped mt-3">
    <thead>
      <tr><th>E-mail</th><th>Hash da senha</th></tr>
    </thead>
    <tbody>
    <?php
      require "usuarios.php";
      foreach (carregaUsuarios() as $u) {
        $email = htmlspecialchars($u->email);
        $hash = htmlspecialchars($u->senhaHash);
        echo "<tr><td>$email</td><td class=\"text-break\">$hash</td></tr>";
      }
    ?>
    </tbody>
  </table>
  <a href="index.html">Voltar</a>
</div>
</body>
</html>
