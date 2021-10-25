<?php

use App\Core\Model;

class Note extends Model
{
  public $titulo;
  public $texto;
  public $imagem;

  // metodo para listar tudo
  public function getAll()
  {
    $sql = "SELECT * FROM notes";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $resultado;
    } else {
      return [];
    }
  }
  // listando pelo id
  public function findId($id)
  {
    $sql = "SELECT * FROM notes WHERE id = ?";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $resultado;
    } else {
      return [];
    }
  }
  // salva no banco
  public function save()
  {
    $sql = "INSERT INTO notes (titulo, texto, imagem) VALUES (?, ?, ?)";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->titulo);
    $stmt->bindValue(2, $this->texto);
    $stmt->bindValue(3, $this->imagem);

    if ($stmt->execute()) {
      return "Cadastrado com sucesso!";
    } else {
      return "Erro ao cadastrar!";
    }
  }
  //alterando registro
  public function update($id)
  {
    $sql = "UPDATE notes SET titulo = ?, texto = ? WHERE id = ?";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->titulo);
    $stmt->bindValue(2, $this->texto);
    $stmt->bindValue(3, $id);

    if ($stmt->execute()) {
      return "Atualizado com sucesso!";
    } else {
      return "Erro ao atualizar!";
    }
  }
  //alterando registro com imagem
  public function updateImagem($id)
  {
    $sql = "UPDATE notes SET titulo = ?, texto = ?, imagem = ? WHERE id = ?";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->titulo);
    $stmt->bindValue(2, $this->texto);
    $stmt->bindValue(3, $this->imagem);
    $stmt->bindValue(4, $id);

    if ($stmt->execute()) {
      return "Atualizado com sucesso!";
    } else {
      return "Erro ao atualizar!";
    }
  }
  //ecluir imagem na edição
  public function deleteImage($id)
  {
    $sql = "UPDATE notes SET imagem = ? WHERE id = ?";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, "");
    $stmt->bindValue(2, $id);

    if ($stmt->execute()) {
      return "Imagem excluida com sucesso!";
    } else {
      return "Erro ao excluir imagem!";
    }
  }
  // excluir registro
  public function delete($id)
  {
    $resultado = $this->findId($id);
    if (!empty($resultado['imagem'])) {
      unlink("uploads/" . $resultado['imagem']);  //remove img local
    }

    $sql = "DELETE FROM notes WHERE id = ?";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);

    if ($stmt->execute()) {
      return "Excluído com sucesso!";
    } else {
      return "Erro ao excluir!";
    }
  }
  //buscar registros
  public function search($busca)
  {
    $sql = "SELECT * FROM notes WHERE titulo LIKE ? COLLATE utf8_general_ci";
    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, "%{$busca}%");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $resultado;
    } else {
      return [];
    }
  }
}
