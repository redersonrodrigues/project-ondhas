<?php

namespace App\adms\Controllers;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página para receber novo link para confirmar e-mail
 * @author Réderson <rederson@ramartecnologia.com.br>
 * http://localhost/project-ondhas/adm/new-conf-email/index
 */
class NewConfEmail
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Método receber novo link para confirmar e-mail. 
     * Receber os dados do formulário.
     * 
     * Se o usuário clicou no botão editar, instancia a MODELS para salvar os dados do usuário no banco de dados sobre o novo link para confirmar e-mail, se editar corretamente redireciona para a página de login, senão carrega o formulário novamente.
     * 
     * Se o usuário não clicar no botão acessa o ELSE e instancia o método "viewNewConfEmail" para carrega o formulário.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm['SendNewConfEmail'])){
            unset($this->dataForm['SendNewConfEmail']);
            $newConfEmail = new \App\adms\Models\AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dataForm);
            if($newConfEmail->getResult()){
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewNewConfEmail();
            }
        }else{
            $this->viewNewConfEmail();
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewNewConfEmail(): void
    {
       $loadView = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->data);
       $loadView->loadViewLogin();
    }
}
