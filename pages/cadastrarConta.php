<?php

require_once __DIR__ . '/../model/Contas.php';

try {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $ver = filter_input(INPUT_GET, 'ver', FILTER_VALIDATE_BOOLEAN);

    $disabled = '';
    if ($ver) {
        $disabled = 'disabled';
    }

    $conta = new Contas();
    if ($id) {
        $conta = $conta->carregarContas($id);
    } else {
        $conta = new Contas();
    }

} catch (Exception $e) {
    die($e->getMessage());
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!$id) {
                echo "<h3>CADASTRAR CONTA</h3>";
            } else if ($ver) {
                echo "<h3>VISUALIZAR CONTA</h3>";
            } else {
                echo "<h3>EDITAR CONTA</h3>";
            }
            ?>
        </div>
        <div class="col-sm-12">
            <form action="/../DesafioPubFuturePHP/controller/contas.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="instituicao_financeira">Nome Instituição Financeira</label>
                            <input type="text" class="form-control" name="instituicao_financeira" id="instituicao_financeira" value="<?php echo $conta->getInstituicao_financeira(); ?>" <?=$disabled ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo_conta">Tipo da Conta</label>
                            <select name="tipo_conta" class="form-select" aria-label="Default select example" <?=$disabled ?> required>
                                <option value="">Selecione...</option>
                                <option value="1" <?php if ($conta->getTipo_conta() == 1) echo "selected"; ?>>CARTEIRA</option>
                                <option value="2" <?php if ($conta->getTipo_conta() == 2) echo "selected"; ?>>CONTA CORRENTE</option>
                                <option value="3" <?php if ($conta->getTipo_conta() == 3) echo "selected"; ?>>CONTA POUPANÇA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="saldo">Saldo (R$)</label>
                            <input type="number" min="0.00" max="10000.00" step="0.01" name="saldo" class="form-control" value="<?php echo $conta->getSaldo(); ?>" <?=$disabled ?> required>
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
                            if ($conta->getId() && $ver) {
                                ?>
                                <a class="btn btn-warning" href="index.php?pagina=cadastrarConta&id=<?=$conta->getId()?>">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <?php
                            } else if ($conta->getId()) {
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