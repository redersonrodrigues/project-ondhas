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
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna informações para página Home
     */
    public function index(): array
    {
        //$id = " 1 ' or = 3";
        /*$this->data = [
            "title" => "Topo da pagina",
            "description" => "Descrição do serviço"
        ];*/

        /*$connection = new \Sts\Models\helper\StsConn();
        $this->connection = $connection->connectDb();

        $query_home_top = "SELECT id, title_top, description_top, link_btn_top, txt_btn_top, image 
                        FROM sts_homes_tops 
                        WHERE id =:id
                        LIMIT :limit";
        $result_home_top = $this->connection->prepare($query_home_top);
        $result_home_top->bindValue(':limit', 1, PDO::PARAM_INT);
        $result_home_top->bindValue(':id', 1, PDO::PARAM_INT);

        $result_home_top->execute();
        $this->data = $result_home_top->fetch();*/        

        $viewHome = new \Sts\Models\helper\StsRead();
        $viewHome->exeRead("sts_homes_tops", "WHERE id=:id LIMIT :limit", "id=1&limit=1");
        $this->data= $viewHome->getResult();

        var_dump($this->data);

        //$this->data = [];

        return $this->data;
    }
}
