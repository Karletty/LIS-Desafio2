<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Products');
?>

<body>
      <?php
      printNavigate('products');
      ?>
      <div class="container">
            <div class="row">
                  <h3>Lista de Productos</h3>
            </div>
            <div class="row">
                  <div class="col-md-10">
                        <a type="button" class="btn btn-primary btn-md" href="<?= PATH ?>/Products/create"> Nuevo producto</a>
                        <br><br>
                        <table class="table table-striped table-bordered table-hover" id="tabla">
                              <thead>
                                    <tr>
                                          <th>Codigo</th>
                                          <th>Nombre</th>
                                          <th>Descripción</th>
                                          <th>Imagen</th>
                                          <th>Categoría</th>
                                          <th>Precio</th>
                                          <th>Existencias</th>
                                          <th>Operaciones</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php

                                    foreach ($products as $product) {
                                    ?>
                                          <tr>
                                                <td><?= $product['id_product'] ?></td>
                                                <td><?= $product['product_name'] ?></td>
                                                <th><?= $product['product_description'] ?></th>
                                                <th><img src="./View/assets/img/<?= $product['img'] ?>" class="table-img" alt="<?= $product['product_name'] ?>"></th>
                                                <th><?= $product['category_name'] ?></th>
                                                <th>$<?= number_format((float) $product['price'], 2, '.', '') ?></th>
                                                <th><?= $product['stock'] ?></th>
                                                <td>
                                                      <a class="btn btn-success" href="<?= PATH . '/Products/edit/' . $product['id_product'] ?>"><span class="glyphicon glyphicon-edit"></a>
                                                      <a title="Eliminar" class="btn btn-danger btn-circle" href="<?= PATH . '/Product/remove/' . $product['id_product'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                </td>
                                          </tr>

                                    <?php
                                    }
                                    ?>
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
</body>

</html>