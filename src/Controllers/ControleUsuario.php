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
    private $sessao;

    function __construct(Response $response, Request $request, \Twig_Environment $twig , $sessao) {
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

    public function setarSessao() {
        $login = entrada($_REQUEST['login']);
        $senha = md5(entrada($_REQUEST['senha']));

        if (empty($login)) {
            echo 'Informe o Login.';
            return;
        }
        if (empty($senha)) {
            echo 'Informe a Senha.';
            return;
        }
        //parei aqui
        $clienteDao = ClienteDAO::getInstance();
        $cliente = $clienteDao->login($login, $senha);

        if ($cliente) {
            $_SESSION['user'] = ($cliente[0]);
            echo '<script>window.location.href = "principalCliente"</script>';
        } else {
            $funcionarioDao = FuncionarioDAO::getInstance();
            $funcionario = $funcionarioDao->login($login, $senha);
            if ($funcionario) {
                $_SESSION['user'] = ($funcionario[0]);

                if ($funcionario[0]->getPerfil() == 1) {
                    echo '<script>window.location.href = "principalFuncionario"</script>';
                } else {
                    echo '<script>window.location.href = "principalGestor"</script>';
                }
            } else {
                echo 'Erro ao tentar acesso.';
            }
        }
    }
}
