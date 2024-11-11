<?php
// Função para conectar ao banco de dados SQLite
function conectar()
{
    try {
        // Abre ou cria o banco de dados 'tarefas.db'
        $conn = new PDO('sqlite:tarefas.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
        exit;
    }
}

// Função para criar a tabela Tarefas caso ela ainda não exista
function criarTabela()
{
    $conn = conectar();
    
    $sql = "CREATE TABLE IF NOT EXISTS Tarefas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT NOT NULL UNIQUE,
                custo REAL,
                data_limite TEXT,
                ordem INTEGER UNIQUE
            )";
    
    $conn->exec($sql);
   // echo "Tabela 'Tarefas' pronta para uso.<br>";
}

// Chama a função para garantir que a tabela seja criada ao importar o arquivo
criarTabela();
?>