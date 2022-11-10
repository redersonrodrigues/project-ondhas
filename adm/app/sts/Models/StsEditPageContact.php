<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Editar conteudo da pagina contato no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsEditPageContact
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var array|null $data Recebe as informacoes do formulario */
    private array|null $data;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo para verificar se tem o registro cadastrado no banco de dados
     * @return void
     */
    public function viewPageContact(): void
    {
        $viewPageContact = new \App\adms\Models\helper\AdmsRead();
        $viewPageContact->fullRead(
            "SELECT id, title_contact, desc_contact, icon_company, title_company, desc_company, icon_address, title_address, desc_address, icon_email, title_email, desc_email, title_form FROM sts_contents_contacts
                            LIMIT :limit", "limit=1");

        $this->resultBd = $viewPageContact->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo da página contato não encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo recebe como parametro a informacao que sera editada
     * Instancia o helper AdmsValEmptyField para validar os campos do formulario
     * Chama a funcao edit para enviar as informacoes para o banco de dados
     * @param array|null $data
     * @return void
     */
    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    /**
     * Metodo envia as informacoes editadas para o banco de dados
     * @return void
     */
    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPageContact = new \App\adms\Models\helper\AdmsUpdate();
        $upPageContact->exeUpdate("sts_contents_contacts", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upPageContact->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Conteúdo da página contato editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo da página contato não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}
