<?php

namespace MeuProjeto\models;

class ModeloUsuario {
    private static $instancia = null;
    
    private function __construct() {
        
    }
    
    public static function getInstance() {
        if (self::$instancia == NULL) {
            self::$instancia = new ClienteDAO();
        }
        return self::$instancia;
    }
    public function inserirCliente(Cliente $cliente) {
       echo('teste');
        /*try {      
            $sql = "INSERT INTO `cliente`(`idUsuario`, `nome`, `rg`, `cpf`, `endereco`, "
                    . "`cidade`, `uf`, `cep`, `telefone`, `email`, `senha`, `status`, "
                    . "`dataCadastro`, `dataExclusao`) VALUES "
                    . "(null,?,?,?,?,?,?,?,?,?,?,0,NOW(),null)";
            
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $cliente->getNome());
            $p_sql->bindValue(2, $cliente->getRg());
            $p_sql->bindValue(3, $cliente->getCpf());
            $p_sql->bindValue(4, $cliente->getEndereco());
            $p_sql->bindValue(5, $cliente->getCidade());
            $p_sql->bindValue(6, $cliente->getUf());
            $p_sql->bindValue(7, $cliente->getCep());
            $p_sql->bindValue(8, $cliente->getTelefone());
            $p_sql->bindValue(9, $cliente->getEmail());
            $p_sql->bindValue(10, $cliente->getSenha());
                    
            if ($p_sql->execute())
                return Conexao::getInstance()->lastInsertId();
            return 0;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }*/
    }
}
