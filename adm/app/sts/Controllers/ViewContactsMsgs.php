<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da pagina visualizar detalhes da mensagem de contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ViewContactsMsgs
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo visualizar mensagem de contato
     * Recebe como parametro o ID que sera usado para pesquisar as informacoes no banco de dados e instancia a MODELS StsViewContactsMsgs
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senao e redirecionado para o listar mensagem de contato.
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;

            $viewContactsMsgs = new \App\sts\Models\StsViewContactsMsgs();
            $viewContactsMsgs->viewContactsMsgs($this->id);
            if ($viewContactsMsgs->getResult()) {
                $this->data['viewContactsMsgs'] = $viewContactsMsgs->getResultBd();
                $this->viewContactsMsgs();
            } else {
                $urlRedirect = URLADM . "list-contacts-msgs/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem não encontrada!</p>";
            $urlRedirect = URLADM . "list-contacts-msgs/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewContactsMsgs(): void
    {
        $this->data['sidebarActive'] = "list-contacts-msgs"; 
        $loadView = new \Core\ConfigView("sts/Views/contactsMsgs/viewContactsMsgs", $this->data);
        $loadView->loadView();
    }
}
