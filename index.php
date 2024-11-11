<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Lista de Tarefas</h1>
    <?php include 'templates/listar_tarefas.php'; ?>
    <a href="tarefa_create.php">Incluir Nova Tarefa</a>
</body>

</html>