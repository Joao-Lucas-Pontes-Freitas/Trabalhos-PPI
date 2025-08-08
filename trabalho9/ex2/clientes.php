<?php

class Cliente
{
  public $nome;
  public $cpf;
  public $email;
  public $senha;
  public $cep;
  public $endereco;
  public $bairro;
  public $cidade;
  public $estado;

  function __construct($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $estado)
  {
    $this->nome = $nome;
    $this->cpf = $cpf;
    $this->email = $email;
    $this->senha = $senha; // Ex.2: armazenar como enviado; no Ex.3 faremos hash.
    $this->cep = $cep;
    $this->endereco = $endereco;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
    $this->estado = $estado;
  }

  public function salvaEmArquivo()
  {
    $arq = fopen("clientes.txt", "a");
    fwrite($arq, "{$this->nome};{$this->cpf};{$this->email};{$this->senha};{$this->cep};{$this->endereco};{$this->bairro};{$this->cidade};{$this->estado}\n");
    fclose($arq);
  }
}

function carregaClientesDeArquivo()
{
  $clientes = [];
  $arq = @fopen("clientes.txt", "r");
  if (!$arq) return $clientes;

  while (!feof($arq)) {
    $linha = trim(fgets($arq));
    if ($linha === "") continue;
    list($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $estado) = array_pad(explode(";", $linha), 9, null);
    $clientes[] = new Cliente($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $estado);
  }

  fclose($arq);
  return $clientes;
}

?>
