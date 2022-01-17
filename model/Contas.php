<?php

require_once __DIR__ . '/../manipulacao-dados/Conexao.php';

class Contas
{
    private $id;
    private $saldo;
    private $tipo_conta;
    private $instituicao_financeira;
    private $created_at;
    private $updated_at;

    private $conectar;

    public function __construct() {
        $this->conectar = Conexao::getInstance();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
        return $this;
    }

    public function getTipo_conta() {
        return $this->tipo_conta;
    }

    public function setTipo_conta($tipo_conta) {
        $this->tipo_conta = $tipo_conta;
        return $this;
    }

    public function getInstituicao_financeira() {
        return $this->instituicao_financeira;
    }

    public function setInstituicao_financeira($instituicao_financeira) {
        $this->instituicao_financeira = $instituicao_financeira;
        return $this;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setCreated_at($created_at) {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function adicionarContas($saldo, $tipo_conta, $instituicao_financeira)
    {
        $this->dados($saldo, $tipo_conta, $instituicao_financeira);
        try {
            $stmt = $this->conectar->prepare(
                "INSERT INTO contas (saldo, tipo_conta, instituicao_financeira, created_at, updated_at)
                VALUES (:SALDO, :TIPO_CONTA, :INSTITUICAO_FINANCEIRA, NOW(), NOW())"
            );
            $stmt->execute(
                array(
                    ":SALDO" => $this->getSaldo(),
                    ":TIPO_CONTA" => $this->getTipo_conta(),
                    ":INSTITUICAO_FINANCEIRA" => $this->getInstituicao_financeira(),
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function dados($saldo, $tipo_conta, $instituicao_financeira) {
        $this->setSaldo($saldo);
        $this->setTipo_conta($tipo_conta);
        $this->setInstituicao_financeira($instituicao_financeira);
    }

    public function editarContas($id, $saldo, $tipo_conta, $instituicao_financeira) {
        $this->setid($id);
        $this->dados($saldo, $tipo_conta, $instituicao_financeira);
        try {
            $stmt = $this->conectar->prepare(
                "UPDATE contas SET saldo=:SALDO, tipo_conta=:TIPO_CONTA, instituicao_financeira=:INSTITUICAO_FINANCEIRA, updated_at=NOW()
                    WHERE id=:ID"
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":INSTITUICAO_FINANCEIRA" => $this->getInstituicao_financeira(),
                ":TIPO_CONTA" => $this->getTipo_conta(),
                ":SALDO" => $this->getSaldo(),
            ));
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function excluirContas($id) {
        $this->setid($id);
        try {
            $stmt = $this->conectar->prepare("DELETE FROM contas where id = :ID");
            $stmt->execute(array(":ID" => $this->id));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listarContas() {
        $stmt = $this->conectar->prepare("SELECT * FROM contas ORDER BY instituicao_financeira ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function carregarContas($id) {
        $this->setid($id);
        $stmt = $this->conectar->prepare("SELECT * FROM contas where id = :ID");
        $stmt->execute(array(":ID" => $this->id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $stmt->fetch();
    }

    public function transferirSaldo($id, $valor, $saldo) {

        $this->getId();
        $saldo = $this->getSaldo();

        if ($valor > $saldo) {
            echo "Seu saldo não é suficiente para efetuar a transferência!";
            return;
        }

        $saldo = $saldo - $valor;
        $saldo = $this->getSaldo() + $valor;
            echo "Transferência realizada com sucesso no valor de: " . $valor;
    }

    public function recebeSaldo($id, $valor) {

    }
}