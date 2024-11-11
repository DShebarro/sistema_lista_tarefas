<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];

    $conn = conectar();

    // Prepare statement para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id FROM Tarefas WHERE nome = ? AND id != ?");
    $stmt->execute([$nome, $id]);
    if ($stmt->fetch()) {
        echo "Erro: Nome da tarefa já existe.";
    } else {
        $stmt = $conn->prepare("UPDATE Tarefas SET nome = ?, custo = ?, data_limite = ? WHERE id = ?");
        $stmt->execute([$nome, $custo, $data_limite, $id]);
        header("Location: index.php");
        exit;
    }
} else {
    $id = $_GET['id'];
    $conn = conectar();

    // Prepare statement para evitar SQL Injection
    $stmt = $conn->prepare("SELECT * FROM Tarefas WHERE id = ?");
    $stmt->execute([$id]);
    $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!-- Formulário de edição -->
<form action="tarefa_edit.php" method="POST">
    <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
    Nome da Tarefa: <input type="text" name="nome" value="<?= htmlspecialchars($tarefa['nome']) ?>" required><br>
    Custo (R$): <input type="number" name="custo" value="<?= $tarefa['custo'] ?>" step="0.01" required><br>
    Data Limite: <input type="date" name="data_limite" value="<?= $tarefa['data_limite'] ?>" required><br>
    <button type="submit">Salvar Alterações</button>
</form>