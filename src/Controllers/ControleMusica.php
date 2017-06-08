<?php

use MeuProjeto\models\ModeloUsuario;
use MeuProjeto\models\ModeloMusica;
use MeuProjeto\Entity\Usuario;
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
        $modelo = new ModeloMusica();
        $file = $this->request->files->get('arquivo');
        $modelo->setMusica($file);
        return $this->response->setContent("Imagem salva com sucesso ...");
    }
    public function getMusica($id) {
        $modelo = new ModeloMusica();
        $img = $modelo->getMusica($id);
        return $this->response->setContent($this->twig->render('produto.html', array('nome'=> $img['nome'], 'imagem' => base64_encode(($img['data'])), 'tipo' => $img['type'])));
    }
    
    public function paginaDeUpload(){
        return $this->response->setContent($this->twig->render('subirMusica.html'));
    }
}