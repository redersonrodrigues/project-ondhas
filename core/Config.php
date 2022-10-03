<?php

namespace Core;

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

        define('EMAILADM', 'rederson@ramartecnologia.com.br');
    }
}