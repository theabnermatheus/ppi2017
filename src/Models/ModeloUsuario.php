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

    public function validaLogin($login, $senha) {
        try {
            //se o status for 2 , não logar
            $sql = "SELECT * FROM `usuario` WHERE login = ? and senha = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $login);
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

    public function buscaCliente($id) {
        try {
            $sql = "SELECT * FROM `usuario` WHERE idUsuario = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $id);
            $p_sql->execute();
            if ($p_sql->rowCount() == 1) {
                return $p_sql->fetch(PDO::FETCH_OBJ);
            } else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function excluirCliente($id) {
        try {
            $sql = "update usuario set usuario.status = 2 WHERE usuario.idUsuario = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $id);
            if ($p_sql->execute()) {
                return true;
            } else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function alterarCliente($id , $nome, $cpf, $telefone, $email) {
        try {
            $sql = "UPDATE usuario set usuario.nome = ? , usuario.cpf = ? , usuario.telefone = ? , usuario.email = ? WHERE usuario.idUsuario = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $nome);
            $p_sql->bindValue(2, $cpf);
            $p_sql->bindValue(3, $telefone);
            $p_sql->bindValue(4, $email);
            $p_sql->bindValue(5, $id);
            if ($p_sql->execute()) {
                return true;
            } else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
 public function alterarClienteAdmin($id , $nome, $cpf, $telefone, $email, $login , $senha) {
        try {
            $sql = "UPDATE usuario set usuario.nome = ? , usuario.cpf = ? , usuario.telefone = ? , usuario.email = ? ,usuario.login = ? ,usuario.senha = ? WHERE usuario.idUsuario = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $nome);
            $p_sql->bindValue(2, $cpf);
            $p_sql->bindValue(3, $telefone);
            $p_sql->bindValue(4, $email);
            $p_sql->bindValue(5, $login);
            $p_sql->bindValue(6, $senha);
            $p_sql->bindValue(7, $id);
            if ($p_sql->execute()) {
                return true;
            } else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function relatorioCliente() {
        try {
            $sql = "SELECT * FROM usuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();         
                return $p_sql->fetchAll(PDO::FETCH_OBJ);          
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
?>