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
$rotas->add('deslogar', new Route('/sair', array('_controller' =>'MeuProjeto\Controllers\ControleIndex','_method' => 'sair')));
$rotas->add('editarUser', new Route('/editarUser', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'editarUser')));
$rotas->add('excluirUser', new Route('/ajaxExcluir', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'excluirUser')));
$rotas->add('alterarUser', new Route('/ajaxAlterar', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'alterarUser')));
$rotas->add('editarUserAdmin', new Route('/editarUserAdmin', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'editarUserAdmin')));
$rotas->add('buscarUserAdmin', new Route('/buscarUserAdmin', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'buscarUserAdmin')));
$rotas->add('alterarUserAdmin', new Route('/ajaxAlterarAdmin', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'alterarUserAdmin')));
$rotas->add('excluirUserAdmin', new Route('/ajaxExcluirAdmin', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'excluirUserAdmin')));
$rotas->add('relatorio', new Route('/relatorio', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'relatorioDeClientesAjax')));
$rotas->add('subirMusica', new Route('/subirMusica', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'paginaDeUpload')));
return $rotas;
