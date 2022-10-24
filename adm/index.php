<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ONDHAS - Administrativo</title>
    </head>

    <body>

        <?php 

            //Carregar o Composer

            require './vendor/autoload.php';

            

            //Instanciar a classe ConfigController, responsável em tratar a URL

            $home = new Core\ConfigController();



            //Instanciar o método para carregar a página/controller

            $home->loadPage();

        ?>

    </body>

</html>