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
    private array $values = [];
    private array|null $result = [];
    private object $query;
    private object $conn;

    function getResult(): array|null
    {
        return $this->result;
    }

    public function exeRead(string $table, string|null $terms = null, string|null $parseString = null)
    {
        var_dump($table);
        var_dump($parseString);

        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
            var_dump($this->values);
        }

        $this->select = "SELECT * FROM {$table} {$terms}";
        var_dump($this->select);

        $this->exeInstruction();
    }

    private function exeInstruction()
    {
        $this->connection();
        try {
            $this->exeParameter();
            var_dump($this->query);
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->result = null;
        }
    }

    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function exeParameter()
    {
        if ($this->values) {
            var_dump($this->values);
            foreach ($this->values as $link => $value) {
                var_dump($link);
                var_dump($value);
                if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
                    $value = (int) $value;
                }

                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
