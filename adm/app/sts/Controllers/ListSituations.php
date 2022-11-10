<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller listar situações
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ListSituations
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var string|int|null $page Recebe o número página */
    private string|int|null $page;

    /** @var string|null $searchTitle Recebe o texto para pesquisar */
    private string|null $searchName;

    /**
     * Método listar situações.
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

        $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);

        $listSituations = new \App\sts\Models\StsListSituations();

        if (!empty($this->dataForm['SendSearchSituations'])) {
            $listSituations->listSearchSituations($this->page, $this->dataForm['search_name']);            
            $this->data['form'] = $this->dataForm;
        } elseif (!empty($this->searchMsg)) {
            $listSituations->listSearchSituations($this->page, $this->searchName);            
            $this->data['form']['search_name'] = $this->searchName;
        } else {            
            $listSituations->listSituations($this->page);            
        }

        if ($listSituations->getResult()) {
            $this->data['listSituations'] = $listSituations->getResultBd();
            $this->data['pagination'] = $listSituations->getResultPg();
        } else {
            $this->data['listSituations'] = [];
            $this->data['pagination'] = "";
        }

        $this->data['sidebarActive'] = "list-situations";

        $loadView = new \Core\ConfigView("sts/Views/situations/listSituations", $this->data);
        $loadView->loadView();
    }
}
