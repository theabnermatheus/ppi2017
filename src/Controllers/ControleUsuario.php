<?php

namespace MeuProjeto\Controllers;

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
        $nome = entrada($_REQUEST['nome']);
        $rg = entrada($_REQUEST['rg']);
        $cpf = entrada($_REQUEST['cpf']);
        $endereco = entrada($_REQUEST['endereco']);
        $cidade = entrada($_REQUEST['cidade']);
        $uf = entrada($_REQUEST['uf']);
        $cep = entrada($_REQUEST['cep']);
        $telefone = entrada($_REQUEST['telefone']);
        $email = entrada($_REQUEST['email']);
        $senha = entrada($_REQUEST['senha']);

        if ($nome == '') {
            echo 'Nome é Obrigatorio.';
        }
        if ($rg == '') {
            echo 'RG é Obrigatorio.';
        }
        if ($cpf == '') {
            echo 'CPF é Obrigatorio.';
        }
        if ($telefone == '') {
            echo 'Telefone é Obrigatorio.';
        }
        if ($email == '') {
            echo 'E-mail é Obrigatorio.';
        }
        if (strlen($senha) < 5) {
            echo 'Senha deve conter no mínimo 5 caracteres.';
        }
        $senha = md5(entrada($_REQUEST['senha']));
        $confirmarSenha = md5(entrada($_REQUEST['confirmarSenha']));
        
        if ($senha <> $confirmarSenha) {
            echo 'Senha e Confirmação de Senha Diferentes.';
        }

        $cliente = new Usuario(null, $nome, $rg, $cpf, $endereco, $cidade, $uf, $cep, 
                $telefone, $email, $senha, 1, null, $null);
        
        $clienteDao = ClienteDAO::getInstance();
        $user = $clienteDao->inserirCliente($cliente);
        if ($user != 0) {
            echo 'Cliente Inserido Com Sucesso.';
        } else {
            echo 'CPF já cadastrado.';
        }
    }

    function entrada($valor) {
        $valor = trim($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
    }
}
