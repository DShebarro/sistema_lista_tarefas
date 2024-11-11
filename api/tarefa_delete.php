<?php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = conectar();

    // Prepare statement para evitar SQL Injection
    $stmt = $conn->prepare("DELETE FROM Tarefas WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
} else {
    echo "Erro: ID da tarefa não especificado.";
}
?>