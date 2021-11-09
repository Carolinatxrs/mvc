<div class="row container">
  <h1>Editar usuário</h1>
  <?php
  if (!empty($data['messagem'])) {
    echo "<script>";
    foreach ($data['messagem'] as $m) {
      echo $m;
    }
    echo "</script>";
  }
  ?>

  <div class="row">
    <form action="/users/alterar/<?php echo $data['registros']['id']; ?>" method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="nome" type="text" value="<?php echo $data['registros']['nome']; ?>" name="nome" class="validate">
          <label for="nome">Título</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" value="<?php echo $data['registros']['email']; ?>" name="email" class="validate">
          <label for="email">E-mail</label>
        </div>
      </div>
      <button class="waves-effect waves-light btn" name="atualizar">Atualizar</button>
    </form>
  </div>
</div>