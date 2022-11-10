<?php

namespace App\sts\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller listar mensagens de contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class ListContactsMsgs
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var string|int|null $page Recebe o número página */
    private string|int|null $page;

    /** @var string|null $searchTitle Recebe o texto para pesquisar */
    private string|null $searchMsg;

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

        $this->searchMsg = filter_input(INPUT_GET, 'search_msg', FILTER_DEFAULT);

        $listContactsMsgs = new \App\sts\Models\StsListContactsMsgs();

        if (!empty($this->dataForm['SendSearchContactsMsgs'])) {
            $listContactsMsgs->listSearchContactsMsgs($this->page, $this->dataForm['search_msg']);            
            $this->data['form'] = $this->dataForm;
        } elseif (!empty($this->searchMsg)) {
            $listContactsMsgs->listSearchContactsMsgs($this->page, $this->searchMsg);            
            $this->data['form']['search_msg'] = $this->searchMsg;
        } else {            
            $listContactsMsgs->listContactsMsgs($this->page);            
        }

        if ($listContactsMsgs->getResult()) {
            $this->data['listContactsMsgs'] = $listContactsMsgs->getResultBd();
            $this->data['pagination'] = $listContactsMsgs->getResultPg();
        } else {
            $this->data['listContactsMsgs'] = [];
            $this->data['pagination'] = "";
        }

        $this->data['sidebarActive'] = "list-contacts-msgs";

        $loadView = new \Core\ConfigView("sts/Views/contactsMsgs/listContactsMsgs", $this->data);
        $loadView->loadView();
    }
}
