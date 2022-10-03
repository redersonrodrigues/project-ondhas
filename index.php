<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!-- Aceitar caracteres especiais -->
    <meta charset="UTF-8">
    <title>Ondhas</title>
</head>

<body>
    <?php
	/** Carregar o composer */
    require './vendor/autoload.php';
	/** Instanciar a classe ConfigController, responsável em tratar a URL */
    $url = new Core\ConfigController();
	/** Instanciar o método para carregar a página/controller */
    $url->loadPage();
    ?>
</body>

</html>