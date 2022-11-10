<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar conteudo do topo da pagina home
 * @author Cesar <cesar@celke.com.br>
 */
class EditHomeTop
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar conteudo do topo da pagina home.
     * Receber os dados do formulario.
     * 
     * Se o usuário nao clicou no botao editar, instancia a MODELS para recuperar as informacoes no banco de dados, se encontrar instancia o metodo "viewEditHomeTop". Se nao existir redireciona para o visualizar conteudo da pagina home.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($this->dataForm['SendEditHomeTop'])) {
            $viewHomeTop = new \App\sts\Models\StsEditHomeTop();
            $viewHomeTop->viewHomeTop();
            if ($viewHomeTop->getResult()) {
                $this->data['form'] = $viewHomeTop->getResultBd();
                $this->viewEditHomeTop();
            } else {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editHomeTop();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditHomeTop(): void
    {
        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \Core\ConfigView("sts/Views/home/editHomeTop", $this->data);
        $loadView->loadView();
    }

    /**
     * Editar conteudo do topo da pagina home.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente conteudo do topo da pagina home no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar oconteudo da pagina home.
     *
     * @return void
     */
    private function editHomeTop(): void
    {
        if (!empty($this->dataForm['SendEditHomeTop'])) {
            unset($this->dataForm['SendEditHomeTop']);
            $editHomeTop = new \App\sts\Models\StsEditHomeTop();
            $editHomeTop->update($this->dataForm);
            if ($editHomeTop->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomeTop();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo do topo da página home não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
