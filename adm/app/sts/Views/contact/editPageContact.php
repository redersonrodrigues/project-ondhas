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
            <span class="title-content">Editar Contato</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "view-page-contact/index' class='btn-primary'>Visualizar</a> ";
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
            <form method="POST" action="" id="form-edit-contact" class="form-adm">
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
                        $title_contact = "";
                        if (isset($valorForm['title_contact'])) {
                            $title_contact = $valorForm['title_contact'];
                        }
                        ?>
                        <label class="title-input">Título:<span class="text-danger">*</span></label>
                        <input type="text" name="title_contact" id="title_contact" class="input-adm" placeholder="Digite o título da página de contato" value="<?php echo $title_contact; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $desc_contact = "";
                        if (isset($valorForm['desc_contact'])) {
                            $desc_contact = $valorForm['desc_contact'];
                        }
                        ?>
                        <label class="title-input">Descrição:<span class="text-danger">*</span></label>
                        <input type="text" name="desc_contact" id="desc_contact" class="input-adm" placeholder="Digite a descrição da página de contato" value="<?php echo $desc_contact; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title_company = "";
                        if (isset($valorForm['title_company'])) {
                            $title_company = $valorForm['title_company'];
                        }
                        ?>
                        <label class="title-input">Título Empresa:<span class="text-danger">*</span></label>
                        <input type="text" name="title_company" id="title_company" class="input-adm" placeholder="Digite o título da empresa" value="<?php echo $title_company; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $icon_company = "";
                        if (isset($valorForm['icon_company'])) {
                            $icon_company = $valorForm['icon_company'];
                        }
                        ?>
                        <label class="title-input">Ícone Empresa:<span class="text-danger">*</span></label>
                        <input type="text" name="icon_company" id="icon_company" class="input-adm" placeholder="Digite o ícone da empresa" value="<?php echo $icon_company; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $desc_company = "";
                        if (isset($valorForm['desc_company'])) {
                            $desc_company = $valorForm['desc_company'];
                        }
                        ?>
                        <label class="title-input">Descrição Empresa:<span class="text-danger">*</span></label>
                        <input type="text" name="desc_company" id="desc_company" class="input-adm" placeholder="Digite a descrição da empresa" value="<?php echo $desc_company; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title_address = "";
                        if (isset($valorForm['title_address'])) {
                            $title_address = $valorForm['title_address'];
                        }
                        ?>
                        <label class="title-input">Título Endereço:<span class="text-danger">*</span></label>
                        <input type="text" name="title_address" id="title_address" class="input-adm" placeholder="Digite o título do endereço" value="<?php echo $title_address; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $icon_address = "";
                        if (isset($valorForm['icon_address'])) {
                            $icon_address = $valorForm['icon_address'];
                        }
                        ?>
                        <label class="title-input">Ícone Endereço:<span class="text-danger">*</span></label>
                        <input type="text" name="icon_address" id="icon_address" class="input-adm" placeholder="Digite o ícone do endereço" value="<?php echo $icon_address; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $desc_address = "";
                        if (isset($valorForm['desc_address'])) {
                            $desc_address = $valorForm['desc_address'];
                        }
                        ?>
                        <label class="title-input">Descrição Endereço:<span class="text-danger">*</span></label>
                        <input type="text" name="desc_address" id="desc_address" class="input-adm" placeholder="Digite a descrição do endereço" value="<?php echo $desc_address; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title_email = "";
                        if (isset($valorForm['title_email'])) {
                            $title_email = $valorForm['title_email'];
                        }
                        ?>
                        <label class="title-input">Título E-mail:<span class="text-danger">*</span></label>
                        <input type="text" name="title_email" id="title_email" class="input-adm" placeholder="Digite o título do e-mail" value="<?php echo $title_email; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $icon_email = "";
                        if (isset($valorForm['icon_email'])) {
                            $icon_email = $valorForm['icon_email'];
                        }
                        ?>
                        <label class="title-input">Ícone E-mail:<span class="text-danger">*</span></label>
                        <input type="text" name="icon_email" id="icon_email" class="input-adm" placeholder="Digite o ícone do e-mail" value="<?php echo $icon_email; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $desc_email = "";
                        if (isset($valorForm['desc_email'])) {
                            $desc_email = $valorForm['desc_email'];
                        }
                        ?>
                        <label class="title-input">Descrição E-mail:<span class="text-danger">*</span></label>
                        <input type="text" name="desc_email" id="desc_email" class="input-adm" placeholder="Digite a descrição do e-mail" value="<?php echo $desc_email; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title_form = "";
                        if (isset($valorForm['title_form'])) {
                            $title_form = $valorForm['title_form'];
                        }
                        ?>
                        <label class="title-input">Título Formulário:<span class="text-danger">*</span></label>
                        <input type="text" name="title_form" id="title_form" class="input-adm" placeholder="Digite o título do formulário" value="<?php echo $title_form; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditContact" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->