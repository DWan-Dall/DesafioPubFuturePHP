<?php

require_once __DIR__ . '/../manipulacao-dados/Conexao.php';

class Receitas
{
    private $id;
    private $nome;
    private $valor;
    private $data_recebimento;
    private $data_recebimento_esperado;
    private $descricao;
    private $conta;
    private $tipo_receita;
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

    public function getData_recebimento() {
        return $this->data_recebimento;
    }

    public function setData_recebimento($data_recebimento) {
        $this->data_recebimento = $data_recebimento;
        return $this;
    }

    public function getData_recebimento_esperado() {
        return $this->data_recebimento_esperado;
    }

    public function setData_recebimento_esperado($data_recebimento_esperado) {
        $this->data_recebimento_esperado = $data_recebimento_esperado;
        return $this;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function getConta() {
        return $this->conta;
    }

    public function setConta($conta) {
        $this->conta = $conta;
        return $this;
    }

    public function getTipo_receita() {
        return $this->tipo_receita;
    }

    public function setTipo_receita($tipo_receita) {
        $this->tipo_receita = $tipo_receita;
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

    public function adicionarReceitas($nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita)
    {
        $this->dados($nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita);
        try {
            $stmt = $this->conectar->prepare(
                "INSERT INTO receitas (nome, valor, data_recebimento, data_recebimento_esperado, descricao, conta, tipo_receita, created_at, updated_at)
                VALUES (:NOME, :VALOR, :DATA_RECEBIMENTO, :DATA_RECEBIMENTO_ESPERADO, :DESCRICAO, :CONTA, :TIPO_RECEITA, NOW(), NOW())"
            );
            $stmt->execute(
                array(
                    ":NOME" => $this->getNome(),
                    ":VALOR" => $this->getValor(),
                    ":DATA_RECEBIMENTO" => $this->getData_recebimento(),
                    ":DATA_RECEBIMENTO_ESPERADO" => $this->getData_recebimento_esperado(),
                    ":DESCRICAO" => $this->getDescricao(),
                    ":CONTA" => $this->getConta(),
                    ":TIPO_RECEITA" => $this->getTipo_receita(),
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function dados($nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita) {
        $this->setNome($nome);
        $this->setValor($valor);
        $this->setData_recebimento($data_recebimento);
        $this->setData_recebimento_esperado($data_recebimento_esperado);
        $this->setDescricao($descricao);
        $this->setConta($conta);
        $this->setTipo_receita($tipo_receita);
    }

    public function editarReceitas($id, $nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita) {
        $this->setid($id);
        $this->dados($nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita);
        try {
            $stmt = $this->conectar->prepare(
                "UPDATE receitas SET nome=:NOME, valor=:VALOR, data_recebimento=:DATA_RECEBIMENTO, data_recebimento_esperado=:DATA_RECEBIMENTO_ESPERADO, descricao=:DESCRICAO, conta=:CONTA, tipo_receita=:TIPO_RECEITA, updated_at=NOW()
                    WHERE id=:ID"
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":NOME" => $this->getNome(),
                ":VALOR" => $this->getValor(),
                ":DATA_RECEBIMENTO" => $this->getData_recebimento(),
                ":DATA_RECEBIMENTO_ESPERADO" => $this->getData_recebimento_esperado(),
                ":DESCRICAO" => $this->getDescricao(),
                ":CONTA" => $this->getConta(),
                ":TIPO_RECEITA" => $this->getTipo_receita(),
            ));
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function excluirReceitas($id) {
        $this->setid($id);
        try {
            $stmt = $this->conectar->prepare("DELETE FROM receitas WHERE id = :ID");
            $stmt->execute(array(":ID" => $this->id));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listarReceitas() {
        $stmt = $this->conectar->prepare("SELECT * FROM receitas ORDER BY nome ASC");
        if (! $stmt->execute()) {
            return array();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function carregarReceitas($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare("SELECT * FROM receitas WHERE id=:ID");
        $stmt->execute(array(":ID" => $this->id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $stmt->fetch();
    }

    public function filtro()
    {
        $stmt = $this->conectar->prepare("SELECT * FROM receitas ORDER BY nome ASC");
        if (! $stmt->execute()) {
            return array();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }
}