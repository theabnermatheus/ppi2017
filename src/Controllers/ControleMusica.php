<?php

namespace MeuProjeto\Controllers;

use MeuProjeto\models\ModeloMusica;
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

    public function setMusica() {
        $titulo = null;
        $artista = null;
        $genero = null;

        $titulo = $_REQUEST['titulo'];
        $artista = $_REQUEST['artista'];
        $genero = $_REQUEST['genero'];

        if ($titulo == null) {
            echo 'Digite o titulo';
            return;
        }

        if ($artista == null) {
            echo 'Digite o nome do artista';
            return;
        }

        if ($genero == "null") {
            echo 'Selecione o genero ';
            return;
        }

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); // pegar a extensão
        $novo_nome = $titulo . "- " . $artista; // define o nome do arquivo
        $diretorio = "Musicas/";

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome . $extensao)) {
            $caminho = $diretorio . $novo_nome . $extensao;
            $modelo = new ModeloMusica();
            $modelo->setMusica($titulo, $artista, $genero, $caminho);
        } else {
            echo 'Erro ao fazer upload';
        }
    }

    public function getMusica() {
        $id = $_POST['codigo'];
        $modelo = new ModeloMusica();
        $musica = $modelo->getMusica($id);
        echo ($musica['caminho']);
    }

    public function paginaDeUpload() {
        return $this->response->setContent($this->twig->render('subirMusica.html'));
    }

    public function teste() {
        $modelo = new ModeloMusica();
        $tudo = $modelo->seleconaPlayListDaRadio("Eletronica");
        $caminhos = null;

        for ($i = 0; $i < count($tudo); $i++) {
            $caminhos = $caminhos . $tudo[$i]->caminho . "*";
        }
        return $this->response->setContent($this->twig->render('Teste.html', array('lista' => $tudo, 'caminhos' => $caminhos)));
    }

    public function eletronica() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Eletronica");
        $tamanho = sizeof($musicas);
        if ($tamanho == 0) {
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('eletronica.html', array('semMusicas' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('eletronica.html', array('musicas' => $musicas, 'user' => $this->sessao->get("usuario"))));
        }
    }

    public function pop() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Pop");
        $tamanho = sizeof($musicas);
        if ($tamanho == 0) {
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('pop.html', array('semMusicas' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('pop.html', array('musicas' => $musicas, 'user' => $this->sessao->get("usuario"))));
        }
    }

    public function rock() {
        $modelo = new ModeloMusica();
        $musicas = $modelo->seleconaPlayListDaRadio("Rock");
        $tamanho = sizeof($musicas);
        if ($tamanho == 0) {
            $string = "Sem Musicas Cadastradas";
            return $this->response->setContent($this->twig->render('rock.html', array('semMusicas' => $string, 'user' => $this->sessao->get("usuario"))));
        } else {
            return $this->response->setContent($this->twig->render('rock.html', array('musicas' => $musicas, 'user' => $this->sessao->get("usuario"))));
        }
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
        $modelo = new ModeloMusica();
        if ($modelo->addlist($nome, $user)) {
            echo '<script>alert("Sucesso");</script>';
            echo '<script>window.location.href = "/myList"</script>';
        } else {
            echo 'erro';
        }
    }

    public function listarMinhasPlay() {
        $user = $this->sessao->get("usuario")->idUsuario;
        $modelo = new ModeloMusica();
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
        $modelo = new ModeloMusica();
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
                return $this->response->setContent($this->twig->render('MusicasDoUser.html', array('list' => null, 'user' => $this->sessao->get("usuario"))));
            }
        } else {
            echo '<script>alert("voce não tem permissão para acessar aqui");</script>';
            echo '<script>window.location.href = "/"</script>';
        }
    }

    public function deletarList() {
        $id = $_POST['id'];
        $modelo = new ModeloMusica();
        if ($modelo->deletarList($id)) {
            echo 'PlayList Deletada';
        } else {
            echo 'Falha ao deletar';
        }
    }

    public function alterarList() {
        $id = $_POST['id'];
        $novoNome = $_POST['nome'];
        $modelo = new ModeloMusica();
        if ($modelo->alterarList($id, $novoNome)) {
            echo 'PlayList Alterada';
        } else {
            echo 'Falha ao Alterar';
        }
    }

    public function tirarMusica() {
        $idDaMusica = $_POST['idDaMusica'];
        $idDaPlaylist = $_POST['idDaPlaylist'];
        $modelo = new ModeloMusica();
        $atuais = $modelo->trazLista($idDaPlaylist);
        $atuais = $atuais[0];
        $atuais = str_split($atuais->musicas);
        $posicao = array_search($idDaMusica,$atuais);  
        unset($atuais[$posicao]);
        $novalista = implode($atuais);
        if($modelo->tirarDaLista($novalista , $idDaPlaylist)){
            echo 'Musica Deletada';
        }else{
            echo 'Erro';
        }   
    }
    
     public function resultadoDaBusca() {
          
     }   
}