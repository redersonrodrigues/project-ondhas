<?php

namespace Core;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

abstract class Config
{
    protected function config(): void
    {
        //URL do projeto
        define('URL', 'http://localhost/project-ondhas/');
        define('URLADM', 'http://localhost/project-ondhas/adm/');

        define('CONTROLLER', 'Home'); // carrega a pagina inicial - Home e podemos trocar por qualquer outra
        define('CONTROLLERERRO', 'Erro');

        //Credenciais do banco de dados
		define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'ondhas');
        define('PORT', 3306);		

        define('EMAILADM', 'rederson@ramartecnologia.com.br');
    }
}