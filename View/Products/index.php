<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Productos');
?>

<body>
      <?php
      printNavigate('products');
      ?>
      <div class="container">
            <header>
                  <h1>Lista de Productos</h1>
            </header>
            <main>
                  <div class="col-md-10 overflow-x-scroll">
                        <a type="button" class="btn btn-primary btn-md" href="<?= PATH ?>/Products/create"> Nuevo producto</a>
                        <br><br>
                        <table class="table table-striped table-bordered" id="tabla">
                              <thead>
                                    <tr>
                                          <th>Codigo</th>
                                          <th>Nombre</th>
                                          <th style="width:350px">Descripción</th>
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
                                                <td style="width:350px"><?= $product['product_description'] ?></td>
                                                <td><img src="./View/assets/img/<?= $product['img'] ?>" class="table-img" alt="<?= $product['product_name'] ?>"></td>
                                                <td><?= $product['category_name'] ?></td>
                                                <td>$<?= number_format((float) $product['price'], 2, '.', '') ?></td>
                                                <td><?= $product['stock'] ?></td>
                                                <td>
                                                      <a class="btn btn-success" href="<?= PATH . '/Products/edit/' . $product['id_product'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                      <a title="Eliminar" class="btn btn-danger btn-circle" href="<?= PATH . '/Product/remove/' . $product['id_product'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                </td>
                                          </tr>

                                    <?php
                                    }
                                    ?>
                              </tbody>
                        </table>
                  </div>
            </main>
      </div>
      <script>
            $(document).ready(function() {
                  $('#tabla').DataTable();
            });
      </script>
</body>

</html>