<?php

require_once __DIR__ . '/../model/Receitas.php';
require_once __DIR__ . '/../model/Contas.php';

try {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $ver = filter_input(INPUT_GET, 'ver', FILTER_VALIDATE_BOOLEAN);

    $disabled = '';
    if ($ver) {
        $disabled = 'disabled';
    }

    $receita = new Receitas();
    if ($id) {
        $receita = $receita->carregarReceitas($id);
    } else {
        $receita = new Receitas();
    }

    $contas = new Contas();
    $contas = $contas->listarContas();

} catch (Exception $e) {
    die($e->getMessage());
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!$id) {
                echo "<h3>CADASTRAR RECEITA</h3>";
            } else if ($ver) {
                echo "<h3>VISUALIZAR RECEITA</h3>";
            } else {
                echo "<h3>EDITAR RECEITA</h3>";
            }
            ?>
        </div>
        <div class="col-sm-12">
            <form action="/../DesafioPubFuturePHP/controller/receitas.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $receita->getNome(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="valor">Valor (R$)</label>
                            <input class="form-control" max="10000.00" min="0.00" name="valor" required
                                   step="0.01" value="<?php echo $receita->getValor(); ?>" <?=$disabled ?> type="number">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_recebimento">Data Recebimento</label>
                            <input type="date" class="form-control" name="data_recebimento" id="data_recebimento" value="<?php echo $receita->getData_recebimento(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_recebimento_esperado">Data Recebimento Esperado</label>
                            <input type="date" class="form-control" name="data_recebimento_esperado" id="data_recebimento_esperado" value="<?php echo $receita->getData_recebimento_esperado(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="conta">Conta</label>
                            <select name="conta" id="conta" class="form-select" <?=$disabled ?> required>
                                <option value="">Selecione...</option>
                                <?php
                                foreach ($contas as $conta) {
                                    $selected = '';
                                    if ($conta->getId() == $receita->getConta()) {
                                        $selected = "selected";
                                    }
                                    echo "<option value='" . $conta->getId() . "' $selected>" . $conta->getInstituicao_financeira() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo_receita">Tipo Receita</label>
                            <input type="text" class="form-control" name="tipo_receita" id="tipo_receita" value="<?php echo $receita->getTipo_receita(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" name="descricao" id="descricao" rows="4" cols="100" <?=$disabled ?>><?php echo $receita->getDescricao(); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if ($receita->getId() && $ver) {
                                ?>
                                <a class="btn btn-warning" href="index.php?pagina=cadastrarReceita&id=<?=$receita->getId()?>">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <?php
                            } else if ($receita->getId()) {
                                ?>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-floppy-o"></i> Salvar
                                </button>
                                <?php
                            } else {
                                ?>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i> Cadastrar
                                </button>
                                <button type="reset" class="btn btn-warning">
                                    <i class="fa fa-eraser"></i> Limpar
                                </button>
                                <?php
                            }
                            ?>
                            <a title="voltar" onclick="voltar()" class="btn btn-danger">
                                <i class="fa fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function voltar() {
        window.history.back();
    }
</script>