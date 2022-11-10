<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar conteudo da pagina contato
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsViewPageContact
{

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    
    /**
     * Metodo para visualizar os detalhes da pagina contato
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function viewPageContact(): void
    {
        $viewPageContact = new \App\adms\Models\helper\AdmsRead();
        $viewPageContact->fullRead("SELECT id, title_contact, desc_contact, icon_company, title_company, desc_company, icon_address, title_address, desc_address, icon_email, title_email, desc_email, title_form, created, modified FROM sts_contents_contacts LIMIT :limit", "limit=1");

        $this->resultBd = $viewPageContact->getResult();  
    }
}
