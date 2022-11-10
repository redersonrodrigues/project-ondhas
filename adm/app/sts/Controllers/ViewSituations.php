<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da pagina visualizar detalhes da situação
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ViewSituations
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo visualizar a situação
     * Recebe como parametro o ID que sera usado para pesquisar as informacoes no banco de dados e instancia a MODELS StsViewSituations
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senao e redirecionado para o listar situações.
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;

            $viewSituations = new \App\sts\Models\StsViewSituations();
            $viewSituations->viewSituations($this->id);
            if ($viewSituations->getResult()) {
                $this->data['viewSituations'] = $viewSituations->getResultBd();
                $this->viewSituations();
            } else {
                $urlRedirect = URLADM . "list-situations/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação não encontrada!</p>";
            $urlRedirect = URLADM . "list-situations/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewSituations(): void
    {
        $this->data['sidebarActive'] = "list-situations"; 
        $loadView = new \Core\ConfigView("sts/Views/situations/viewSituations", $this->data);
        $loadView->loadView();
    }
}
