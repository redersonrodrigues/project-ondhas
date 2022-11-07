<?php

namespace App\adms\Controllers;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página visualizar perfil
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ViewProfile
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Metodo visualizar perfil
     * Instancia a MODELS AdmsViewProfile para pesquisar as informações do usuário
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão é redirecionado para a página de login.
     * 
     * @return void
     */
    public function index(): void
    {
        $viewProfile = new \App\adms\Models\AdmsViewProfile();
        $viewProfile->viewProfile();
        if ($viewProfile->getResult()) {
            $this->data['viewProfile'] = $viewProfile->getResultBd();
            $this->loadViewProfile();
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function loadViewProfile(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/viewProfile", $this->data);
        $loadView->loadView();
    }
}
