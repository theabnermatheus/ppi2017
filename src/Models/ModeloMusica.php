<?php
namespace MeuProjeto\models;

use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use PDO;


class ModeloMusica {
    
    function __construct() {
        
    }
    
    public function setMusica($titulo , $artista , $genero , $caminho) {
        echo 'cheguei aqui';
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
    public function addlist($nome,$user){
        try {
            $sql = "INSERT INTO `playlist` (`idlist`, `idUsuario`, `nome`, `musicas`) VALUES (null, ?, ?, ?)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $user);
            $p_sql->bindValue(2, $nome);
            $p_sql->bindValue(3, "");
            if ($p_sql->execute()) {
                return Conexao::getInstance()->lastInsertId();
            }else{
                return 0;
            }
        } catch (Exception $ex) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }
    
    public function seleconaPlayList($user){
        try {
            $sql = "SELECT playlist.idlist , playlist.nome FROM `playlist` WHERE playlist.idUsuario = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $user);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            
        }
    }
    
    public function verificaDono($user , $id){
        try {
            $sql = "SELECT playlist.idlist from playlist WHERE playlist.idUsuario = ? and playlist.idlist = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $user);
            $p_sql->bindValue(2, $id);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }              
    }  
    
    public function trazLista($id){
        try {
            $sql = "select playlist.musicas from playlist WHERE playlist.idlist = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $id);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }              
    }
    
     public function getMusicaOfList($id) {
        try {
            $sql = "select codigo,caminho,titulo,artista from musicas where codigo = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $id);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
             echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }
    
     public function deletarList($id) {
          try {
            $sql = "DELETE FROM `playlist` WHERE playlist.idlist = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $id);
            if($p_sql->execute()){
                return true;
            }else{
                return false;
            }        
        } catch (Exception $ex) {
             echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }   
    
    public function alterarList($id , $nome) {
          try {
            $sql = "UPDATE `playlist` SET `nome`= ? WHERE playlist.idlist = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $nome);
            $p_sql->bindValue(2, $id);
            if($p_sql->execute()){
                return true;
            }else{
                return false;
            }        
        } catch (Exception $ex) {
             echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }
    
    public function tirarDaLista($novalista,$idDaPlayList) {
          try {
            $sql = "UPDATE `playlist` SET `musicas`= ? WHERE playlist.idlist = ?";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $novalista);
            $p_sql->bindValue(2, $idDaPlayList);
            if($p_sql->execute()){
                return true;
            }else{
                return false;
            }        
        } catch (Exception $ex) {
             echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }  
    
    public function resultadoDaBusca($chave) {
        try {
            $sql = "SELECT * from musicas where musicas.titulo like '% ? %'";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, $chave);
            $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
             echo "Ocorreu um erro ao tentar executar esta ação. <br> $e";
        }
    }
}
