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
$rotas->add('salvarMusica', new Route('/setMusica', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'setMusica')));
$rotas->add('eletro', new Route('/Eletronica', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'eletronica')));
$rotas->add('pop', new Route('/Pop', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'pop')));
$rotas->add('Rock', new Route('/Rock', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'rock')));
$rotas->add('listsDoSite', new Route('/playlistpadrao', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'listPadrao')));
$rotas->add('criarplaylist', new Route('/addlist', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'criarPlayList')));
$rotas->add('criarplaylistajax', new Route('/addlistajax', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'criarPlayListAjax')));
$rotas->add('myList', new Route('/myList', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'listarMinhasPlay')));
$rotas->add('trazerLista', new Route('/trazLista/{_param}', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'trazList')));
$rotas->add('deletarLista', new Route('/deletarLista', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'deletarList')));
$rotas->add('alterarLista', new Route('/alterarLista', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'alterarList')));
$rotas->add('tirarMusica', new Route('/tirarMusica', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'tirarMusica'))); 
$rotas->add('respostaPesquisa', new Route('/resultadoDaBusca', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'resultadoDaBusca'))); 
$rotas->add('addMusicaInListPessoal', new Route('/addMusicaInListPessoal', array('_controller' =>'MeuProjeto\Controllers\ControlePlayList','_method' => 'addMusicaInListPessoal'))); 
$rotas->add('alterarSenha', new Route('/alterarSenha', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'alterarSenha'))); 
$rotas->add('alterarSenhaAjax', new Route('/alterarSenhaAjax', array('_controller' =>'MeuProjeto\Controllers\ControleUsuario','_method' => 'alterarSenhaAjax'))); 
$rotas->add('relatorioMusicas', new Route('/relatorioMusica', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'relatorioDeMusicaAjax')));
$rotas->add('ListSiteDeslog', new Route('/ListSiteDeslog', array('_controller' =>'MeuProjeto\Controllers\ControleMusica','_method' => 'ListSiteDeslog')));

return $rotas;
