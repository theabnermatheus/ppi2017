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

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome = $titulo . "- " . $artista; 
        $diretorio = "Musicas/";

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome . $extensao)) {
            $caminho = $diretorio . $novo_nome . $extensao;
            $modelo = new ModeloMusica();
            $modelo->setMusica($titulo, $artista, $genero, $caminho);
            echo 'Sucesso';
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
        return $this->response->setContent($this->twig->render('subirMusica.html',array('user' => $this->sessao->get("usuario"))));
    }

    public function eletronica() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Eletronica");
        $tamanho = sizeof($musicas);
        if ($tamanho == 0) {
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('eletronica.html', array('semMusicas' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('eletronica.html', array('musicas' => $musicas, 'user' => $this->sessao->get("usuario"))));
        }
    }

    public function pop() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Pop");
        $tamanho = sizeof($musicas);
        if ($tamanho == 0) {
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('pop.html', array('semMusicas' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('pop.html', array('musicas' => $musicas, 'user' => $this->sessao->get("usuario"))));
        }
    }

    public function rock() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Rock");
        $tamanho = sizeof($musicas);
        if ($tamanho == 0) {
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('rock.html', array('semMusicas' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('rock.html', array('musicas' => $musicas, 'user' => $this->sessao->get("usuario"))));
        }
    }   
    public function relatorioDeMusicaAjax() {
        $modelo = new ModeloMusica();
        $u = $modelo->relatorioMusica();
        if ($this->sessao->get("usuario") == "") {
            echo '<script>alert("Faça login para continuar");</script>';
            echo '<script>window.location.href = "/"</script>';
        } else if ($this->sessao->get("usuario")->status == 0) {
            echo '<script>window.location.href = "/"</script>';
        } else if ($this->sessao->get("usuario")->status == 1) {
            return $this->response->setContent($this->twig->render('TemplateRelMusic.html', array('dados' => $u, 'user' => $this->sessao->get("usuario"))));
        }
    }
    
    public function ListSiteDeslog() {
        $modelo = new ModeloMusica();
        $tudo = $modelo->seleconaPlayListDaRadio("Eletronica");
        $caminhos = null;

        for ($i = 0; $i < count($tudo); $i++) {
            $caminhos = $caminhos . $tudo[$i]->caminho . "*";
        }
        return $this->response->setContent($this->twig->render('listPadraodeslog.html', array('lista' => $tudo, 'caminhos' => $caminhos, 'user' => $this->sessao->get("usuario"))));
    }
}