<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar conteudo do rodapé
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsViewFooter
{

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBdFooter;

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBdFooter(): array|null
    {
        return $this->resultBdFooter;
    }

    /**
     * Metodo para visualizar os detalhes do rodapé
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function viewFooter(): void
    {
        $viewFooter = new \App\adms\Models\helper\AdmsRead();
        $viewFooter->fullRead("SELECT id, footer_desc, footer_text_link, footer_link, created, modified FROM sts_footers LIMIT :limit", "limit=1");

        $this->resultBdFooter = $viewFooter->getResult();
    }
}
