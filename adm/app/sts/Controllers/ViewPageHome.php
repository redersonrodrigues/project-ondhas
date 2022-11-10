<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da pagina visualizar conteudo do site da pagina home
 * @author Cesar <cesar@celke.com.br>
 */
class ViewPageHome
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    public function index(): void
    {
        $viewHome = new \App\sts\Models\StsViewPageHome();
        $viewHome->viewPageHomeTop();
        $this->data['viewHomeTop'] = $viewHome->getResultBdTop();
        
        $viewHome->viewPageHomeServ();
        $this->data['viewHomeServ'] = $viewHome->getResultBdServ();
        
        $viewHome->viewPageHomePrem();
        $this->data['viewHomePrem'] = $viewHome->getResultBdPrem();

        $this->data['sidebarActive'] = "view-page-home";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/viewPageHome", $this->data);
        $loadView->loadViewSts();
    }
}
