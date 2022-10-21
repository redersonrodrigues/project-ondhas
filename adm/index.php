<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ONDHAS - Administrativo</title>
    </head>

    <body>
        <?php 
            //require './core/ConfigController.php';

            require './vendor/autoload.php';

            $home = new Core\ConfigController();

            $home->loadPage();

        ?>

    </body>

</html>