<?php

namespace Sts\Models\helper;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


use PDO;
use PDOException;

/**
 * Helper responsável em buscar os registros no banco de dados
 *
 * @author Réderson rederson@ramartecnologia.com.br
 */
class StsRead extends StsConn
{

    private string $select;
    private array|null $result = [];
    private object $query;
    private object $conn;

    function getResult(): array|null
    {
        return $this->result;
    }

    public function exeRead(string $table, $terms = null, $parseString = null )
    {
        var_dump($table);
        $this->select = "SELECT * FROM {$table}";
        var_dump($this->select);

        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        $this->connection();
        try{
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        }catch(PDOException $err){
            $this->result = null;
        }
    }
	/** Método de conexão com o banco de dados */
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }
}