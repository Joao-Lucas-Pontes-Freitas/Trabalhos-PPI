<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$modelo = $_GET['modelo'] ?? '';

try {
  $stmt = $pdo->prepare(
    <<<SQL
    SELECT *
    FROM veiculo
    WHERE modelo = ?
    SQL
  );
  $stmt->execute([$modelo]);
  $arrayVeiculos = $stmt->fetchAll(PDO::FETCH_OBJ);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arrayVeiculos);
} 
catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}
