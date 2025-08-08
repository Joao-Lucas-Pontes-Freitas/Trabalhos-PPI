<?php

class Usuario
{
  public $email;
  public $senhaHash; // senha com hash

  function __construct($email, $senhaHash)
  {
    $this->email = $email;
    $this->senhaHash = $senhaHash;
  }

  public function salva()
  {
    $arq = fopen("usuarios.txt", "a");
    fwrite($arq, "{$this->email};{$this->senhaHash}\n");
    fclose($arq);
  }
}

function carregaUsuarios()
{
  $usuarios = [];
  $arq = @fopen("usuarios.txt", "r");
  if (!$arq) return $usuarios;
  while (!feof($arq)) {
    $linha = trim(fgets($arq));
    if ($linha === "") continue;
    list($email, $senhaHash) = array_pad(explode(";", $linha), 2, null);
    $usuarios[] = new Usuario($email, $senhaHash);
  }
  fclose($arq);
  return $usuarios;
}

function buscaUsuarioPorEmail($email)
{
  foreach (carregaUsuarios() as $u) {
    if (strcasecmp($u->email, $email) === 0) return $u;
  }
  return null;
}

?>
