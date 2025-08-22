<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$marca = $_GET['marca'] ?? '';

try {
  $stmt = $pdo->prepare(
    <<<SQL
    SELECT DISTINCT(modelo)
    FROM veiculo
    WHERE marca = ?
    SQL
  );
  $stmt->execute([$marca]);
  $arrayModelos = $stmt->fetchAll(PDO::FETCH_OBJ);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arrayModelos);
} catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}
