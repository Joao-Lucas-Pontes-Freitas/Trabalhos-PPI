<?php
require "usuarios.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
  header('location: cadastro.php');
  exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$usuario = new Usuario($email, $senhaHash);
$usuario->salva();

header('location: listaUsuarios.php');
?>
