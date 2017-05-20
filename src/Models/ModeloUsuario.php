<?php

namespace MeuProjeto\models;

use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use PDO;

class ModeloUsuario {

    function __construct() {
        
    }

    public function inserirUsuario(Usuario $u) {
        try {
            $sql = "INSERT INTO `usuario` (`idUsuario`, `nome`, `cpf`, `telefone`, `email`, `login`, `senha`, `status`, `dataCadastro`, `dataExclusao`) "
                    . "VALUES (null, ?, ?, ?, ?, ?, ?, 0, NOW(), NULL)";
            
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $u->getNome());          
            $p_sql->bindValue(2, $u->getCpf());          
            $p_sql->bindValue(3, $u->getTelefone());
            $p_sql->bindValue(4, $u->getEmail());
            $p_sql->bindValue(5, $u->getLogin());
            $p_sql->bindValue(6, $u->getSenha());
            
            if ($p_sql->execute()) {
                return Conexao::getInstance()->lastInsertId();
            }
            return 0;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }   
    }

    public function validaLogin($nome, $senha) {
        try {
            $sql = "SELECT * FROM `usuario` WHERE email = ? and senha = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $nome);
            $p_sql->bindValue(2, $senha);
            $p_sql->execute();
            if ($p_sql->rowCount() == 1) {
                return $p_sql->fetch(PDO::FETCH_OBJ);
            } else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
?>