<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller cadastrar situação
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class AddSituations
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Método cadastrar situação
     * Receber os dados do formulario.
     * Quando o usuario clicar no botão "cadastrar" do formulario da pagina nova situação. Acessa o IF e instância a classe "StsAddSituations" responsavel em cadastrar a situação no banco de dados.
     * Situação cadastrada com sucesso, redireciona para a pagina listar situações.
     * Senao, instancia a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddSituations'])){
            //var_dump($this->dataForm);
            unset($this->dataForm['SendAddSituations']);
            $createSituations = new \App\sts\Models\StsAddSituations();
            $createSituations->create($this->dataForm);
            if($createSituations->getResult()){
                $urlRedirect = URLADM . "list-situations/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddSituations();
            }   
        }else{
            $this->viewAddSituations();
        }  
    }

    /**
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAddSituations(): void
    {
        $this->data['sidebarActive'] = "list-situations"; 
        
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/situations/addSituations", $this->data);
        $loadView->loadViewSts();
    }
}
