<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\Models\ModeloProduto;
use Symfony\Component\Routing\RequestContext;

class ControleUsuario {

    private $response;
    private $request;
    private $twig;

    function __construct(Response $response, Request $request, \Twig_Environment $twig) {
        $this->response = $response;
        $this->request = $request;
        $this->twig = $twig;
    }

    public function CadastroDeClientes() {
        return $this->response->setContent($this->twig->render('TemplateCadastroDeClientes.html'));
    }
}
