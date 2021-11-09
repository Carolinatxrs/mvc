<?php

use App\Auth;
use App\Core\Controller;

class Users extends Controller
{
  public function visualizar($id = '')
  {
    Auth::checkLogin();
    $user = $this->model('User');
    $dados = $user->getAll();

    $this->view('users/visualizar', $dados = ['registros' => $dados]);
  }

  public function cadastrar()
  {
    Auth::checkLogin();
    $messagem = array();

    if (isset($_POST['cadastrar'])) {

      if ((empty($_POST['nome'])) or (empty($_POST['email'])) or (empty($_POST['senha']))) {
        $messagem[] = "M.toast({html: 'Os campos Nome, E-mail e Senha são obrigatórios!', classes: 'rounded, orange'});";
      } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $user = $this->model('User');
        $user->nome = $nome;
        $user->email = $email;
        $user->senha = $senha;

        $messagem[] = $user->save();
      }
    }
    $this->view('users/cadastrar', $dados = ['messagem' => $messagem]);
  }

  public function alterar($id)
  {
    Auth::checkLogin();
    $messagem = array();
    $user = $this->model('User');

    if (isset($_POST['atualizar'])) {

      if ((empty($_POST['nome'])) or (empty($_POST['email']))) {
        $messagem[] = "M.toast({html: 'O campo nome e email não podem ser em branco!', classes: 'rounded, orange'});";
      } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $user->nome = $nome;
        $user->email = $email;

        $messagem[] = $user->update($id);
      }
    }
    $dados = $user->findId($id);
    $this->view('users/alterar', $dados = ['registros' => $dados, 'messagem' => $messagem]);
  }

  public function remover($id = '')
  {
    Auth::checkLogin();
    $messagem = array();

    $user = $this->model('User');
    $messagem[] = $user->delete($id);
    $dados = $user->getAll();

    $this->view('users/visualizar', $dados = ['registros' => $dados, 'messagem' => $messagem]);
  }
}
