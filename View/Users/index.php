<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Usuarios');
?>

<body>
      <?php
      printNavigate('users');
      ?>
      <div class="container">
            <header>
                  <h1>Lista de Usuarios</h1>
            </header>
            <main class="col-md-10">
                  <?php
                  if ($userType == 'admin') :
                  ?>
                        <a type="button" class="btn btn-primary btn-md" href="<?= PATH ?>/Users/create"> Nuevo usuario</a>
                        <br><br>
                  <?php endif; ?>
                  <table class="table table-striped table-bordered table-hover" id="tabla">
                        <thead>
                              <tr>
                                    <th>Usuario</th>
                                    <th>Tipo de usuario</th>
                                    <?php
                                    if ($userType == 'admin') :
                                    ?>
                                          <th>Operaciones</th>
                                    <?php endif; ?>
                              </tr>
                        </thead>
                        <tbody>
                              <?php

                              foreach ($users as $u) {
                              ?>
                                    <tr>
                                          <td><?= $u['user_name'] ?></td>
                                          <td><?= $u['user_type'] ?></td>
                                          <?php
                                          if ($userType == 'admin') :
                                                if ($u['user_name'] != $user) :
                                          ?>
                                                      <td>
                                                            <a class="btn btn-success" href="<?= PATH . '/Users/edit/' . $u['user_name'] ?>"><span class="glyphicon glyphicon-edit"></a>
                                                            <a title="Eliminar" class="btn btn-danger btn-circle" href="<?= PATH . '/Users/remove/' . $u['user_name'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                      </td>
                                          <?php
                                                else :
                                                      echo '<td></td>';
                                                endif;
                                          endif; ?>
                                    </tr>

                              <?php
                              }
                              ?>
                        </tbody>
                  </table>

            </main>
      </div>
</body>

</html>