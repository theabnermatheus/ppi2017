<?php
namespace MeuProjeto\models;
use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use PDO;

class ModeloUsuario {

    function __construct() {
        
    }

    public function inserirUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO `usuario` (`idUsuario`, `nome`, `rg`, `cpf`, `endereco`, `cidade`, "
                    . "`uf`, `cep`, `telefone`, `email`, `senha`, `status`, `dataCadastro`, `dataExclusao`) "
                    . "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, NOW(), NULL)"; 
            
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $usuario->getNome());
            $p_sql->bindValue(2, $usuario->getRg());
            $p_sql->bindValue(3, $usuario->getCpf());
            $p_sql->bindValue(4, $usuario->getEndereco());
            $p_sql->bindValue(5, $usuario->getCidade());
            $p_sql->bindValue(6, $usuario->getUf());
            $p_sql->bindValue(7, $usuario->getCep());
            $p_sql->bindValue(8, $usuario->getTelefone());
            $p_sql->bindValue(9, $usuario->getEmail());
            $p_sql->bindValue(10,$usuario->getSenha());
            if ($p_sql->execute()) {
                return Conexao::getInstance()->lastInsertId();
            }
            return 0;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }
    
    public function emailCorreto($email){
         try {
            $sql = "SELECT idUsuario FROM `usuario` WHERE usuario.email = ?";            
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $email);           
            if ($p_sql->execute()) {
                return $p_sql->fetchAll();;
            }            
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }      
    }
}
?>