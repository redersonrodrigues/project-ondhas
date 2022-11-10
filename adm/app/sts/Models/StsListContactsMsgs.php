<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar mensagens de contato do banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsListContactsMsgs
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

    /** @var string|null $searchMsg Recebe o texto para pesquisar */
    private string|null $searchMsg;

    /** @var string|null $searchMsgValue Recebe o searchMsg */
    private string|null $searchMsgValue;

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
     * Metodo faz a pesquisa das mensagens de contaot na tabela sts_contacts_msgs e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginacao do resultado
     * @param integer|null $page
     * @return void
     */
    public function listContactsMsgs(int $page = null): void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-contacts-msgs/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM sts_contacts_msgs");
        $this->resultPg = $pagination->getResult();

        $listContactsMsgs = new \App\adms\Models\helper\AdmsRead();
        $listContactsMsgs->fullRead("SELECT id, name, email, subject
                    FROM sts_contacts_msgs 
                    ORDER BY id DESC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listContactsMsgs->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum registro mensagem foi encontrada!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa das mensagens de contato na tabela sts_contacts_msgs e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * Recebe o paramentro "search_msg" para pesquisar as mensagens atraves do e-mail e assunto
     * @param integer|null $page
     * @param string|null $search_msg
     * @return void
     */
    public function listSearchContactsMsgs(int $page = null, string|null $search_msg): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchMsg = trim($search_msg);

        $this->searchMsgValue = "%" . $this->searchMsg . "%";

        $this->searchContactsMsgs();
    }

    /**
     * Metodo pesquisar atraves do email e assunto
     * @return void
     */
    public function searchContactsMsgs(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-contacts-msgs/index', "?search_msg={$this->searchMsg}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result 
                            FROM sts_contacts_msgs
                            WHERE email LIKE :search_msg OR subject LIKE :search_subject", "search_msg={$this->searchMsgValue}&search_subject={$this->searchMsgValue}");
        $this->resultPg = $pagination->getResult();

        $listContactsMsgs = new \App\adms\Models\helper\AdmsRead();
        $listContactsMsgs->fullRead("SELECT id, name, email, subject
                    FROM sts_contacts_msgs
                    WHERE email LIKE :search_msg OR subject LIKE :search_subject
                    ORDER BY id DESC
                    LIMIT :limit OFFSET :offset", "search_msg={$this->searchMsgValue}&search_subject={$this->searchMsgValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listContactsMsgs->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhuma mensagem foi encontrada!</p>";
            $this->result = false;
        }
    }
}
