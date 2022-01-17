<?php

require_once __DIR__ . '/../model/Despesas.php';
require_once __DIR__ . '/../model/Contas.php';

try {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $ver = filter_input(INPUT_GET, 'ver', FILTER_VALIDATE_BOOLEAN);

    $disabled = '';
    if ($ver) {
        $disabled = 'disabled';
    }

    $despesa = new Despesas();
    if ($id) {
        $despesa = $despesa->carregarDespesas($id);
    } else {
        $despesa = new Despesas();
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
                echo "<h3>CADASTRAR DESPESAS</h3>";
            } else if ($ver) {
                echo "<h3>VISUALIZAR DESPESAS</h3>";
            } else {
                echo "<h3>EDITAR DESPESAS</h3>";
            }
            ?>
        </div>
        <div class="col-sm-12">
            <form action="/../DesafioPubFuturePHP/controller/despesas.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $despesa->getNome(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="valor">Valor (R$)</label>
                            <input class="form-control" max="10000.00" min="0.00" name="valor" required
                                   step="0.01" value="<?php echo $despesa->getValor(); ?>" <?=$disabled ?> type="number">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_pagamento">Data Pagamento</label>
                            <input type="date" class="form-control" name="data_pagamento" id="data_pagamento" value="<?php echo $despesa->getData_pagamento(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_pagamento_esperado">Data Pagamento Esperado</label>
                            <input type="date" class="form-control" name="data_pagamento_esperado" id="data_pagamento_esperado" value="<?php echo $despesa->getData_pagamento_esperado(); ?>" <?=$disabled ?> required>
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
                                    if ($conta->getId() == $despesa->getConta()) {
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
                            <label for="tipo_despesa">Tipo Despesa</label>
                            <input type="text" class="form-control" name="tipo_despesa" id="tipo_despesa" value="<?php echo $despesa->getTipo_despesa(); ?>" <?=$disabled ?> required>
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
                            if ($despesa->getId() && $ver) {
                                ?>
                                <a class="btn btn-warning" href="index.php?pagina=cadastrarDespesa&id=<?=$despesa->getId()?>">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <?php
                            } else if ($despesa->getId()) {
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