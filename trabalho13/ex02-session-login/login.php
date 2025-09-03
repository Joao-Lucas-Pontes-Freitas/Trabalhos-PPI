<?php

require "conexaoMysql.php"; // Pega os dados de conexão

class LoginResult // Cria a classe login com seus atributos, flag de sucesso e localização da página restrita
{
  public $success;
  public $newLocation;

  function __construct($success, $newLocation)
  {
    $this->success = $success;
    $this->newLocation = $newLocation;
  }
}

function checkUserCredentials($pdo, $email, $senha) // Função que verifica se o login tá certo
{ // Seleciona os dados a partir do email
  $sql = <<<SQL
    SELECT senhaHash
    FROM cliente
    WHERE email = ?
    SQL;

  try {
    // É necessário utilizar prepared statements por incluir
    // parâmetros informados pelo usuário
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();

    if (!$senhaHash) 
      return false; // a consulta não retornou nenhum resultado (email não encontrado)

    if (!password_verify($senha, $senhaHash))
      return false; // email e/ou senha incorreta
      
    // email e senha corretos
    return true;
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}
// Pega os dados de entrada
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Conecta com o banco de dados
$pdo = mysqlConnect(); 
if (checkUserCredentials($pdo, $email, $senha)) { // Se o login tiver certo
  // Define o parâmetro 'httponly' para o cookie de sessão, para que o cookie
  // possa ser acessado apenas pelo navegador nas requisições http (e não por código JavaScript).
  // Aumenta a segurança evitando que o cookie de sessão seja roubado por eventual
  // código JavaScript proveniente de ataq. X S S.
  $cookieParams = session_get_cookie_params(); // Pega as configs de cookie
  $cookieParams['httponly'] = true; // Seta para ser usado somente via http e não poder usar js
  session_set_cookie_params($cookieParams);  // Salva novas configs
  
  session_start(); // Cria a sessão associada com o cookie
  $_SESSION['loggedIn'] = true; // Marca a flag de logado com true
  $_SESSION['user'] = $email; // Salva na sessão do usuário o email dele
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Gera um token para validar a sessão do usuário de forma que só se ele tiver o token ele possa usar, ou seja, páginas autorizadas

  $response = new LoginResult(true, 'home.php'); // Devolve a página home como a página restrita disponível para acesso
} 
else
  $response = new LoginResult(false, '');  // Se não tiver login retorna nenhuma página e false

header('Content-Type: application/json; charset=utf-8'); // Especifica oherader como json
echo json_encode($response); // Devolve o copro como json