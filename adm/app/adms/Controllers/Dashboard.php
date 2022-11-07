<?php

namespace App\adms\Controllers;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página Deshboard
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class Dashboard
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Método Dashboard.
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {

        $countUsers = new \App\adms\Models\AdmsDashboard();
        $countUsers->countUsers();
        if ($countUsers->getResult()) {
            //var_dump($countUsers->getResultBd());
            $this->data['countUsers'] = $countUsers->getResultBd();
        } else {
            $this->data['countUsers'] = false;
        }


        $this->data['sidebarActive'] = "dashboard";

        $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}
