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
            $cpf = $_POST['cpf'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $confirmarSenha = $_POST['confirmarSenha'];

            if ($nome == '') {
                echo 'Nome é Obrigatorio.';
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

            if ($login == '') {
                echo 'Nome é Obrigatorio.';
                return;
            }

            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setCpf($cpf);
            $usuario->setTelefone($telefone);
            $usuario->setEmail($email);
            $usuario->setLogin($login);
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
        if ($usuario) {
            $usuario->senha = "não te inretessa";
            $this->sessao->add("usuario", $usuario);
            if ($this->sessao->get("usuario")->status == 0) {
                echo '<script>window.location.href = "/indexUser"</script>';
//redireciona pra index do usuario;
            } else if ($this->sessao->get("usuario")->status == 1) {
                echo '<script>window.location.href = "/indexAdmin"</script>';
//redireciona para a index do admin;
            }
        } else {
            echo 'Login Falhou';
        }
    }

    public function editarUser() {
        if ($this->sessao->get("usuario") == "") {
             echo '<script>alert("Faça login para continuar");</script>';
             echo '<script>window.location.href = "/"</script>';
        } else {
            return $this->response->setContent($this->twig->render('TemplateEditarUser.html', array('user' => $this->sessao->get("usuario"))));
        }
    }
    
    public function excluirUser() {
        echo $_POST['id'];
    }
    
    
    
}
