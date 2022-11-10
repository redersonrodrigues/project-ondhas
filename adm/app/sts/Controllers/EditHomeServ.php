<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar conteudo dos serviços da pagina home
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditHomeServ
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar conteudo dos serviços da pagina home.
     * Receber os dados do formulario.
     * 
     * Se o usuário nao clicou no botao editar, instancia a MODELS para recuperar as informacoes no banco de dados, se encontrar instancia o metodo "viewEditHomeServ". Se nao existir redireciona para o visualizar conteudo da pagina home.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($this->dataForm['SendEditHomeServ'])) {
            $viewHomeServ = new \App\sts\Models\StsEditHomeServ();
            $viewHomeServ->viewHomeServ();
            if ($viewHomeServ->getResult()) {
                $this->data['form'] = $viewHomeServ->getResultBd();
                $this->viewEditHomeServ();
            } else {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editHomeServ();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditHomeServ(): void
    {
        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/editHomeServ", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar conteudo dos serviços da pagina home.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente conteudo dos serviços da pagina home no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar o conteudo da pagina home.
     *
     * @return void
     */
    private function editHomeServ(): void
    {
        if (!empty($this->dataForm['SendEditHomeServ'])) {
            unset($this->dataForm['SendEditHomeServ']);
            $editHomeServ = new \App\sts\Models\StsEditHomeServ();
            $editHomeServ->update($this->dataForm);
            if ($editHomeServ->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomeServ();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo dos serviços da página home não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
