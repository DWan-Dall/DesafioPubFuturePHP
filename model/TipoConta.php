<?php

require_once __DIR__ . '/../manipulacao-dados/Conexao.php';

class TipoConta
{
    private $id;
    private $nome;
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

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
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

    public function carregarTipoConta($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare("SELECT * FROM tipo_conta where id = :ID");
        $stmt->execute(array(":ID" => $this->id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $stmt->fetch();
    }
}