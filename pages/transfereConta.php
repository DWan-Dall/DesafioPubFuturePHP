<?php

require_once __DIR__ . '/../model/Contas.php';

try {

    $contas = new Contas();
    $contas = $contas->listarContas();

} catch (Exception $e) {
    die($e->getMessage());
}

?>
<div class="row">
    <div class="row">
        <div class="col-sm-10">
            <h3>TRANSFERÊNCIA ENTRE CONTAS</h3>
        </div>
    </div>
    <form action="/../DesafioPubFuturePHP/pages/completaTransfere.php" method="POST">
        <div class="col-md-4">
            <div class="form-group">
                <label for="id">De</label>
                <select name="id" class="form-select" onchange="pegaSaldo()" required>
                    <option value="">Selecione...</option>
                    <?php
                    foreach ($contas as $conta_1) {
                        $selected = '';
                        echo "<option value='" . $conta_1->getId() . "' $selected>" . $conta_1->getInstituicao_financeira() . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="valor">Valor a Transferir (R$)</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="valor" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="id2">Para</label>
                <select name="id2" id="id2" class="form-select" required>
                    <option value="">Selecione...</option>
                    <?php
                    foreach ($contas as $conta_2) {
                        $selected = '';
                        echo "<option value='" . $conta_2->getId() . "' $selected>" . $conta_2->getInstituicao_financeira() . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="m-3">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-exchange"></i> Transferir
            </button>
        </div>
    </form>
</div>
