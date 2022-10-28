<?php

namespace App\adms\Controllers;

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
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
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

    private function viewNewConfEmail(): void
    {
       $loadView = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->data);
       $loadView->loadViewLogin();
    }
}
