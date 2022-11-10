<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Editar sobre empresa no banco de dados
 *
 * @author Celke
 */
class StsEditAboutsComp
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informacoes do formulario */
    private array|null $data;

    /** @var array|null $dataExitVal Recebe os campos que devem ser retirados da validacao */
    private array|null $dataExitVal;

    /** @return bool Retorna true quando executar o processo com sucesso e false quando houver erro */
    function getResult(): bool
    {
        return $this->result;
    }

    /** @return bool Retorna os detalhes do registro */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo recebe como parametro o ID que sera usado para verificar se tem o registro cadastrado no banco de dados
     * @param integer $id
     * @return void
     */
    public function viewAboutsComp(int $id): void
    {
        $this->id = $id;

        $viewAboutsComp = new \App\adms\Models\helper\AdmsRead();
        $viewAboutsComp->fullRead(
            "SELECT id, title, description, sts_situation_id
                            FROM sts_abouts_companies
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );

        $this->resultBd = $viewAboutsComp->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo recebe as informacoes sobre empresa que serao validadas
     * Instancia o helper AdmsValEmptyField para validar os campos do formulario    
     * Chama o metodo valInput para validar os campos especificos do formulario
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

        $upAboutsComp = new \App\adms\Models\helper\AdmsUpdate();
        $upAboutsComp->exeUpdate("sts_abouts_companies", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upAboutsComp->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Sobre empresa editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não editado com sucesso!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo pesquisa as informacoes que serao usadas no dropdown do formulario
     * @return array
     */
    public function listSelect(): array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM sts_situations ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit']];

        return $this->listRegistryAdd;
    }

}
