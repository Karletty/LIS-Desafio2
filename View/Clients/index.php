<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Clientes');
?>

<body>
      <?php
      printNavigate('clients');
      ?>
      <div class="container">
            <header>
                  <h1>Lista de Clientes</h1>
            </header>
            <main class="col-md-10">
                  <table class="table table-striped table-bordered table-hover" id="tabla">
                        <thead>
                              <tr>
                                    <th>Cliente</th>
                                    <th>Está activo</th>
                                    <?php
                                    if ($userType == 'admin') :
                                    ?>
                                          <th>Operaciones</th>
                                    <?php endif; ?>
                              </tr>
                        </thead>
                        <tbody>
                              <?php

                              foreach ($clients as $c) {
                              ?>
                                    <tr>
                                          <td><?= $c['client_email'] ?></td>
                                          <td><?= $c['is_active'] ? 'X' : '' ?></td>
                                          <?php
                                          if ($userType == 'admin') :
                                          ?>
                                                <td>
                                                      <a class="btn btn-success" href="<?= PATH . '/Clients/enable/' . $c['client_email'] ?>">Habilitar</a>
                                                      <a class="btn btn-danger" href="<?= PATH . '/Clients/disable/' . $c['client_email'] ?>">Inhabilitar</a>
                                                </td>
                                          <?php endif; ?>
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