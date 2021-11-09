<?php

//classe de autenticações

namespace App;

use App\Core\Model;

class Auth
{

  public static function Login($email, $senha)
  {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $email);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
      $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
      if (password_verify($senha, $resultado['senha'])) {
        $_SESSION['logado'] = true;
        $_SESSION['userId'] = $resultado['id'];
        $_SESSION['userNome'] = $resultado['nome'];
        header('Location: /home/index');
      } else {
        return "M.toast({html: 'Senha inválida!', classes: 'rounded, red'});";
      }
    } else {
      return "M.toast({html: 'Email inválido!', classes: 'rounded, red'});";
    }
  }

  public static function Logout()
  {
    session_destroy();
    header('Location: /home/login');
  }

  public static function checkLogin()
  {
    if (!isset($_SESSION['logado'])) {
      header('Location: /home/login');
      die;  //interrompe o script
    }
  }
}
