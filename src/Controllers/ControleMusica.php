<?php

namespace MeuProjeto\Controllers;

use MeuProjeto\models\ModeloMusica;
use MeuProjeto\Util\Sessao;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

class ControleMusica {

    private $response;
    private $request;
    private $twig;
    private $sessao;

    function __construct(Response $response, Request $request, \Twig_Environment $twig, $sessao) {
        $this->response = $response;
        $this->request = $request;
        $this->twig = $twig;
        $this->sessao = $sessao;
    }

    public function setMusica() {
        $titulo = null;
        $artista = null;
        $genero = null;

        $titulo = $_REQUEST['titulo'];
        $artista = $_REQUEST['artista'];
        $genero = $_REQUEST['genero'];

        if ($titulo == null) {
            echo 'Digite o titulo';
            return;
        }

        if ($artista == null) {
            echo 'Digite o nome do artista';
            return;
        }

        if ($genero == "null") {
            echo 'Selecione o genero ';
            return;
        }

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); // pegar a extensão
        $novo_nome = $titulo . "- " . $artista; // define o nome do arquivo
        $diretorio = "Musicas/";

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome . $extensao)) {
            $caminho = $diretorio . $novo_nome . $extensao;
            $modelo = new ModeloMusica();
            $modelo->setMusica($titulo, $artista, $genero, $caminho);
        } else {
            echo 'Erro ao fazer upload';
        }
    }

    public function getMusica() {
        $id = $_POST['codigo'];
        $modelo = new ModeloMusica();
        $musica = $modelo->getMusica($id);
        echo ($musica['caminho']);
    }

    public function paginaDeUpload() {
        return $this->response->setContent($this->twig->render('subirMusica.html'));
    }

    public function teste() {
        $modelo = new ModeloMusica();
        $tudo = $modelo->seleconaPlayListDaRadio("Eletronica");
        $caminhos = null;

        for ($i = 0; $i < count($tudo); $i++) {
            $caminhos = $caminhos . $tudo[$i]->caminho . "*";
        }
        return $this->response->setContent($this->twig->render('Teste.html', array('lista' => $tudo, 'caminhos' => $caminhos)));
    }

    public function eletronica() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Eletronica");
        $tamanho =  sizeof($musicas);
        if($tamanho == 0){
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('eletronica.html',array('semMusicas' => $string)));
        } else {
            return $this->response->setContent($this->twig->render('eletronica.html',array('musicas' => $musicas)));
        }      
    }

    public function pop() {
        return $this->response->setContent($this->twig->render('pop.html'));
    }

    public function rock() {
        return $this->response->setContent($this->twig->render('rock.html'));
    }
}
