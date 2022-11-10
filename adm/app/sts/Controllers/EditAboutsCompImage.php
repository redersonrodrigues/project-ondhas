<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar imagem sobre empresa
 * @author Cesar <cesar@celke.com.br>
 */
class EditAboutsCompImage
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Metodo editar imagem sobre empresa.
     * Receber os dados do formulario.
     * 
     * Se o parametro ID e diferente de vazio e o usuario não clicou no botao editar, instancia a MODELS para recuperar as informacoes sobre empresa no banco de dados, se encontrar instancia o metodo "viewEditAboutCompImage". Se nao existir redireciona para o listar sobre empresa.
     * 
     * Se nao existir sobre empresa clicar no botao acessa o ELSE e instancia o metodo "editAboutCompImage".
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditAboutsCompImage']))) {
            $this->id = (int) $id;
            $viewAboutsComp = new \App\sts\Models\StsEditAboutsCompImage();
            $viewAboutsComp->viewAboutsComp($this->id);
            if ($viewAboutsComp->getResult()) {
                $this->data['form'] = $viewAboutsComp->getResultBd();
                $this->viewEditAboutsCompImage();
            } else {
                $urlRedirect = URLADM . "list-abouts-comp/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editAboutsCompImage();
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditAboutsCompImage(): void
    {
        $this->data['sidebarActive'] = "list-abouts-comp"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/aboutsComp/editAboutsCompImage", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar imagem sobre empresa.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente sobre empresa no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina listar sobre empresa.
     *
     * @return void
     */
    private function editAboutsCompImage(): void
    {
        if (!empty($this->dataForm['SendEditAboutsCompImage'])) {
            unset($this->dataForm['SendEditAboutsCompImage']);
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            $editAboutsCompImage = new \App\sts\Models\StsEditAboutsCompImage();
            $editAboutsCompImage->update($this->dataForm);
            if ($editAboutsCompImage->getResult()) {
                $urlRedirect = URLADM . "view-abouts-comp/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditAboutsCompImage();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não encontrado!</p>";
            $urlRedirect = URLADM . "list-abouts-comp/index";
            header("Location: $urlRedirect");
        }
    }
}
