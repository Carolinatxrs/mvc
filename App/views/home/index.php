<div class="row container">
  <nav>
    <div class="nav-wrapper">
      <form method="POST" action="/home/buscar">
        <div class="input-field">
          <input id="search" name="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>
  <br>
  <?php
  if (!empty($data['messagem'])) {
    echo "<script>";
    foreach ($data['messagem'] as $m) {
      echo $m;
    }
    echo "</script>";
  }
  ?>

  <?php
  //paginação
  $pagination = new App\Pagination($data['registros'], isset($_GET['page']) ? $_GET['page'] : 1, 3);  //registro, pagina atual e quantidade
  ?>

  <?php
  //Nenhum registro
  if (empty($pagination->resultado())) {
    echo "Nenhum registro encontrado!";
  }
  ?>

  <?php foreach ($pagination->resultado() as $note) { ?>

    <div class="row">

      <img style="float:left; margin:0 15px 15px 0;" src="<?php echo URL_BASE; ?>/uploads/<?php echo $note['imagem']; ?>" width="300" alt="Imagem">
      <h3 class="light"><a href="/notes/ver/<?php echo $note['id']; ?>"> <?php echo $note['titulo']; ?> </a></h3>
      <p><?php echo $note['texto']; ?></p>

      <?php if (isset($_SESSION['logado'])) { ?>
        <a class="waves-effect waves-light btn orange" href="/notes/editar/<?php echo $note['id']; ?>">Editar</a>
        <a class="waves-effect waves-light btn red" href="/notes/excluir/<?php echo $note['id']; ?>">Excluir</a><br>
      <?php } ?>

    </div>

  <?php } ?>
  <?php
  //Navegação
  $pagination->navigator();
  ?>
</div>