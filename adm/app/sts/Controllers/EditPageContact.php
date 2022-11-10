<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar conteudo da pagina contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditPageContact
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar conteudo da pagina contato.
     * Receber os dados do formulario.
     * 
     * Se o usuario nao clicou no botao editar, instancia a MODELS para recuperar as informacoes no banco de dados, se encontrar instancia o metodo "viewEditPageContact". Se nao existir redireciona para o visualizar conteudo da pagina contato.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (empty($this->dataForm['SendEditContact'])) {
            $viewPageContact = new \App\sts\Models\StsEditPageContact();
            $viewPageContact->viewPageContact();
            if ($viewPageContact->getResult()) {
                $this->data['form'] = $viewPageContact->getResultBd();
                $this->viewEditPageContact();
            } else {
                $urlRedirect = URLADM . "view-page-contact/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editPageContact();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditPageContact(): void
    {
        $this->data['sidebarActive'] = "view-page-contact"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contact/editPageContact", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar conteudo da pagina contato.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente conteudo da pagina contato no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar oconteudo da pagina contato.
     *
     * @return void
     */
    private function editPageContact(): void
    {
        if (!empty($this->dataForm['SendEditContact'])) {
            unset($this->dataForm['SendEditContact']);
            $editPageContact = new \App\sts\Models\StsEditPageContact();
            $editPageContact->update($this->dataForm);
            if ($editPageContact->getResult()) {
                $urlRedirect = URLADM . "view-page-contact/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditPageContact();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo da página contato não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-contact/index";
            header("Location: $urlRedirect");
        }
    }
}
