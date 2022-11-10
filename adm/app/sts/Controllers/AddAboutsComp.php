<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller cadastrar sobre empresa
 * @author Cesar <cesar@celke.com.br>
 */
class AddAboutsComp
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Método cadastrar sobre empresa
     * Receber os dados do formulario.
     * Quando o usuario clicar no botão "cadastrar" do formulario da pagina novo sobre empresa. Acessa o IF e instância a classe "AdmsAddAboutsComp" responsavel em cadastrar o sobre empresa no banco de dados.
     * Sobre empresa cadastrado com sucesso, redireciona para a pagina listar registros.
     * Senao, instancia a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddAboutsComp'])){
            //var_dump($this->dataForm);
            unset($this->dataForm['SendAddAboutsComp']);
            $createAboutsComp = new \App\sts\Models\StsAddAboutsComp();
            $createAboutsComp->create($this->dataForm);
            if($createAboutsComp->getResult()){
                $urlRedirect = URLADM . "list-abouts-comp/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddAboutsComp();
            }   
        }else{
            $this->viewAddAboutsComp();
        }  
    }

    /**
     * Instanciar a MODELS e o metodo "listSelect" responsavel em buscar os dados para preencher o campo SELECT 
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAddAboutsComp(): void
    {
        $listSelect = new \App\sts\Models\StsAddAboutsComp();
        $this->data['select'] = $listSelect->listSelect();

        $this->data['sidebarActive'] = "list-abouts-comp"; 
        
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/aboutsComp/addAboutsComp", $this->data);
        $loadView->loadViewSts();
    }
}
