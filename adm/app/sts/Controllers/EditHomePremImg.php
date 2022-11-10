<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar imagem do serviço premium da pagina home
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class EditHomePremImg
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Metodo editar imagem do serviço premium da pagina home
     * Receber os dados do formulario.
     * 
     * Quando o usuario clicar no botao "editar" do formulario da pagina editar imagem do serviço premium da pagina home. Acessa o IF e instancia o metodo "AdmsEditHomePremImg".
     * Senao, instancia a MODELS e recupera os dados da imagem do serviço premium da pagina home no banco de dados.
     * 
     * Existindo a imagem do serviço premium da pagina home no banco de dados, recebe os dados da imagem do serviço premium da pagina home e instancia o metodo viewEditHomePremImg.
     * Senao redireciona o usuario para pagina de visualizar detalhes do conteudo da pagina home
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendEditHomePremImg'])) {
           $this->editHomePremImg();
        } else {
            $viewHomePremImg = new \App\sts\Models\StsEditHomePremImg();
            $viewHomePremImg->viewHomePremImg();
            if ($viewHomePremImg->getResult()) {
                $this->data['form'] = $viewHomePremImg->getResultBd();
                $this->viewEditHomePremImg();
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
    private function viewEditHomePremImg(): void
    {
        $this->data['sidebarActive'] = "view-page-home"; 
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/editHomePremImg", $this->data);
        $loadView->loadViewSts();
    }

    /**
     * Editar imagem do servico premium da pagina home.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a imagem do servico premium da pagina home no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina visualizar detalhes do conteudo da pagina home.
     *
     * @return void
     */
    private function editHomePremImg(): void
    {
        if (!empty($this->dataForm['SendEditHomePremImg'])) {
            unset($this->dataForm['SendEditHomePremImg']);
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            $editHomePremImg = new \App\sts\Models\StsEditHomePremImg();
            $editHomePremImg->update($this->dataForm);
            if ($editHomePremImg->getResult()) {
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomePremImg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Imagem do serviço premium da página home não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
