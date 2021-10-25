<div class="row container">
  <br>
  <?php
  if (!empty($data['messagem'])) {
    foreach ($data['messagem'] as $m) {
      echo $m . "<br>";
    }
  }
  ?>
  <h1>Usuários</h1>
  <table class="responsive-table">
    <tr>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Ação</th>
    </tr>
    <?php foreach ($data['registros'] as $user) { ?>
      <tr>
        <td><?php echo $user['nome']; ?></td>
        <td><?php echo $user['email']; ?></td>

        <?php if (isset($_SESSION['logado'])) { ?>
          <td>
            <a class="waves-effect waves-light btn-small orange" href="/users/alterar/<?php echo $user['id']; ?>">Editar</a>
            <a class="waves-effect waves-light btn-small red" href="/users/remover/<?php echo $user['id']; ?>">Excluir</a>
          </td>
        <?php } ?>

      </tr>
    <?php } ?>
  </table>
</div>