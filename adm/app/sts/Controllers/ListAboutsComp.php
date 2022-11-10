<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller listar sobre empresa
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ListAboutsComp
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var string|int|null $page Recebe o número página */
    private string|int|null $page;

    /** @var string|null $searchTitle Recebe o texto para pesquisar */
    private string|null $searchTitle;

    /**
     * Método listar sobre empresa.
     * 
     * Instancia a MODELS responsavel em buscar os registros no banco de dados.
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senao enviar o array de dados vazio.
     *
     * @return void
     */
    public function index(string|int|null $page = null)
    {
        $this->page = (int) $page ? $page : 1;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->searchTitle = filter_input(INPUT_GET, 'search_title', FILTER_DEFAULT);

        $listAboutsComp = new \App\sts\Models\StsListAboutsComp();

        if (!empty($this->dataForm['SendSearchAboutsComp'])) {
            $listAboutsComp->listSearchAboutsComp($this->page, $this->dataForm['search_title']);            
            $this->data['form'] = $this->dataForm;
        } elseif (!empty($this->searchTitle)) {
            $listAboutsComp->listSearchAboutsComp($this->page, $this->searchTitle);            
            $this->data['form']['search_title'] = $this->searchTitle;
        } else {            
            $listAboutsComp->listAboutsComp($this->page);            
        }

        if ($listAboutsComp->getResult()) {
            $this->data['listAboutsComp'] = $listAboutsComp->getResultBd();
            $this->data['pagination'] = $listAboutsComp->getResultPg();
        } else {
            $this->data['listAboutsComp'] = [];
            $this->data['pagination'] = "";
        }

        $this->data['sidebarActive'] = "list-abouts-comp";

        $loadView = new \Core\ConfigView("sts/Views/aboutsComp/listAboutsComp", $this->data);
        $loadView->loadView();
    }
}
