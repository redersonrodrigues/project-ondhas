<?php

namespace Sts\Models;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models responsável em buscar os dados da página home
 *
 * @author Réderson rederson@ramartecnologia.com.br
 */
class StsHome
{
    /** @var array $data Recebe os registros do banco de dados */
    private array $data;

    /** @var object $connection Recebe a conexão com banco de dados */
    private object $connection;


    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array
    {    
        $viewHome = new \Sts\Models\helper\StsRead();
		/** Função exeRead para retornar todas as colunas da consulta */
        //$viewHome->exeRead("sts_homes_tops", "WHERE id=:id LIMIT :limit", "id=1&limit=1");
		/** Função fullRead para retornar colunas especificadas da consulta */
        $viewHome->fullRead("SELECT id, title_top, description_top, link_btn_top, txt_btn_top, image 
                            FROM sts_homes_tops 
                            WHERE id=:id 
                            LIMIT :limit", "id=1&limit=1");
        $this->data= $viewHome->getResult();

        return $this->data;
    }
}
