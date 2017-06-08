<?php
namespace MeuProjeto\models;
use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Conexao;
use PDO;

class ModeloMusica {
    
    function __construct() {
        
    }
    
    public function setMusica(\Symfony\Component\HttpFoundation\File\UploadedFile $imagem) {
        try {
            $sql = "insert into t1 (nome, type, data) values (:nome, :type, :data)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':nome', $imagem->getClientOriginalName());
            $p_sql->bindValue(':type', $imagem->getMimeType());
            $p_sql->bindValue(':data', file_get_contents($imagem->getPathname()));
            return $p_sql->execute();
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
