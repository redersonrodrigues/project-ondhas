<?php

namespace App\adms\Models\helper;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe genérica para converter o SLUG
 *
 * @author Réderson
 */
class AdmsSlug
{
    /** @var string $text Recebe o texto que dever converter para o SLUG */
    private string $text;

    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;

    /**
     * Metodo faz a conversão da informação em SLUG
     *
     * @param string $text
     * @return string|null
     */    
    public function slug(string $text): string|null
    {
        $this->text = $text;

        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:,\\\'<>°ºª';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-----------------------------------------------------------------------------------------------';
        $this->text = strtr(utf8_decode($this->text), utf8_decode($this->format['a']), $this->format['b']);
        $this->text = str_replace(" ", "-", $this->text);
        $this->text = str_replace(array('-----', '----', '---','--'), '-', $this->text);
        $this->text = strtolower($this->text);

        return $this->text;
    }
}
