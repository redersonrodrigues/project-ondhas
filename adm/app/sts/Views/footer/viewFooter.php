<?php
if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Rodapé do Site</span>
            <div class="top-list-right">
            </div>
        </div>

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>

        <div class="top-list">
            <span class="title-content">Detalhes do Rodapé</span>
            <div class="top-list-right">
                <?php
                if (!empty($this->data['viewFooter'])) {
                    echo "<a href='" . URLADM . "edit-footer/index' class='btn-warning'>Editar</a> ";
                }
                ?>
            </div>
        </div>

        <div class="content-adm">
            <?php
            if (!empty($this->data['viewFooter'])) {
                extract($this->data['viewFooter'][0]);
            ?>              

                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?php echo $id; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Descrição: </span>
                    <span class="view-adm-info"><?php echo $footer_desc; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Texto do Link: </span>
                    <span class="view-adm-info"><?php echo $footer_text_link; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Link: </span>
                    <span class="view-adm-info"><?php echo $footer_link; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Cadastrado: </span>
                    <span class="view-adm-info"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Editado: </span>
                    <span class="view-adm-info">
                        <?php
                        if (!empty($modified)) {
                            echo date('d/m/Y H:i:s', strtotime($modified));
                        } ?>
                    </span>
                </div>
            <?php
            } else {
                echo "<p class='alert-danger'>Erro: Conteúdo do rodapé não encontrado!</p>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->