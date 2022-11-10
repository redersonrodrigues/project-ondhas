<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar sobre empresa do banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsListAboutsComp
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

    /** @var string|null $searchTitle Recebe o texto para pesquisar */
    private string|null $searchTitle;

    /** @var string|null $searchEmailValue Recebe o searchTitle */
    private string|null $searchTitleValue;

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
     * Metodo faz a pesquisa sobre empresa na tabela sts_abouts_companies e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginacao do resultado
     * @param integer|null $page
     * @return void
     */
    public function listAboutsComp(int $page = null): void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-abouts-comp/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(comp.id) AS num_result FROM sts_abouts_companies comp");
        $this->resultPg = $pagination->getResult();

        $listAboutsComp = new \App\adms\Models\helper\AdmsRead();
        $listAboutsComp->fullRead("SELECT comp.id, comp.title,
                    sit.name AS name_sit
                    FROM sts_abouts_companies AS comp
                    INNER JOIN sts_situations AS sit ON sit.id=comp.sts_situation_id 
                    ORDER BY comp.id DESC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAboutsComp->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum registro sobre empresa encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa sobre empresa na tabela sts_abouts_companies e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * Recebe o paramentro "search_title" para pesquisar sobre empresa atraves do titulo e descricao
     * @param integer|null $page
     * @param string|null $search_title
     * @return void
     */
    public function listSearchAboutsComp(int $page = null, string|null $search_title): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchTitle = trim($search_title);

        $this->searchTitleValue = "%" . $this->searchTitle . "%";

        $this->searchAboutsComp();
    }

    /**
     * Metodo pesquisar atraves do titulo e descricao
     * @return void
     */
    public function searchAboutsComp(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-abouts-comp/index', "?search_title={$this->searchTitle}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(comp.id) AS num_result 
                            FROM sts_abouts_companies comp
                            WHERE comp.title LIKE :search_title OR comp.description LIKE :search_description", "search_title={$this->searchTitleValue}&search_description={$this->searchTitleValue}");
        $this->resultPg = $pagination->getResult();

        $listAboutsComp = new \App\adms\Models\helper\AdmsRead();
        $listAboutsComp->fullRead("SELECT comp.id, comp.title,
                    sit.name AS name_sit
                    FROM sts_abouts_companies AS comp
                    INNER JOIN sts_situations AS sit ON sit.id=comp.sts_situation_id 
                    WHERE comp.title LIKE :search_title OR comp.description LIKE :search_description
                    ORDER BY comp.id DESC
                    LIMIT :limit OFFSET :offset", "search_title={$this->searchTitleValue}&search_description={$this->searchTitleValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAboutsComp->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum registro sobre empresa encontrado!</p>";
            $this->result = false;
        }
    }
}
