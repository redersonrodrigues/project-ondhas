<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar mensagem de contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditContactsMsgs
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo editar mensagem de contato.
     * Receber os dados do formulario.
     * 
     * Se o parametro ID e diferente de vazio e o usuario nao clicou no botao editar, instancia a MODELS para recuperar as informacoes da mensagem de contato no banco de dados, se encontrar instancia o matodo "viewEditContactsMsgs". Se nao existir redireciona para o listar mensagem de contato.
     * 
     * Se nao existir mensagem de contato clicar no botao acessa o ELSE e instancia o método "editContactsMsgs".
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditContactsMsgs']))) {
            $this->id = (int) $id;
            $viewContactsMsgs = new \App\sts\Models\StsEditContactsMsgs();
            $viewContactsMsgs->viewContactsMsgs($this->id);
            if ($viewContactsMsgs->getResult()) {
                $this->data['form'] = $viewContactsMsgs->getResultBd();
                $this->viewEditContactsMsgs();
            } else {
                $urlRedirect = URLADM . "list-contacts-msgs/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editContactsMsgs();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditContactsMsgs(): void
    {
        $this->data['sidebarActive'] = "list-contacts-msgs"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contactsMsgs/editContactsMsgs", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar mensagem de contato.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a mensagem de contato no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina listar mensagem de contato.
     *
     * @return void
     */
    private function editContactsMsgs(): void
    {
        if (!empty($this->dataForm['SendEditContactsMsgs'])) {
            unset($this->dataForm['SendEditContactsMsgs']);
            $editContactsMsgs = new \App\sts\Models\StsEditContactsMsgs();
            $editContactsMsgs->update($this->dataForm);
            if($editContactsMsgs->getResult()){
                $urlRedirect = URLADM . "view-contacts-msgs/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditContactsMsgs();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem de contato não encontrada!</p>";
            $urlRedirect = URLADM . "list-contacts-msgs/index";
            header("Location: $urlRedirect");
        }
    }
}
