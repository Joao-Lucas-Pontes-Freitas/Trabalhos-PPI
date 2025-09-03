<?php

function exitWhenNotLoggedIn() // Função que verifica que se o usuário não tiver logado é pra voltar pro incio e que é usada para as outras páginas
{ 
  if (!isset($_SESSION['loggedIn'])) {
    header("Location: index.html");
    exit();  
  }
}
