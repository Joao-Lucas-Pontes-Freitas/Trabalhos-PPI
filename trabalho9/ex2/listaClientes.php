<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <h3>Clientes cadastrados em <i>clientes.txt</i></h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
          <th>E-mail</th>
          <th>CEP</th>
          <th>Endereço</th>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
          require "clientes.php";
          $clientes = carregaClientesDeArquivo();
          foreach ($clientes as $c) {
            $nome = htmlspecialchars($c->nome);
            $cpf = htmlspecialchars($c->cpf);
            $email = htmlspecialchars($c->email);
            $cep = htmlspecialchars($c->cep);
            $endereco = htmlspecialchars($c->endereco);
            $bairro = htmlspecialchars($c->bairro);
            $cidade = htmlspecialchars($c->cidade);
            $estado = htmlspecialchars($c->estado);
            echo <<<HTML
            <tr>
              <td>$nome</td>
              <td>$cpf</td>
              <td>$email</td>
              <td>$cep</td>
              <td>$endereco</td>
              <td>$bairro</td>
              <td>$cidade</td>
              <td>$estado</td>
            </tr>
            HTML;
          }
        ?>
      </tbody>
    </table>
    <a href="index.html">Voltar</a>
  </div>
</body>
</html>
