<?php

namespace Sts\Models;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Models responsável em cadastrar no BD
 * 
 * @author Réderson <rederson@ramartecnologia.com.br>
 */

class StsContato
{

    private array $data;
	/** Função para cadastrar dados na tabela do banco de dados */
    public function create(array $data) :bool
    {
		// Recebe os dados dos campos do formulário contato
        $this->data = $data;
        var_dump($this->data);
        $_SESSION['msg'] = "<p style='color: green;'>Salvar mensagem</p>";
        return false;
    }
}
