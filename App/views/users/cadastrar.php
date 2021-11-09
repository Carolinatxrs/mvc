<div class="row container">
  <h1>Cadastrar usuário</h1>

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
    <form action="/users/cadastrar" method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="nome" type="text" name="nome" class="validate">
          <label for="nome">Nome</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate">
          <label for="email">E-mail</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="senha" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <button class="waves-effect waves-light btn" name="cadastrar">Cadastrar</button>
    </form>
  </div>
</div>