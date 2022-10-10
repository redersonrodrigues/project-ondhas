<?php

namespace Sts\Models;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models responsável em buscar os dados da página footer
 *
 * @author Réderson rederson@ramartecnologia.com.br
 */
class StsFooter
{
    /** @var array|null $data Recebe os registros do banco de dados */
    private array|null $data;

    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array|null Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array|null
    {    
        $viewFooter = new \Sts\Models\helper\StsRead();
        $viewFooter->fullRead("SELECT footer_desc, footer_text_link, footer_link
                            FROM sts_footers 
                            WHERE id=:id 
                            LIMIT :limit", "id=1&limit=1");
        $this->data = $viewFooter->getResult();

        return $this->data;
    }
}
