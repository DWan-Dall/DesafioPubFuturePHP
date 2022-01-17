<?php

require_once __DIR__ . '/../manipulacao-dados/Conexao.php';

class Despesas
{
    private $id;
    private $nome;
    private $valor;
    private $data_pagamento;
    private $data_pagamento_esperado;
    private $conta;
    private $tipo_despesa;
    private $creat_at;
    private $update_at;

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

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }

    public function getData_pagamento() {
        return $this->data_pagamento;
    }

    public function setData_pagamento($data_pagamento) {
        $this->data_pagamento = $data_pagamento;
        return $this;
    }

    public function getData_pagamento_esperado() {
        return $this->data_pagamento_esperado;
    }

    public function setData_pagamento_esperado($data_pagamento_esperado) {
        $this->data_pagamento_esperado = $data_pagamento_esperado;
        return $this;
    }

    public function getConta() {
        return $this->conta;
    }

    public function setConta($conta) {
        $this->conta = $conta;
        return $this;
    }

    public function getTipo_despesa() {
        return $this->tipo_despesa;
    }

    public function setTipo_despesa($tipo_despesa) {
        $this->tipo_despesa = $tipo_despesa;
        return $this;
    }

    public function getCreat_at() {
        return $this->creat_at;
    }

    public function setCreat_at($creat_at) {
        $this->creat_at = $creat_at;
        return $this;
    }
    public function getUpdate_at() {
        return $this->update_at;
    }

    public function setUpdate_at($update_at) {
        $this->update_at = $update_at;
        return $this;
    }

    public function adicionarDespesas($nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa)
    {
        $this->dados($nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa);
        try {
            $stmt = $this->conectar->prepare(
                "INSERT INTO despesas (nome, valor, data_pagamento, data_pagamento_esperado, conta, tipo_despesa, created_at, updated_at)
                VALUES (:NOME, :VALOR, :DATA_PAGAMENTO, :DATA_PAGAMENTO_ESPERADO, :CONTA, :TIPO_DESPESA, NOW(), NOW())"
            );
            $stmt->execute(
                array(
                    ":NOME" => $this->getNome(),
                    ":VALOR" => $this->getValor(),
                    ":DATA_PAGAMENTO" => $this->getData_pagamento(),
                    ":DATA_PAGAMENTO_ESPERADO" => $this->getData_pagamento_esperado(),
                    ":CONTA" => $this->getConta(),
                    ":TIPO_DESPESA" => $this->getTipo_despesa(),
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function dados($nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa) {
        $this->setNome($nome);
        $this->setValor($valor);
        $this->setData_pagamento($data_pagamento);
        $this->setData_pagamento_esperado($data_pagamento_esperado);
        $this->setConta($conta);
        $this->setTipo_despesa($tipo_despesa);
    }

    public function editarDespesas($id, $nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa) {
        $this->setid($id);
        $this->dados($nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa);
        try {
            $stmt = $this->conectar->prepare(
                "UPDATE despesas SET nome=:NOME, valor=:VALOR, data_pagamento=:DATA_PAGAMENTO, data_pagamento_esperado=:DATA_PAGAMENTO_ESPERADO, conta=:CONTA, tipo_despesa=:TIPO_DESPESA, updated_at=NOW()
                    WHERE id=:ID"
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":NOME" => $this->getNome(),
                ":VALOR" => $this->getValor(),
                ":DATA_PAGAMENTO" => $this->getData_pagamento(),
                ":DATA_PAGAMENTO_ESPERADO" => $this->getData_pagamento_esperado(),
                ":CONTA" => $this->getConta(),
                ":TIPO_DESPESA" => $this->getTipo_despesa(),
            ));
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function excluirDespesas($id) {
        $this->setid($id);
        try {
            $stmt = $this->conectar->prepare("DELETE FROM despesas where id = :ID");
            $stmt->execute(array(":ID" => $this->id));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listarDespesas() {
        $stmt = $this->conectar->prepare("SELECT * FROM despesas ORDER BY nome ASC");
        if (! $stmt->execute()) {
            return array();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function carregarDespesas($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare("SELECT * FROM despesas WHERE id=:ID");
        $stmt->execute(array(":ID" => $this->id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $stmt->fetch();
    }
}