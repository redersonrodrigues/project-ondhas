<?php

namespace Sts\Models;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models responsável em buscar os dados da página home
 *
 * @author Réderson rederson@ramartecnologia.com.br
 */
class StsHome
{
    /** @var array $data Recebe os registros do banco de dados */
    private array $data;

    /**
     * Criar o array com dados da página home
     * @return array Retorna informações para página Home
     */
    public function index(): array
    {
        $this->data = [
            "title" => "Topo da pagina",
            "description" => "Descrição do serviço"
        ];        

        return $this->data;
    }
}
