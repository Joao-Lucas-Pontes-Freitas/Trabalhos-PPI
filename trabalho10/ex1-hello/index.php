<?php

require "../conexaoMysql.php"; // Importa arquivo que configura a conexão com o banco de dados
$pdo = mysqlConnect(); // Chama a função de conexão

try {
  $sql = <<<SQL
    SELECT nome, telefone
    FROM aluno
  SQL; // Esquema da consulta

  $stmt = $pdo->query($sql); // Chamada da consulta
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage()); // Captura exceção e mostra mensagem em casso de erro
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello World - Listagem de Dados em Tabela do MySQL</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Dados na tabela <b>aluno</b></h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Telefone</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()) // Loop enquanto tiver próxima linha para pegar no resultado do select. Se não tiver, o loop para.
      {
        $nome = htmlspecialchars($row['nome']); // Troca símbolos especiais do nome por entidades HTML exemplo < vira &lt;
        $telefone = htmlspecialchars($row['telefone']); // Troca símbolos especiais do telefone por entidades HTML exemplo < vira &lt;

        echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$telefone</td>
        </tr>      
        HTML; // Adiciona na tabela a linha com os campos retornados do select
      }
      ?>
    </table>
    <a href="../index.html">Menu de opções</a>
  </div>

</body>

</html>