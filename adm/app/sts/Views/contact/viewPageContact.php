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
            <span class="title-content">Detalhes da Página Contato</span>
            <div class="top-list-right">
                <?php
                if (!empty($this->data['viewContact'])) {
                    echo "<a href='" . URLADM . "edit-page-contact/index' class='btn-warning'>Editar</a> ";
                }
                ?>
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

        <div class="content-adm">
            <?php
            if (!empty($this->data['viewContact'])) {
                extract($this->data['viewContact'][0]);
            ?>
                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?php echo $id; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título: </span>
                    <span class="view-adm-info"><?php echo $title_contact; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Descrição: </span>
                    <span class="view-adm-info"><?php echo $desc_contact; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título Empresa: </span>
                    <span class="view-adm-info"><?php echo $title_company; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Ícone Empresa: </span>
                    <span class="view-adm-info"><i class="icon <?php echo $icon_company; ?>"></i><?php echo " - " . $icon_company; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Descrição Empresa: </span>
                    <span class="view-adm-info"><?php echo $desc_company; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título Endereço: </span>
                    <span class="view-adm-info"><?php echo $title_address; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Ícone Endereço: </span>
                    <span class="view-adm-info"><i class="icon <?php echo $icon_address; ?>"></i><?php echo " - " . $icon_address; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Descrição Endereço: </span>
                    <span class="view-adm-info"><?php echo $desc_address; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título E-mail: </span>
                    <span class="view-adm-info"><?php echo $title_email; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Ícone E-mail: </span>
                    <span class="view-adm-info"><i class="icon <?php echo $icon_email; ?>"></i><?php echo " - " . $icon_email; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Descrição E-mail: </span>
                    <span class="view-adm-info"><?php echo $desc_email; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título Formulário: </span>
                    <span class="view-adm-info"><?php echo $title_form; ?></span>
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
                echo "<p class='alert-danger'>Erro: Conteúdo da página contato não encontrado!</p>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->