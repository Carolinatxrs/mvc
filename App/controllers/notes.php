<?php

use App\Auth;
use App\Core\Controller;

class Notes extends Controller
{
  public function ver($id = '')
  {
    $note = $this->model('Note');
    $dados = $note->findId($id);

    $this->view('notes/ver', $dados);
  }

  // para cadastrar noticias
  public function criar()
  {
    Auth::checkLogin();
    $messagem = array();

    if (isset($_POST['cadastrar'])) {
      // validações para campos NULL
      if (empty($_POST['titulo'])) {
        $messagem[] = "O campo titulo não pode ser em branco";
      } elseif (empty($_POST['texto'])) {
        $messagem[] = "O campo texto não pode ser em branco";
      } else {
        //UPLOAD DE ARQUIVOS
        $storage = new \Upload\Storage\FileSystem('uploads');
        $file = new \Upload\File('foo', $storage);

        // Optionally you can rename the file on upload
        $new_filename = uniqid();
        $file->setName($new_filename);

        // Validate file upload
        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations(array(
          // Ensure file is of type "image/png"
          new \Upload\Validation\Mimetype('image/png'),

          //You can also add multi mimetype validation
          //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

          // Ensure file is no larger than 5M (use "B", "K", M", or "G")
          new \Upload\Validation\Size('5M')
        ));

        // Access data about the file that has been uploaded
        $data = array(
          'name'       => $file->getNameWithExtension(),
          'extension'  => $file->getExtension(),
          'mime'       => $file->getMimetype(),
          'size'       => $file->getSize(),
          'md5'        => $file->getMd5(),
          'dimensions' => $file->getDimensions()
        );

        // Try to upload file
        try {
          // Success!
          $file->upload();
          $messagem[] = "Upload feito com sucesso!";
          $note = $this->model('Note');
          $note->titulo = $_POST['titulo'];
          $note->texto = $_POST['texto'];
          $note->imagem = $data['name'];

          $messagem[] = $note->save();
        } catch (\Exception $e) {
          // Fail!
          $errors = $file->getErrors();
          $messagem[] = implode("<br>", $errors);
        }
      }
    }

    $this->view('notes/criar', $dados = ['messagem' => $messagem]);
  }

  // atualizar
  public function editar($id)
  {
    Auth::checkLogin();
    $messagem = array();
    $note = $this->model('Note');

    if (isset($_POST['atualizar'])) {

      if (empty($_POST['titulo'])) {
        $messagem[] = "O campo titulo não pode ser em branco";
      } elseif (empty($_POST['texto'])) {
        $messagem[] = "O campo texto não pode ser em branco";
      } else {
        $note->titulo = $_POST['titulo'];
        $note->texto = $_POST['texto'];

        $messagem[] = $note->update($id);
      }
    }

    if (isset($_POST['atualizarImagem'])) {

      if (empty($_POST['titulo'])) {
        $messagem[] = "O campo titulo não pode ser em branco";
      } elseif (empty($_POST['texto'])) {
        $messagem[] = "O campo texto não pode ser em branco";
      } else {
        //UPLOAD DE ARQUIVOS
        $storage = new \Upload\Storage\FileSystem('uploads');
        $file = new \Upload\File('foo', $storage);

        // Optionally you can rename the file on upload
        $new_filename = uniqid();
        $file->setName($new_filename);

        // Validate file upload
        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations(array(
          // Ensure file is of type "image/png"
          new \Upload\Validation\Mimetype('image/png'),

          //You can also add multi mimetype validation
          //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

          // Ensure file is no larger than 5M (use "B", "K", M", or "G")
          new \Upload\Validation\Size('5M')
        ));

        // Access data about the file that has been uploaded
        $data = array(
          'name'       => $file->getNameWithExtension(),
          'extension'  => $file->getExtension(),
          'mime'       => $file->getMimetype(),
          'size'       => $file->getSize(),
          'md5'        => $file->getMd5(),
          'dimensions' => $file->getDimensions()
        );

        // Try to upload file
        try {
          // Success!
          $file->upload();
          $messagem[] = "Upload feito com sucesso!";
          $note = $this->model('Note');
          $note->titulo = $_POST['titulo'];
          $note->texto = $_POST['texto'];
          $note->imagem = $data['name'];

          $messagem[] = $note->updateImagem($id);
        } catch (\Exception $e) {
          // Fail!
          $errors = $file->getErrors();
          $messagem[] = implode("<br>", $errors);
        }
      }
    }

    if (isset($_POST['deletarImagem'])) {
      $imagem = $note->findId($id);
      unlink("uploads/" . $imagem['imagem']);
      $messagem[] = $note->deleteImage($id);
    }

    $dados = $note->findId($id); //pegar id
    $this->view('notes/editar', $dados = ['registros' => $dados, 'messagem' => $messagem]);
  }

  // exclusão
  public function excluir($id = '')
  {
    Auth::checkLogin();
    $messagem = array();

    $note = $this->model('Note');
    $messagem[] = $note->delete($id);
    $dados = $note->getAll();

    $this->view('home/index', $dados = ['registros' => $dados, 'messagem' => $messagem]);
  }
}
