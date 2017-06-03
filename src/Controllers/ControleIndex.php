<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\Models\ModeloProduto;
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
        return $this->response->setContent($this->twig->render('TemplateIndex.html'));
    }

    public function indexUser() {
        if ($this->sessao->get("usuario") == "") {
            $this->response->setContent($this->twig->render('TemplateIndex.html'));
        } else {
            return $this->response->setContent($this->twig->render('TemplateIndexUser.html', array('user' => $this->sessao->get("usuario"))));
        }
    }

    public function indexAdmin() {
        if ($this->sessao->get("usuario") == "") {
            $this->response->setContent($this->twig->render('TemplateIndex.html'));
        } else {
            if($this->sessao->get("usuario")->status == 1){
                return $this->response->setContent($this->twig->render('TemplateIndexAdmin.html', array('user' => $this->sessao->get("usuario"))));
            }else{
                return $this->response->setContent($this->twig->render('TemplateIndexUser.html', array('user' => $this->sessao->get("usuario"))));
            }         
        }
    }

    public function sair() {
        $this->sessao->del();
        return $this->response->setContent($this->twig->render('TemplateIndex.html'));
    }
}
