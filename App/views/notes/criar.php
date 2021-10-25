<div class="row container">
  <h1>Criar bloco de anotação</h1>
  <?php
  if (!empty($data['messagem'])) {
    foreach ($data['messagem'] as $m) {
      echo $m . "<br>";
    }
  }
  ?>
  <div class="row">
    <form action="/notes/criar" method="POST" class="col s12" enctype="multipart/form-data">
      <div class="row">
        <div class="input-field col s12">
          <input id="titulo" type="text" name="titulo" class="validate">
          <label for="titulo">Título</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" name="texto" class="materialize-textarea"></textarea>
          <label for="textarea1">Texto</label>
        </div>
      </div>
      <div class="row">
        <div class="file-field input-field">
          <div class="btn">
            <span>Imagens</span>
            <input type="file" name="foo" required>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
      </div>
      <button class="waves-effect waves-light btn" name="cadastrar">Cadastrar</button>
    </form>
  </div>
</div>