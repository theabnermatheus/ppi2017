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
        $modelo->inserirCliente($usuario);
        
          
        
    }   
}
