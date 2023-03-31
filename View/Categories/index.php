<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Categorías');
?>

<body>
      <?php
      printNavigate('categories');
      ?>
      <div class="container">
            <header>
                  <h1>Lista de Categorías</h1>
            </header>
            <main class="col-md-10">
                  <?php
                  if ($userType == 'admin') :
                  ?>
                        <a type="button" class="btn btn-primary btn-md" href="<?= PATH ?>/Categories/create"> Nueva categoria</a>
                        <br><br>
                  <?php endif; ?>
                  <table class="table table-striped table-bordered table-hover" id="tabla">
                        <thead>
                              <tr>
                                    <th>Codigo de la categoría</th>
                                    <th>Nombre de la categoría</th>
                                    <?php
                                    if ($userType == 'admin') :
                                    ?>
                                          <th>Operaciones</th>
                                    <?php endif; ?>
                              </tr>
                        </thead>
                        <tbody>
                              <?php

                              foreach ($categories as $category) {
                              ?>
                                    <tr>
                                          <td><?= $category['id_category'] ?></td>
                                          <td><?= $category['category_name'] ?></td>
                                          <?php
                                          if ($userType == 'admin') :
                                          ?>
                                                <td>
                                                      <a class="btn btn-success" href="<?= PATH . '/Categories/edit/' . $category['id_category'] ?>"><span class="glyphicon glyphicon-edit"></a>
                                                      <a title="Eliminar" class="btn btn-danger btn-circle" href="<?= PATH . '/Categories/remove/' . $category['id_category'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                </td>
                                          <?php endif; ?>
                                    </tr>

                              <?php
                              }
                              ?>
                        </tbody>
                  </table>

                  <?php
                  if ($userType == 'admin') :
                  ?>
                        <div class="alert alert-warning"><strong>ADVERTENCIA: </strong>al eliminar una categoría se eliminarán todos los productos asociados a ella</div>
                  <?php endif; ?>

            </main>
      </div>
</body>

</html>