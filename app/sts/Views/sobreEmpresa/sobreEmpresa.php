<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "<h1>Sobre Empresa</h1>";

//var_dump($this->data['about-company']);

// Acessa o IF quando encontrou algum registro no banco de dados
if(!empty($this->data['about-company'])){
    foreach($this->data['about-company'] as $about_company){
        //var_dump($about_company);
        //echo "ID: " . $about_company['id'] . "<br>";
        extract($about_company);
        echo "ID: $id <br>";
        echo "Título: $title <br>";
        echo "Descrição: $description <br>";
        echo "Imagem: $image <br>";
        echo "<hr>";
    }
}else{
    echo "<p style='color: #f00;'>Erro: Nenhum registro encontrado</p>";
}