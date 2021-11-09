<?php

use App\Auth;
use App\Core\Controller;

class Home extends Controller
{
  public function index($nome = '')
  {
    $note = $this->model('Note');
    $dados = $note->getAll();

    $this->view('home/index', $dados = ['registros' => $dados]);
  }

  public function buscar()
  {
    $busca = isset($_POST['search']) ? $_POST['search'] : $_SESSION['search'];
    $_SESSION['search'] = $busca;
    $note = $this->model('Note');
    $dados = $note->search($busca);

    $this->view('home/index', $dados = ['registros' => $dados]);
  }

  public function login()
  {
    $messagem = array();

    if (isset($_POST['entrar'])) {

      if ((empty($_POST['email'])) or (empty($_POST['senha']))) {
        $messagem[] = "M.toast({html: 'O campo email e senha são obrigatórios!', classes: 'rounded, orange'});";
      } else {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $messagem[] = Auth::Login($email, $senha);

        // echo password_hash('123', PASSWORD_DEFAULT);
      }
    }

    $this->view('home/login', $dados = ['messagem' => $messagem]);
  }

  public function logout()
  {
    Auth::Logout();
  }
}
