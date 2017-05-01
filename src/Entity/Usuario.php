<?php

namespace MeuProjeto\Entity;

class Usuario {
    private $idCliente;
    private $nome;
    private $rg;
    private $cpf;
    private $endereco;
    private $cidade;
    private $uf;
    private $cep;
    private $telefone;
    private $email;
    private $senha;
    private $status;
    private $dataCadastro;
    private $dataExclusao;
    
    function __construct($idCliente, $nome, $rg, $cpf, $endereco, $cidade, $uf, $cep, $telefone, $email, $senha, $status, $dataCadastro, $dataExclusao) {
        $this->idCliente = $idCliente;
        $this->nome = $nome;
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->cep = $cep;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
        $this->status = $status;
        $this->dataCadastro = $dataCadastro;
        $this->dataExclusao = $dataExclusao;             
    }
    
    function getIdCliente() {
        return $this->idCliente;
    }

    function getNome() {
        return $this->nome;
    }

    function getRg() {
        return $this->rg;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function getCep() {
        return $this->cep;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getStatus() {
        return $this->status;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getDataExclusao() {
        return $this->dataExclusao;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setDataExclusao($dataExclusao) {
        $this->dataExclusao = $dataExclusao;
    }
}
