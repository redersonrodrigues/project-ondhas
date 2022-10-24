<?php

namespace App\adms\Controllers;

/**

 * Controller da página Deshboard

 * @author Réderson <rederson@ramartecnologia.com.br>

 */
class Dashboard
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Instantiar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index():void
    {
        $this->data = "Bem vindo";

        $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}