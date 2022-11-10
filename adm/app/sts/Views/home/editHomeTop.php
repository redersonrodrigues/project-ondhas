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
            <span class="title-content">Editar Conteúdo do Topo</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "view-page-home/index' class='btn-primary'>Visualizar</a> ";
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
            <form method="POST" action="" id="form-edit-home-top" class="form-adm">
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
                        $title_one_top = "";
                        if (isset($valorForm['title_one_top'])) {
                            $title_one_top = $valorForm['title_one_top'];
                        }
                        ?>
                        <label class="title-input">Título Um:<span class="text-danger">*</span></label>
                        <input type="text" name="title_one_top" id="title_one_top" class="input-adm" placeholder="Digite o título um" value="<?php echo $title_one_top; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title_two_top = "";
                        if (isset($valorForm['title_two_top'])) {
                            $title_two_top = $valorForm['title_two_top'];
                        }
                        ?>
                        <label class="title-input">Título Dois:<span class="text-danger">*</span></label>
                        <input type="text" name="title_two_top" id="title_two_top" class="input-adm" placeholder="Digite o título dois" value="<?php echo $title_two_top; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title_three_top = "";
                        if (isset($valorForm['title_three_top'])) {
                            $title_three_top = $valorForm['title_three_top'];
                        }
                        ?>
                        <label class="title-input">Título Três:<span class="text-danger">*</span></label>
                        <input type="text" name="title_three_top" id="title_three_top" class="input-adm" placeholder="Digite o título três" value="<?php echo $title_three_top; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $link_btn_top = "";
                        if (isset($valorForm['link_btn_top'])) {
                            $link_btn_top = $valorForm['link_btn_top'];
                        }
                        ?>
                        <label class="title-input">Link do Botão:<span class="text-danger">*</span></label>
                        <input type="text" name="link_btn_top" id="link_btn_top" class="input-adm" placeholder="Digite o link do botão" value="<?php echo $link_btn_top; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $txt_btn_top = "";
                        if (isset($valorForm['txt_btn_top'])) {
                            $txt_btn_top = $valorForm['txt_btn_top'];
                        }
                        ?>
                        <label class="title-input">Texto do Botão:<span class="text-danger">*</span></label>
                        <input type="text" name="txt_btn_top" id="txt_btn_top" class="input-adm" placeholder="Digite o texto do botão" value="<?php echo $txt_btn_top; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditHomeTop" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->