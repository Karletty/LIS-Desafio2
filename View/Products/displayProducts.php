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
                  <h1>Productos</h1>
            </header>
            <main>
                  <div class="col-md-10 overflow-x-scroll">
                        <table class="table table-striped overflow-x-scroll table-bordered" id="tabla">
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
                                                      <form action="./ShoppingCart/add/<?= $product['id_product'] ?>" method="post" class="d-flex">
                                                            <input type="number" name="quantity" id="quantity" min=1 max=<?= $product['stock']  ?> class="form-control me-10" value="1">
                                                            <button type="submit" name="add" class="btn btn-primary"><i class="bi bi-bag-plus-fill"></i></button>
                                                      </form>
                                                      <a data-toggle="tooltip" title="Detalle" class="btn btn-primary btn-circle mt-10" href="javascript:void(0)" onclick="details('<?= $product['id_product'] ?>')">Ver detalle</span></a>
                                                </td>
                                          </tr>

                                    <?php
                                    }
                                    ?>
                              </tbody>
                        </table>
                  </div>
                  <div class="modal fade" id="modal" role="dialog">
                        <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h3 class="modal-title"></h3>
                                    </div>
                                    <div class="modal-body form">
                                          <ul class="list-group">
                                                <li class="list-group-item"><b>Nombre: </b><span id="product_name"></span></li>
                                                <li class="list-group-item"><b>Descripción: </b> <span id="product_description"></span></li>
                                                <li class="list-group-item"><b>Categoría: </b><span id="category_name"></span></li>
                                                <li class="list-group-item"><b>Precio: </b>$<span id="price"></span></li>
                                          </ul>

                                    </div>
                                    <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                              </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  <!-- End Bootstrap modal -->
            </main>
            <script>
                  $(document).ready(function() {
                        $('#tabla').DataTable();
                  });
            </script>
</body>

</html>