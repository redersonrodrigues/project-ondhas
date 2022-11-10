<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Apagar a situação no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsDeleteSituations
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Metodo recebe como parametro o ID que sera usado para excluir o registro da tabela sts_situations
     * Chama a função viewSituations para verificar se a situação esta cadastrada no sistema
     * @param integer $id
     * @return void
     */
    public function deleteSituations(int $id): void
    {
        $this->id = (int) $id;

        if($this->viewSituations()){
            $deleteSituations = new \App\adms\Models\helper\AdmsDelete();
            $deleteSituations->exeDelete("sts_situations", "WHERE id =:id", "id={$this->id}");
    
            if ($deleteSituations->getResult()) {
                $_SESSION['msg'] = "<p class='alert-success'>Situação apagada com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação não apagada com sucesso!</p>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    }

    /**
     * Metodo faz a pesquisa para verificar se a situação esta cadastrada no sistema, o resultado he enviado para a funcao deleteSituations
     *
     * @return boolean
     */
    private function viewSituations(): bool
    {

        $viewSituations = new \App\adms\Models\helper\AdmsRead();
        $viewSituations->fullRead("SELECT id FROM sts_situations                           
                            WHERE id=:id
                            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewSituations->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Situação não encontrada!</p>";
            return false;
        }
    }
}
