<div class="row container">
  <h1>Fazer Login</h1>
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
    <form action="/home/login" method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="senha" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <button class="waves-effect waves-light btn" name="entrar">Entrar</button>
    </form>
  </div>
</div>