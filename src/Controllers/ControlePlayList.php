<?php
namespace MeuProjeto\Controllers;
use MeuProjeto\models\ModeloMusica;
use MeuProjeto\models\ModeloPlayList;
use MeuProjeto\Util\Sessao;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;


class ControlePlayList {
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
    
    public function listPadrao() {
        $modelo = new ModeloMusica();
        $tudo = $modelo->seleconaPlayListDaRadio("Eletronica");
        $caminhos = null;

        for ($i = 0; $i < count($tudo); $i++) {
            $caminhos = $caminhos . $tudo[$i]->caminho . "*";
        }
        return $this->response->setContent($this->twig->render('ListPadrao.html', array('lista' => $tudo, 'caminhos' => $caminhos, 'user' => $this->sessao->get("usuario"))));
    }

    public function criarPlayList() {
        if ($this->sessao->get("usuario") == "") {
            echo '<script>alert("Faça login para continuar");</script>';
            echo '<script>window.location.href = "/"</script>';
        } else if ($this->sessao->get("usuario")->status == 0) {
            return $this->response->setContent($this->twig->render('criarPlayList.html', array('user' => $this->sessao->get("usuario"))));
        } else if ($this->sessao->get("usuario")->status == 1) {
            return $this->response->setContent($this->twig->render('criarPlayList.html', array('user' => $this->sessao->get("usuario"))));
        }
    }

    public function criarPlayListAjax() {
        $nome = $_POST['nome'];
        $user = $this->sessao->get("usuario")->idUsuario;
        $modelo = new ModeloPlayList();
        if ($modelo->addlist($nome, $user)) {
            echo '<script>alert("Sucesso");</script>';
            echo '<script>window.location.href = "/myList"</script>';
        } else {
            echo 'erro';
        }
    }

    public function listarMinhasPlay() {
        $user = $this->sessao->get("usuario")->idUsuario;
        $modelo = new ModeloPlayList();
        $lista = $modelo->seleconaPlayList($user);
        $tamanho = sizeof($lista);
        if ($tamanho == 0) {
            $string = null;
            return $this->response->setContent($this->twig->render('listaDoUser.html', array('list' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('listaDoUser.html', array('list' => $lista, 'user' => $this->sessao->get("usuario"))));
        }
    }

    public function trazList($param) {
        $user = $this->sessao->get("usuario")->idUsuario;
        $modelo = new ModeloPlayList();
        $resp = $modelo->verificaDono($user, $param);
        if ($resp) {
            $lista = $modelo->trazLista($param);
            $lista = $lista[0]->musicas;
            $listaDeIdMusicas = str_split($lista);

            for ($i = 0; $i < count($listaDeIdMusicas); $i++) {
                $listaDeMusicas[] = $modelo->getMusicaOfList($listaDeIdMusicas[$i]);
            }

            $tamanho = count($listaDeMusicas);

            if ($tamanho != 1) {
                return $this->response->setContent($this->twig->render('MusicasDoUser.html', array('codigoDaList' => $param, 'list' => $listaDeMusicas, 'user' => $this->sessao->get("usuario"))));
            } else {
                return $this->response->setContent($this->twig->render('MusicasDoUser.html', array('list' => $listaDeMusicas, 'user' => $this->sessao->get("usuario"))));
            }
        } else {
            echo '<script>alert("voce não tem permissão para acessar aqui");</script>';
            echo '<script>window.location.href = "/"</script>';
        }
    }

    public function deletarList() {
        $id = $_POST['id'];
        $modelo = new ModeloPlayList();
        if ($modelo->deletarList($id)) {
            echo 'PlayList Deletada';
        } else {
            echo 'Falha ao deletar';
        }
    }

    public function alterarList() {
        $id = $_POST['id'];
        $novoNome = $_POST['nome'];
        $modelo = new ModeloPlayList();
        if ($modelo->alterarList($id, $novoNome)) {
            echo 'PlayList Alterada';
        } else {
            echo 'Falha ao Alterar';
        }
    }

    public function tirarMusica() {
        $idDaMusica = $_POST['idDaMusica'];
        $idDaPlaylist = $_POST['idDaPlaylist'];
        $modelo = new ModeloPlayList();
        $atuais = $modelo->trazLista($idDaPlaylist);
        $atuais = $atuais[0];
        $atuais = str_split($atuais->musicas);
        $posicao = array_search($idDaMusica, $atuais);
        unset($atuais[$posicao]);
        $novalista = implode($atuais);
        if ($modelo->tirarDaLista($novalista, $idDaPlaylist)) {
            echo 'Musica Deletada';
        } else {
            echo 'Erro';
        }
    }

    public function resultadoDaBusca() {
        $chave = $_POST['chave'];
        $modelo = new ModeloPlayList();;
        $resultado = $modelo->resultadoDaBusca($chave);
        $var = '';
         for($i = 0; $i < count($resultado); $i++){
           $var .= "<a class='list-group-item' href='#' onclick='add(".$resultado[$i]->codigo.")'>".$resultado[$i]->titulo."</a>";
          } 
        print_r($var);
    }
    
    public function addMusicaInListPessoal(){
        $modelo = new ModeloPlayList();
        $IdDaList = $_POST['url'];
        $idDaMusica = $_POST['idDamusica'];
        $ex = explode('/', $IdDaList);
        $ultima = $ex[count($ex)-1];
        $musicas = $modelo->trazLista($ultima);
        $novaLista = $idDaMusica.$musicas[0]->musicas;       
        if($modelo->addDaLista($novaLista, $ultima)){
            echo 'Música Adicionada';
        }else{
            echo 'Erro';
        }   
    }
}
