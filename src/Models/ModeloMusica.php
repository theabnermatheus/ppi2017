<?php
namespace MeuProjeto\models;

use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use PDO;


class ModeloMusica {
    
    function __construct() {
        
    }
    
    public function setMusica($titulo , $artista , $genero , $caminho) {
        try {
            $sql = "INSERT INTO `musicas` (`codigo`, `titulo`, `artista`, `genero`, `caminho`) "
                    . "VALUES (NULL, ?, ?, ?, ?)";                      
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $titulo);
            $p_sql->bindValue(2, $artista);
            $p_sql->bindValue(3, $genero);
            $p_sql->bindValue(4, $caminho);            
            if ($p_sql->execute()) {
                return Conexao::getInstance()->lastInsertId();
            }
            return 0;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }
    
    public function getMusica($id) {
        try {
            $sql = "select caminho from musicas where codigo = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $id);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            
        }
    }
    
    
    public function seleconaPlayListDaRadio($genero){
        try {
            $sql = "select * from musicas where genero = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $genero);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            
        }
    }
    
     public function relatorioMusica() {
        try {
            $sql = "SELECT * FROM musicas";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();         
                return $p_sql->fetchAll(PDO::FETCH_OBJ);          
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
