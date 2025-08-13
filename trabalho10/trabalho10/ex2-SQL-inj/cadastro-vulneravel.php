<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$telefone = $_POST["telefone"] ?? "";

try {
  /*

  // NÃO FAÇA ISSO! Exemplo de código vulnerável a inj. de S-Q-L
  $sql = <<<SQL
  INSERT INTO aluno (nome, telefone)
  VALUES ('$nome', '$telefone');
  SQL;  

  // Experimente fazer o cadastro de um novo aluno preenchendo 
  // o campo telefone utilizando o texto disponibilizado pelo professor
  // nos slides de aula
  $pdo->exec($sql);

  // O motivo desse código ser vulnerável é porque ele inclue a entrada do usuário direto na consulta/comando SQL. Isso é feito sem nenhum tipo de validação ou segurança de que o usuário é bem intencionado e que de fato aqueles dados são seguros. Assim, se o usuário quiser passar qualquer coisa, inclusive comandos SQL, ele consegue modificar o SQL original e fazer com que os comandos dele sejam executados ao invés do SQL correto esperado.
  */

  $sql = <<<SQL
    INSERT INTO aluno (nome, telefone)
    VALUES (? , ?)
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nome, $telefone]);
  header("location: mostra-alunos.php");
  exit();
} 
catch (Exception $e) {  
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}


