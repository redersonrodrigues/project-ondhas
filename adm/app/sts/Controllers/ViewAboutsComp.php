<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da pagina visualizar sobre empresa
 * @author Cesar <cesar@celke.com.br>
 */
class ViewAboutsComp
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo visualizar sobre empresa
     * Recebe como parametro o ID que sera usado para pesquisar as informacoes no banco de dados e instancia a MODELS AdmsViewAboutsComp
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senao e redirecionado para o listar sobre empresa.
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;

            $viewAboutsComp = new \App\sts\Models\StsViewAboutsComp();
            $viewAboutsComp->viewAboutsComp($this->id);
            if ($viewAboutsComp->getResult()) {
                $this->data['viewAboutsComp'] = $viewAboutsComp->getResultBd();
                $this->viewAboutsComp();
            } else {
                $urlRedirect = URLADM . "list-abouts-comp/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não encontrado!</p>";
            $urlRedirect = URLADM . "list-abouts-comp/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAboutsComp(): void
    {
        $this->data['sidebarActive'] = "list-abouts-comp"; 
        $loadView = new \Core\ConfigView("sts/Views/aboutsComp/viewAboutsComp", $this->data);
        $loadView->loadView();
    }
}
