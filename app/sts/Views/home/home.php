<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "<h1>Página Inicial</h1>";

//var_dump($this->data[0]);
//echo "ID: {$this->data['id']}<br>";

extract($this->data[0]);
echo "ID: $id <br>";
echo "Título: $title_top <br>";
echo "Descrição: $description_top <br>";
echo "Link do botão: $link_btn_top <br>";
echo "Texto do botão: $txt_btn_top <br>";
echo "Nome da imagem: $image <br>";


//Testar o acesso ao arquivo
//http://localhost/project-ondhas/app/sts/Views/home/home.php

//Testar o acesso ao arquivo
//http://localhost/project-ondhas/app/sts/