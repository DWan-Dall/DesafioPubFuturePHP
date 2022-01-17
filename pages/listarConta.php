<?php

require_once __DIR__ . '/../model/Contas.php';
require_once __DIR__ . '/../model/TipoConta.php';

try {
    $conta = new Contas();
    $conta = $conta->listarContas();

    $tipoConta = new TipoConta();


} catch (Exception $e) {
    die($e->getMessage());
}
?>
<div class="row">
    <div class="col-sm-12 border border-secondary">
        <div class="row">
            <div class="col-sm-10">
                &nbsp;
            </div>
        </div>
        <table class="table table-striped" id="table_id">
            <h3>CONTAS CADASTRADAS</h3>
            <thead>
            <tr>
                <th scope="col">Instituição Financeira</th>
                <th scope="col">Tipo da Conta</th>
                <th scope="col">Saldo</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Contas $contas */
            foreach ($conta as $contas) {
                $id = $contas->getTipo_conta();
                $nomeTipo = $tipoConta->carregarTipoConta($id);
                ?>
                <tr>
                    <td><?php echo $contas->getInstituicao_financeira(); ?></td>
                    <td><?php echo $nomeTipo->getNome(); ?></td>
                    <td>R$ <?php echo number_format($contas->getSaldo(), 2, ",","."); ?></td>
                    <td class="col-lg-2">
                        <a href="index.php?pagina=cadastrarConta&id=<?php echo $contas->getId(); ?>&ver=1">
                            <button type="button" class="btn btn-info btn-sm" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                        <a href="index.php?pagina=cadastrarConta&id=<?php echo $contas->getId(); ?>">
                            <button type="button" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </a>
                            <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $contas->getId(); ?>" title="Excluir" onclick="confirmaExclusao()">
                                <i class="fa fa-trash"></i>
                            </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="m-3">
        <a class="btn btn-success" href="index.php?pagina=cadastrarConta">
            <i class="fa fa-plus-circle"></i> Cadastrar
        </a>
        <a class="btn btn-secondary" href="index.php?pagina=transfereConta">
            <i class="fa fa-exchange""></i> Transferência entre Contas
        </a>
    </div>
</div>
<script>
    $(function () {
        $('.btn-danger').on('click', function () {
            if (confirm('Deseja realmente excluir essa conta?')) {
                var id = $(this).data('id');
                document.location = 'controller/contas.php?id=' + id + '&acao=excluir';
            }
        })
    })
</script>