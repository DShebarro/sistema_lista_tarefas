<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];

    $conn = conectar();

    // Obtenção da ordem da última tarefa
    $stmt = $conn->query("SELECT MAX(ordem) AS ultima_ordem FROM Tarefas");
    $ultima_ordem = $stmt->fetch(PDO::FETCH_ASSOC)['ultima_ordem'] ?? 0;
    $nova_ordem = $ultima_ordem + 1;

    // Prepare statement para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO Tarefas (nome, custo, data_limite, ordem) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$nome, $custo, $data_limite, $nova_ordem]);
        header("Location: index.php"); // Redireciona para a lista após inclusão
        exit;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!-- Formulário HTML para incluir nova tarefa -->
<form action="tarefa_create.php" method="POST">
    Nome da Tarefa: <input type="text" name="nome" required><br>
    Custo (R$): <input type="number" name="custo" step="0.01" required><br>
    Data Limite: <input type="date" name="data_limite" required><br>
    <button type="submit">Incluir Tarefa</button>
</form>