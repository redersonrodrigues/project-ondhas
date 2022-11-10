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
            <span class="title-content">Editar Conteúdo dos Serviços</span>
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
            <form method="POST" action="" id="form-edit-home-serv" class="form-adm">
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
                        $serv_title = "";
                        if (isset($valorForm['serv_title'])) {
                            $serv_title = $valorForm['serv_title'];
                        }
                        ?>
                        <label class="title-input">Título:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_title" id="serv_title" class="input-adm" placeholder="Digite o título" value="<?php echo $serv_title; ?>" >
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_title_one = "";
                        if (isset($valorForm['serv_title_one'])) {
                            $serv_title_one = $valorForm['serv_title_one'];
                        }
                        ?>
                        <label class="title-input">Título Um:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_title_one" id="serv_title_one" class="input-adm" placeholder="Digite o título do serviço um" value="<?php echo $serv_title_one; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_icon_one = "";
                        if (isset($valorForm['serv_icon_one'])) {
                            $serv_icon_one = $valorForm['serv_icon_one'];
                        }
                        ?>
                        <label class="title-input">Ícone Um:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_icon_one" id="serv_icon_one" class="input-adm" placeholder="Digite o ícone do serviço um" value="<?php echo $serv_icon_one; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_desc_one = "";
                        if (isset($valorForm['serv_desc_one'])) {
                            $serv_desc_one = $valorForm['serv_desc_one'];
                        }
                        ?>
                        <label class="title-input">Descrição Um:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_desc_one" id="serv_desc_one" class="input-adm" placeholder="Digite a descrição do serviço um" value="<?php echo $serv_desc_one; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_title_two = "";
                        if (isset($valorForm['serv_title_two'])) {
                            $serv_title_two = $valorForm['serv_title_two'];
                        }
                        ?>
                        <label class="title-input">Título Dois:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_title_two" id="serv_title_two" class="input-adm" placeholder="Digite o título do serviço dois" value="<?php echo $serv_title_two; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_icon_two = "";
                        if (isset($valorForm['serv_icon_two'])) {
                            $serv_icon_two = $valorForm['serv_icon_two'];
                        }
                        ?>
                        <label class="title-input">Ícone Dois:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_icon_two" id="serv_icon_two" class="input-adm" placeholder="Digite o ícone do serviço dois" value="<?php echo $serv_icon_two; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_desc_two = "";
                        if (isset($valorForm['serv_desc_two'])) {
                            $serv_desc_two = $valorForm['serv_desc_two'];
                        }
                        ?>
                        <label class="title-input">Descrição Dois:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_desc_two" id="serv_desc_two" class="input-adm" placeholder="Digite a descrição do serviço dois" value="<?php echo $serv_desc_two; ?>" required>
                    </div>
                </div>


                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_title_three = "";
                        if (isset($valorForm['serv_title_three'])) {
                            $serv_title_three = $valorForm['serv_title_three'];
                        }
                        ?>
                        <label class="title-input">Título Três:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_title_three" id="serv_title_three" class="input-adm" placeholder="Digite o título do serviço três" value="<?php echo $serv_title_three; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_icon_three = "";
                        if (isset($valorForm['serv_icon_three'])) {
                            $serv_icon_three = $valorForm['serv_icon_three'];
                        }
                        ?>
                        <label class="title-input">Ícone Três:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_icon_three" id="serv_icon_three" class="input-adm" placeholder="Digite o ícone do serviço três" value="<?php echo $serv_icon_three; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $serv_desc_three = "";
                        if (isset($valorForm['serv_desc_three'])) {
                            $serv_desc_three = $valorForm['serv_desc_three'];
                        }
                        ?>
                        <label class="title-input">Descrição Três:<span class="text-danger">*</span></label>
                        <input type="text" name="serv_desc_three" id="serv_desc_three" class="input-adm" placeholder="Digite a descrição do serviço três" value="<?php echo $serv_desc_three; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditHomeServ" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->