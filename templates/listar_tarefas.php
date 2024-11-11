<?php
$conn = conectar();

// Consulta SQL para obter todas as tarefas ordenadas pelo campo 'ordem'
$stmt = $conn->query("SELECT id, nome, custo, data_limite, ordem FROM Tarefas ORDER BY ordem");
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Custo</th>
            <th>Data Limite</th>
            <th>Ações</th>
            <th>Ordem</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            // Variável para guardar o index da tarefa atual
            $index = 0; 
            foreach ($tarefas as $tarefa): 
        ?>
            <tr data-id="<?= $tarefa['id'] ?>">
                <td>
                    <?= htmlspecialchars($tarefa['nome']) ?>
                </td>
                <td <?php if ($tarefa['custo'] >= 1000) echo 'style="background-color: yellow"'; ?>>
                    R$ <?= number_format($tarefa['custo'], 2, ',', '.') ?>
                </td>
                <td><?= htmlspecialchars($tarefa['data_limite']) ?></td>
                <td>
                    <a href="tarefa_edit.php?id=<?= $tarefa['id'] ?>">Editar</a>
                    <a href="tarefa_delete.php?id=<?= $tarefa['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                </td>
                <td>
                    <?php if ($index > 0): ?>
                        <a href="update_order.php?action=up&id=<?= $tarefa['id'] ?>">Subir</a> 
                    <?php endif; ?>
                    <?php if ($index < count($tarefas) - 1): ?>
                        <a href="update_order.php?action=down&id=<?= $tarefa['id'] ?>">Descer</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php 
            $index++; 
            endforeach; 
        ?>
    </tbody>
</table>