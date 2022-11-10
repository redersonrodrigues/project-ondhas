<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da pagina visualizar conteudo do site da pagina contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ViewPageContact
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    public function index(): void
    {
        $viewPageContact = new \App\sts\Models\StsViewPageContact();
        $viewPageContact->viewPageContact();
        $this->data['viewContact'] = $viewPageContact->getResultBd();

        $this->data['sidebarActive'] = "view-page-contact";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contact/viewPageContact", $this->data);
        $loadView->loadViewSts();

    }
}
