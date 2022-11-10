<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}

?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Conteúdo do Rodapé</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "view-footer/index' class='btn-primary'>Visualizar</a> ";
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
            <span id="msg"></span>
        </div>

        <div class="content-adm">
            <form method="POST" action="" id="form-edit-footer" class="form-adm">
                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <div class="row-input">
                    <div class="column">
                        <?php
                        $footer_desc = "";
                        if (isset($valorForm['footer_desc'])) {
                            $footer_desc = $valorForm['footer_desc'];
                        }
                        ?>
                        <label class="title-input">Descrição:<span class="text-danger">*</span></label>
                        <input type="text" name="footer_desc" id="footer_desc" class="input-adm" placeholder="Digite a descrição" value="<?php echo $footer_desc; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $footer_text_link = "";
                        if (isset($valorForm['footer_text_link'])) {
                            $footer_text_link = $valorForm['footer_text_link'];
                        }
                        ?>
                        <label class="title-input">Texto do Link:<span class="text-danger">*</span></label>
                        <input type="text" name="footer_text_link" id="footer_text_link" class="input-adm" placeholder="Digite o texto do link" value="<?php echo $footer_text_link; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $footer_link = "";
                        if (isset($valorForm['footer_link'])) {
                            $footer_link = $valorForm['footer_link'];
                        }
                        ?>
                        <label class="title-input">Link:<span class="text-danger">*</span></label>
                        <input type="text" name="footer_link" id="footer_link" class="input-adm" placeholder="Digite o link" value="<?php echo $footer_link; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditFooter" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->