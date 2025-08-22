<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $stmt = $pdo->query(
    <<<SQL
    SELECT DISTINCT(marca)
    FROM veiculo
    SQL
  );
  $arrayMarcas = $stmt->fetchAll(PDO::FETCH_OBJ);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arrayMarcas);
} 
catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}