<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller cadastrar mensagem de contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class AddContactsMsgs
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Método cadastrar mensagem de contato
     * Receber os dados do formulario.
     * Quando o usuario clicar no botão "cadastrar" do formulario da pagina nova mensagem de contato. Acessa o IF e instância a classe "StsAddContactsMsgs" responsavel em cadastrar a mensagem de contato no banco de dados.
     * Mensagem cadastrada com sucesso, redireciona para a pagina listar mensagens de contato.
     * Senao, instancia a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddContactsMsgs'])){
            //var_dump($this->dataForm);
            unset($this->dataForm['SendAddContactsMsgs']);
            $createContactsMsgs = new \App\sts\Models\StsAddContactsMsgs();
            $createContactsMsgs->create($this->dataForm);
            if($createContactsMsgs->getResult()){
                $urlRedirect = URLADM . "list-contacts-msgs/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddContactsMsgs();
            }   
        }else{
            $this->viewAddContactsMsgs();
        }  
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAddContactsMsgs(): void
    {
        $this->data['sidebarActive'] = "list-contacts-msgs"; 
        
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contactsMsgs/addContactsMsgs", $this->data);
        $loadView->loadViewSts();
    }
}
