<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar conteudo do serviço premium da pagina home
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditHomePrem
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar conteudo do serviço premium da pagina home.
     * Receber os dados do formulario.
     * 
     * Se o usuário nao clicou no botao editar, instancia a MODELS para recuperar as informacoes no banco de dados, se encontrar instancia o metodo "viewEditHomePrem". Se nao existir redireciona para o visualizar conteudo da pagina home.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($this->dataForm['SendEditHomePrem'])) {
            $viewHomePrem = new \App\sts\Models\StsEditHomePrem();
            $viewHomePrem->viewHomePrem();
            if ($viewHomePrem->getResult()) {
                $this->data['form'] = $viewHomePrem->getResultBd();
                $this->viewEditHomePrem();
            } else {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editHomePrem();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditHomePrem(): void
    {
        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/editHomePrem", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar conteudo do serviço premium da pagina home.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente conteudo do topo da pagina home no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar oconteudo da pagina home.
     *
     * @return void
     */
    private function editHomePrem(): void
    {
        if (!empty($this->dataForm['SendEditHomePrem'])) {
            unset($this->dataForm['SendEditHomePrem']);
            $editHomePrem = new \App\sts\Models\StsEditHomePrem();
            $editHomePrem->update($this->dataForm);
            if ($editHomePrem->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomePrem();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo do serviço premium da página home não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
