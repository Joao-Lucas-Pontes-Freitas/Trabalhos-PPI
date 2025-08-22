<?php

class Endereco
{
  public $rua; // Derclara os campos que vão ser retornados
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade) // Atribui os campos pelo construtor
  {
    $this->rua = $rua;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}

$cep = $_GET['cep'] ?? ''; // Pega o cep pelo form

if ($cep == '38400-100') // Se o cep for 38400-100 cria um obejto endereco com os dados Av Floriano, Centro, Uberlândia
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($cep == '38400-200') // Se o cep for 38400-200 cria um obejto endereco com os dados Rua Tiradentes, Fundinho, Uberlândia
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else { // Se não for nenhum dos anteriores retorna um objeto vazio
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json'); // Define o header da resposta como JSON
echo json_encode($endereco); // Retorna o objeto de endereço como JSON no body
