<?php
namespace MeuProjeto\Routes;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rotas = new RouteCollection();

$rotas->add('raiz', new Route('/', array('_controller' =>'MeuProjeto\Controllers\ControleIndex','_method'=> 'index')));
$rotas->add('raizUser', new Route('/indexUser', array('_controller' =>'MeuProjeto\Controllers\ControleIndex','_method'=> 'indexUser')));
$rotas->add('raizAdmin', new Route('/indexAdmin', array('_controller' =>'MeuProjeto\Controllers\ControleIndex','_method'=> 'indexAdmin')));
$rotas->add('cadastro', new Route('/cadastro', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method'=> 'cadastroDeClientes')));
$rotas->add('ajaxCadastro', new Route('/ajaxCadastro', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method'=> 'cadastrar')));
$rotas->add('entrar', new Route('/login', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method'=> 'entrar')));
$rotas->add('login', new Route('/login', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'exibeLogin')));
$rotas->add('validaLogin', new Route('/validaLogin', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'validaLogin')));
return $rotas;
