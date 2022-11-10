<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Editar cor no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsEditHomePrem
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
    public function viewHomePrem(): void
    {
        $viewHomePrem = new \App\adms\Models\helper\AdmsRead();
        $viewHomePrem->fullRead(
            "SELECT id, prem_title, prem_subtitle, prem_desc, prem_btn_text, prem_btn_link
                            FROM sts_homes_premiums
                            LIMIT :limit", "limit=1");

        $this->resultBd = $viewHomePrem->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo do serviço premium da página home não encontrado!</p>";
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

        $upHomeTop = new \App\adms\Models\helper\AdmsUpdate();
        $upHomeTop->exeUpdate("sts_homes_premiums", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upHomeTop->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Conteúdo do serviço premium da página home editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Conteúdo do serviço premium da página home não editado com sucesso!</p>";
            $this->result = false;
        }
    }
}
