<?php
namespace MeuProjeto\models;
use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use PDO;

class ModeloMusica {
    
    function __construct() {
        
    }
    
    public function setMusica(UploadedFile $imagem) {
        try {
            $sql = "INSERT INTO `musica` (`data`) VALUES (?)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(1, file_get_contents($imagem->getPathname()));
            print_r($imagem);
//return $p_sql->execute();
//            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            
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
