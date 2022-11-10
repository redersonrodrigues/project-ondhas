<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar situações do banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsListSituations
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int $page Recebe o número página */
    private int $page;

    /** @var int $page Recebe a quantidade de registros que deve retornar do banco de dados */
    private int $limitResult = 40;

    /** @var string|null $page Recebe a páginação */
    private string|null $resultPg;

    /** @var string|null $searchName Recebe o texto para pesquisar */
    private string|null $searchName;

    /** @var string|null $searchNameValue Recebe o searchName */
    private string|null $searchNameValue;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os registros do BD
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * @return bool Retorna a paginação
     */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    /**
     * Metodo faz a pesquisa da situação na tabela sts_situations e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginacao do resultado
     * @param integer|null $page
     * @return void
     */
    public function listSituations(int $page = null): void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-situations/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM sts_situations");
        $this->resultPg = $pagination->getResult();

        $listSituations = new \App\adms\Models\helper\AdmsRead();
        $listSituations->fullRead("SELECT id, name
                    FROM sts_situations 
                    ORDER BY id DESC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSituations->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhuma situação foi encontrada!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa das situações na tabela sts_situations e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * Recebe o paramentro "search_name" para pesquisar as mensagens atraves do nome
     * @param integer|null $page
     * @param string|null $search_name
     * @return void
     */
    public function listSearchSituations(int $page = null, string|null $search_name): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);

        $this->searchNameValue = "%" . $this->searchName . "%";

        $this->searchSituations();
    }

    /**
     * Metodo pesquisar atraves do nome
     * @return void
     */
    public function searchSituations(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-situations/index', "?search_name={$this->searchName}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result 
                            FROM sts_situations
                            WHERE name LIKE :search_name", "search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();

        $listSituations = new \App\adms\Models\helper\AdmsRead();
        $listSituations->fullRead("SELECT id, name
                    FROM sts_situations
                    WHERE name LIKE :search_name
                    ORDER BY id DESC
                    LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSituations->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhuma situação foi encontrada!</p>";
            $this->result = false;
        }
    }
}
