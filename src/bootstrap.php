<?php

namespace MeuProjeto;

error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

include 'routes.php';



$loader = new \Twig_Loader_Filesystem(__DIR__ . '/View');
$twig = new \Twig_Environment($loader);

$requestContext = new RequestContext();
$requestContext->fromRequest(Request::createFromGlobals());
$response = new Response();


// tratar !!!!!
$urlMatcher = new UrlMatcher($rotas, $requestContext);
$atributos = $urlMatcher->match($requestContext->getPathInfo());
//print_r($atributos);

$controlador = new $atributos['_controller']($response, Request::createFromGlobals(), $twig);

if (isset($atributos['_method'])) {
    $metodo = $atributos['_method'];
    if(isset($atributos['_param']))
        $controlador->$metodo($atributos['_param']);
    else
        $controlador->$metodo();
}
    

$response->send();






