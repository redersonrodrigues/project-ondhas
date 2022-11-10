<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar sobre empresa
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditAboutsComp
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo editar sobre empresa.
     * Receber os dados do formulario.
     * 
     * Se o parametro ID e diferente de vazio e o usuario nao clicou no botao editar, instancia a MODELS para recuperar as informacoes sobre empresa no banco de dados, se encontrar instancia o matodo "viewEditAboutsComp". Se nao existir redireciona para o listar sobre empresa.
     * 
     * Se nao existir sobre empresa clicar no botao acessa o ELSE e instancia o método "editAboutsComp".
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditAboutsComp']))) {
            $this->id = (int) $id;
            $viewAboutsComp = new \App\sts\Models\StsEditAboutsComp();
            $viewAboutsComp->viewAboutsComp($this->id);
            if ($viewAboutsComp->getResult()) {
                $this->data['form'] = $viewAboutsComp->getResultBd();
                $this->viewEditAboutsComp();
            } else {
                $urlRedirect = URLADM . "list-abouts-comp/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editAboutsComp();
        }
    }

    /**
     * Instanciar a MODELS e o metodo "listSelect" responsavel em buscar os dados para preencher o campo SELECT 
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditAboutsComp(): void
    {        
        $listSelect = new \App\sts\Models\StsEditAboutsComp();
        $this->data['select'] = $listSelect->listSelect();

        $this->data['sidebarActive'] = "list-abouts-comp"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/aboutsComp/editAboutsComp", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar sobre empresa.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente sobre empresa no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina listar usuarios.
     *
     * @return void
     */
    private function editAboutsComp(): void
    {
        if (!empty($this->dataForm['SendEditAboutsComp'])) {
            unset($this->dataForm['SendEditAboutsComp']);
            $editAboutsComp = new \App\sts\Models\StsEditAboutsComp();
            $editAboutsComp->update($this->dataForm);
            if($editAboutsComp->getResult()){
                $urlRedirect = URLADM . "view-abouts-comp/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditAboutsComp();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não encontrado!</p>";
            $urlRedirect = URLADM . "list-abouts-comp/index";
            header("Location: $urlRedirect");
        }
    }
}
