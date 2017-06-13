<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\models\ModeloMusica;
use Symfony\Component\Routing\RequestContext;

class ControleIndex {

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

    public function index() {
        if($this->sessao->get("usuario") == ""){
            return $this->response->setContent($this->twig->render('TemplateIndex.html'));
        }else if($this->sessao->get("usuario")->status == 0){
            return $this->response->setContent($this->twig->render('TemplateIndexUser.html', array('user' => $this->sessao->get("usuario"))));
        }else if($this->sessao->get("usuario")->status == 1){
           return $this->response->setContent($this->twig->render('TemplateIndexAdmin.html', array('user' => $this->sessao->get("usuario"))));
        } 
    }

    public function indexUser() {
        if ($this->sessao->get("usuario") == "") {
            $this->response->setContent($this->twig->render('TemplateIndex.html'));
        } else {
            if ($this->sessao->get("usuario")->status == 0) {
                return $this->response->setContent($this->twig->render('TemplateIndexUser.html', array('user' => $this->sessao->get("usuario"))));
            } else {
                return $this->response->setContent($this->twig->render('TemplateIndexAdmin.html', array('user' => $this->sessao->get("usuario"))));
            }
        }
    }

    public function indexAdmin() {
        if ($this->sessao->get("usuario") == "") {
            $this->response->setContent($this->twig->render('TemplateIndex.html'));
        } else {
            if ($this->sessao->get("usuario")->status == 1) {
                return $this->response->setContent($this->twig->render('TemplateIndexAdmin.html', array('user' => $this->sessao->get("usuario"))));
            } else {
                return $this->response->setContent($this->twig->render('TemplateIndexUser.html', array('user' => $this->sessao->get("usuario"))));
            }
        }
    }

    public function sair() {
        $this->sessao->del();
        return $this->response->setContent($this->twig->render('TemplateIndex.html'));
    }
    
    public function teste() {
        $modelo = new ModeloMusica();
        $tudo = $modelo->seleconaPlayListDaRadio("Eletronica");
        $caminhos = null;
        
        for($i = 0; $i < count($tudo); $i++){            
            $caminhos = $caminhos.$tudo[$i]->caminho."*";
        }      
        return $this->response->setContent($this->twig->render('Teste.html',array('lista' => $tudo , 'caminhos'=>$caminhos)));
    }
}
