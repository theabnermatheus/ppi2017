<?php

namespace MeuProjeto\Controllers;

use MeuProjeto\models\ModeloUsuario;
use MeuProjeto\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

    public function Cadastrar() {
        $nome = entrada($_POST['nome']);
        $rg = entrada($_POST['rg']);
        $cpf = entrada($_POST['cpf']);
        $endereco = entrada($_POST['endereco']);
        $cidade = entrada($_POST['cidade']);
        $uf = entrada($_POST['uf']);
        $cep = entrada($_POST['cep']);
        $telefone = entrada($_POST['telefone']);
        $email = entrada($_POST['email']);
        $senha = entrada($_POST['senha']);

        echo ($nome);
        /*if ($nome == '') {
            echo 'Nome é Obrigatorio.';
            return;
        }
        if ($rg == '') {
            echo 'RG é Obrigatorio.';
            return;
        }
        if ($cpf == '') {
            echo 'CPF é Obrigatorio.';
            return;
        }
        if ($telefone == '') {
            echo 'Telefone é Obrigatorio.';
            return;
        }
        if ($email == '') {
            echo 'E-mail é Obrigatorio.';
            return;
        }
        if (strlen($senha) < 5) {
            echo 'Senha deve conter no mínimo 5 caracteres.';
            return;
        }
         
         
        $senha = md5(entrada($_REQUEST['senha']));
        $confirmarSenha = md5(entrada($_REQUEST['confirmarSenha']));
        
        if ($senha <> $confirmarSenha) {
            echo 'Senha e Confirmação de Senha Diferentes.';
            return;
        }

        $cliente = new Usuario(null, $nome, $rg, $cpf, $endereco, $cidade, $uf, $cep, 
                $telefone, $email, $senha, null, null, null);
        
        $ModeloUsuario = new ModeloUsuario();
        $ModeloUsuario->inserirCliente($cliente);
        
        if ($user != 0) {
            echo 'Cliente Inserido Com Sucesso.';
        } else {
            echo 'CPF já cadastrado.';
        }*/
    }

    function entrada($valor) {
        $valor = trim($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
    }
}
