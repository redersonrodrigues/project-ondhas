<?php

namespace Core;

abstract class Config

{

    protected function configAdm()

    {

        define('URL', 'http://localhost/project-ondhas/');

        define('URLADM', 'http://localhost/project-ondhas/adm/');



        define('CONTROLLER', 'Login');

        define('METODO', 'index');

        define('CONTROLLERERRO', 'Erro');

    } 

}