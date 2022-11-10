<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar situação
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditSituations
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo editar situação.
     * Receber os dados do formulario.
     * 
     * Se o parametro ID e diferente de vazio e o usuario nao clicou no botao editar, instancia a MODELS para recuperar as informacoes da situação no banco de dados, se encontrar instancia o metodo "viewEditSituations". Se nao existir redireciona para o listar situação.
     * 
     * Se nao existir situação clicar no botao acessa o ELSE e instancia o método "editSituations".
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditSituations']))) {
            $this->id = (int) $id;
            $viewSituations = new \App\sts\Models\StsEditSituations();
            $viewSituations->viewSituations($this->id);
            if ($viewSituations->getResult()) {
                $this->data['form'] = $viewSituations->getResultBd();
                $this->viewEditSituations();
            } else {
                $urlRedirect = URLADM . "list-situations/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editSituations();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditSituations(): void
    {
        $this->data['sidebarActive'] = "list-situations"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/situations/editSituations", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar situação.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a situação no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina listar situação.
     *
     * @return void
     */
    private function editSituations(): void
    {
        if (!empty($this->dataForm['SendEditSituations'])) {
            unset($this->dataForm['SendEditSituations']);
            $editSituations = new \App\sts\Models\StsEditSituations();
            $editSituations->update($this->dataForm);
            if($editSituations->getResult()){
                $urlRedirect = URLADM . "view-situations/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditSituations();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação não encontrada!</p>";
            $urlRedirect = URLADM . "list-situations/index";
            header("Location: $urlRedirect");
        }
    }
}
