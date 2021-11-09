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
      return "M.toast({html: 'Cadastrado com sucesso!', classes: 'rounded, green'});";
    } else {
      return "M.toast({html: 'Erro ao cadastrar!', classes: 'rounded, red'});";
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
      return "M.toast({html: 'Atualizado com sucesso!', classes: 'rounded, green'});";
    } else {
      return "M.toast({html: 'Erro ao atualizar!', classes: 'rounded, red'});";
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
      return "M.toast({html: 'Atualizado com sucesso!', classes: 'rounded, green'});";
    } else {
      return "M.toast({html: 'Erro ao atualizar!', classes: 'rounded, red'});";
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
      return "M.toast({html: 'Imagem excluida com sucesso!', classes: 'rounded, green'});";
    } else {
      return "M.toast({html: 'Erro ao excluir imagem!', classes: 'rounded, red'});";
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
      return "M.toast({html: 'Excluído com sucesso!', classes: 'rounded, green'});";
    } else {
      return "M.toast({html: 'Erro ao excluir!', classes: 'rounded, red'});";
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
