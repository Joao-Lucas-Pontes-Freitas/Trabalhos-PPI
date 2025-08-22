<?php

class LoginResult // Define a classe de resultado de login
{
  public $isAuthorized; // Atribuiot que fala se o login foi bem sucedido
  public $newLocation; // Atribuoto que fala para qual página redirecionar em caso de sucesso

  function __construct($isAuthorized, $newLocation) // Construtor da classe
  {
    $this->isAuthorized = $isAuthorized;
    $this->newLocation = $newLocation;
  }
}

$email = $_POST['email'] ?? ''; // Pega o email que veio do form
$senha = $_POST['senha'] ?? ''; // Pega a senha que veio do form

// Validação simplificada para fins didáticos. Não faça isso!
if ($email == 'fulano@mail.com' && $senha == '123456') // Verifica se o email e senha estão corretos
  $loginResult = new LoginResult(true, 'home.html'); // Se correto, autorizado e vai pra home
else
  $loginResult = new LoginResult(false, ''); // Se incorreto, não autorizado e não redireciona 

header('Content-type: application/json'); // Define a forma de retorno como json
echo json_encode($loginResult); // Transforma o obejto da classe em json e retorna