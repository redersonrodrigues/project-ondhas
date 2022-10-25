<?php
namespace Core;
/**
 * Configurações básicas do site.
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
abstract class Config
{
    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function configAdm(): void
    {
        define('URL', 'http://localhost/project-ondhas/');
        define('URLADM', 'http://localhost/project-ondhas/adm/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'ondhas');
        define('PORT', 3306);

        define('EMAILADM', 'rederson@ramartecnologia.com.br');
    }
}
