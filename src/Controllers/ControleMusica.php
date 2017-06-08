<?php

use MeuProjeto\models\ModeloUsuario;
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
    
    
}
