<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar conteudo da pagina home
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsViewPageHome
{

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBdTop;

    /** @var array|null $resultBdServ Recebe os registros do banco de dados */
    private array|null $resultBdServ;

    /** @var array|null $resultBdPrem Recebe os registros do banco de dados */
    private array|null $resultBdPrem;

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBdTop(): array|null
    {
        return $this->resultBdTop;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBdServ(): array|null
    {
        return $this->resultBdServ;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBdPrem(): array|null
    {
        return $this->resultBdPrem;
    }
    
    /**
     * Metodo para visualizar os detalhes do topo da pagina home
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function viewPageHomeTop(): void
    {
        $viewHomeTop = new \App\adms\Models\helper\AdmsRead();
        $viewHomeTop->fullRead("SELECT id, title_one_top, title_two_top, title_three_top, link_btn_top, txt_btn_top, image_top, created, modified FROM sts_homes_tops LIMIT :limit", "limit=1");

        $this->resultBdTop = $viewHomeTop->getResult();  
    }
    
    
    /**
     * Metodo para visualizar os detalhes dos servicos da pagina home
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function viewPageHomeServ(): void
    {
        $viewHomeServ = new \App\adms\Models\helper\AdmsRead();
        $viewHomeServ->fullRead("SELECT id, serv_title, serv_icon_one, serv_title_one, serv_desc_one, serv_icon_two, serv_title_two, serv_desc_two, serv_icon_three, serv_title_three, serv_desc_three, created, modified FROM sts_homes_services LIMIT :limit", "limit=1");

        $this->resultBdServ = $viewHomeServ->getResult();  
    }
    
    
    /**
     * Metodo para visualizar os detalhes do servico premium da pagina home
     * Retorna FALSE se houver algum erro.
     * @param integer $id
     * @return void
     */
    public function viewPageHomePrem(): void
    {
        $viewHomePrem = new \App\adms\Models\helper\AdmsRead();
        $viewHomePrem->fullRead("SELECT id, prem_title, prem_subtitle, prem_desc, prem_btn_text, prem_btn_link, prem_image, created, modified FROM sts_homes_premiums LIMIT :limit", "limit=1");

        $this->resultBdPrem = $viewHomePrem->getResult();  
    }
}
