<?php
namespace MeuProjeto\models;
use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use PDO;

class ModeloMusica {
    
    function __construct() {
        
    }
    
    public function setMusica($titulo , $artista , $genero , $caminho) {
        try {
                $sql = "INSERT INTO `musicas` (`codigo`, `titulo`, `artista`, `genero`, `caminho`) VALUES (NULL, ?, ?, ?, ?)";
                $p_sql = Conexao::getInstance()->prepare($sql);
                $p_sql->bindValue(1, $titulo);
                $p_sql->bindValue(2, $artista);
                $p_sql->bindValue(3, $genero);
                $p_sql->bindValue(4, $caminho);
                if ($p_sql->execute())
                    $msg = "arquivo enviado com sucesso";
            } catch (Exception $e) {
                $msg = "Ocorreu um erro ao tentar executar esta ação. <br> $e";
            }            
    }
    
    public function getMusica($id) {
        try {
            $sql = "select * from t1 where id = :id";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':id', $id);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            
        }
    }
    
}
