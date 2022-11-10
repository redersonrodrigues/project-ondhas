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
            <span class="title-content">Editar Conteúdo do Serviço Premium</span>
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
            <form method="POST" action="" id="form-edit-home-prem" class="form-adm">
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
                        $prem_title = "";
                        if (isset($valorForm['prem_title'])) {
                            $prem_title = $valorForm['prem_title'];
                        }
                        ?>
                        <label class="title-input">Título:<span class="text-danger">*</span></label>
                        <input type="text" name="prem_title" id="prem_title" class="input-adm" placeholder="Digite o título do serviço premium" value="<?php echo $prem_title; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $prem_subtitle = "";
                        if (isset($valorForm['prem_subtitle'])) {
                            $prem_subtitle = $valorForm['prem_subtitle'];
                        }
                        ?>
                        <label class="title-input">Subtítulo:<span class="text-danger">*</span></label>
                        <input type="text" name="prem_subtitle" id="prem_subtitle" class="input-adm" placeholder="Digite o Subtítulo do serviço premium" value="<?php echo $prem_subtitle; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $prem_desc = "";
                        if (isset($valorForm['prem_desc'])) {
                            $prem_desc = $valorForm['prem_desc'];
                        }
                        ?>
                        <label class="title-input">Descrição:<span class="text-danger">*</span></label>
                        <textarea name="prem_desc" rows="5" id="prem_desc" class="input-adm" placeholder="Digite a descrição do serviço premium" required><?php echo $prem_desc; ?></textarea>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $prem_btn_link = "";
                        if (isset($valorForm['prem_btn_link'])) {
                            $prem_btn_link = $valorForm['prem_btn_link'];
                        }
                        ?>
                        <label class="title-input">Link do Botão:<span class="text-danger">*</span></label>
                        <input type="text" name="prem_btn_link" id="prem_btn_link" class="input-adm" placeholder="Digite o link do botão" value="<?php echo $prem_btn_link; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $prem_btn_text = "";
                        if (isset($valorForm['prem_btn_text'])) {
                            $prem_btn_text = $valorForm['prem_btn_text'];
                        }
                        ?>
                        <label class="title-input">Texto do Botão:<span class="text-danger">*</span></label>
                        <input type="text" name="prem_btn_text" id="prem_btn_text" class="input-adm" placeholder="Digite o texto do botão" value="<?php echo $prem_btn_text; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditHomePrem" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->