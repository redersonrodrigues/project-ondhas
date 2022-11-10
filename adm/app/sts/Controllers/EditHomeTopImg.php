<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar imagem do topo da pagina home
 * @author Cesar <cesar@celke.com.br>
 */
class EditHomeTopImg
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar imagem do topo da pagina home
     * Receber os dados do formulario.
     * 
     * Quando o usuario clicar no botao "editar" do formulario da pagina editar imagem do topo da pagina home. Acessa o IF e instancia o metodo "AdmsEditHomeTopImg".
     * Senao, instancia a MODELS e recupera os dados da imagem do topo da pagina home no banco de dados.
     * 
     * Existindo a imagem do topo da pagina home no banco de dados, recebe os dados da imagem do topo da pagina home e instancia o metodo viewEditHomeTopImg.
     * Senao redireciona o usuario para pagina de visualizar detalhes do conteudo da pagina home
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendEditHomeTopImg'])) {
           $this->editHomeTopImg();
        } else {
            $viewHomeTopImg = new \App\sts\Models\StsEditHomeTopImg();
            $viewHomeTopImg->viewHomeTopImg();
            if ($viewHomeTopImg->getResult()) {
                $this->data['form'] = $viewHomeTopImg->getResultBd();
                $this->viewEditHomeTopImg();
            } else {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        }
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditHomeTopImg(): void
    {
        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/editHomeTopImg", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar imagem do topo da pagina home.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a imagem do topo da pagina home no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar detalhes do conteudo da pagina home.
     *
     * @return void
     */
    private function editHomeTopImg(): void
    {
        if (!empty($this->dataForm['SendEditHomeTopImg'])) {
            unset($this->dataForm['SendEditHomeTopImg']);
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            $editHomeTopImg = new \App\sts\Models\StsEditHomeTopImg();
            $editHomeTopImg->update($this->dataForm);
            if ($editHomeTopImg->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomeTopImg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Imagem do topo da página home não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
