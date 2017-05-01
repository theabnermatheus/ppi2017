<?php
namespace MeuProjeto\Routes;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rotas = new RouteCollection();

$rotas->add('raiz', new Route('/', array('_controller' =>'MeuProjeto\Controllers\ControleIndex','_method'=> 'index')));
$rotas->add('cadastro', new Route('/cadastro', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method'=> 'cadastroDeClientes')));
return $rotas;
