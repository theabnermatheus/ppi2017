<?php

namespace MeuProjeto\Controllers;

use MeuProjeto\models\ModeloUsuario;
use MeuProjeto\Entity\Usuario;
use MeuProjeto\Util\Sessao;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

class ControleUsuario {

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

    public function CadastroDeClientes() {
        return $this->response->setContent($this->twig->render('TemplateCadastroDeClientes.html'));
    }

    public function Cadastrar() {
        try {
            $nome = $_POST['nome'];
            $rg = $_POST['rg'];
            $cpf = $_POST['cpf'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $uf = $_POST['uf'];
            $cep = $_POST['cep'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confirmarSenha = $_POST['confirmarSenha'];

            if ($nome == '') {
                echo 'Nome é Obrigatorio.';
                return;
            }

            if ($rg == '') {
                echo 'RG é Obrigatorio.';
                return;
            }

            if ($rg < 10) {
                echo 'RG deve conter todos os digitos.';
                return;
            }

            if ($cpf == '') {
                echo 'CPF é Obrigatorio.';
                return;
            }

            if ($cpf < 11) {
                echo 'RG deve conter todos os digitos.';
                return;
            }

            if ($telefone == '') {
                echo 'Telefone é Obrigatorio.';
                return;
            }

            if ($telefone < 11) {
                echo 'RG deve conter todos os digitos.';
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

            if ($senha <> $confirmarSenha) {
                echo 'Senha e Confirmação de Senha Diferentes.';
                return;
            }

            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setRg($rg);
            $usuario->setCpf($cpf);
            $usuario->setEndereco($endereco);
            $usuario->setCidade($cidade);
            $usuario->setUf($uf);
            $usuario->setCep($cep);
            $usuario->setTelefone($telefone);
            $usuario->setEmail($email);
            $usuario->setSenha($senha);

            $modelo = new ModeloUsuario();
            $deu = $modelo->inserirUsuario($usuario);

            if ($deu != 0) {
                echo 'Cliente Inserido Com Sucesso.';
            } else {
                echo 'CPF já cadastrado.';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function entrar() {
        return $this->response->setContent($this->twig->render('TemplateLogin.html'));
    }

    public function validaLogin() {
        $modelo = new ModeloUsuario();
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $usuario = $modelo->validaLogin($login, $senha);
        if($usuario){
            $usuario->senha = "não te inretessa";
            $this->sessao->add("usuario",$usuario);
            print_r($this->sessao->get("usuario")->status);
            
            if($this->sessao->get("usuario")->status == 0){
                //redireciona pra index do usuario;
            }else if($this->sessao->get("usuario")->status == 1){
                //redireciona para a index do admin;
            }
        }else{
            echo 'Login Falhou';
        }
    }

    public function redireciona($rota) {
        $redirect = new RedirectResponse($rota);
        $redirect->send();
    }
}