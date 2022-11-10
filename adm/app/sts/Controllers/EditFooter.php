<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar conteudo do rodapé
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditFooter
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar conteudo do rodapé.
     * Receber os dados do formulario.
     * 
     * Se o usuário nao clicou no botao editar, instancia a MODELS para recuperar as informacoes no banco de dados, se encontrar instancia o metodo "viewEditFooter". Se nao existir redireciona para o visualizar conteudo do rodapé.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($this->dataForm['SendEditFooter'])) {
            $viewFooter = new \App\sts\Models\StsEditFooter();
            $viewFooter->viewFooter();
            if ($viewFooter->getResult()) {
                $this->data['form'] = $viewFooter->getResultBd();
                $this->viewEditFooter();
            } else {
                $urlRedirect = URLADM . "view-footer/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editFooter();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditFooter(): void
    {
        $this->data['sidebarActive'] = "view-footer"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/footer/editFooter", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar conteudo do rodapé.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente conteudo do rodapé no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar o conteudo do rodapé.
     *
     * @return void
     */
    private function editFooter(): void
    {
        if (!empty($this->dataForm['SendEditFooter'])) {
            unset($this->dataForm['SendEditFooter']);
            $editFooter = new \App\sts\Models\StsEditFooter();
            $editFooter->update($this->dataForm);
            if ($editFooter->getResult()) {
                $urlRedirect = URLADM . "view-footer/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditFooter();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo do rodapé não encontrado!</p>";
            $urlRedirect = URLADM . "view-footer/index";
            header("Location: $urlRedirect");
        }
    }
}
