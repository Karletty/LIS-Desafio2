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
                  <div class="grid">
                        <?php
                        foreach ($products as $product) {
                              if ($product['stock'] > 0) {
                        ?>
                                    <div class="card">
                                          <img src="./View/assets/img/<?= $product['img'] ?>" class="card-img" alt="...">
                                          <div class="card-header">
                                                <strong class="card-title"><?= $product['product_name'] ?></strong>
                                          </div>
                                          <div class="card-body d-flex just-cont-between">
                                                <div>
                                                      <p class="card-text details"><?= $product['category_name'] ?></p>
                                                </div>
                                                <div>
                                                      <p class="card-text text-end text-success">$<?= number_format((float) $product['price'], 2, '.', '') ?></p>
                                                </div>
                                          </div>
                                          <div class="card-footer d-flex flex-column justify-content-end">
                                                <form action="./ShoppingCart/add/<?=$product['id_product']?>" method="post" class="d-flex">
                                                      <input type="number" name="quantity" id="quantity" min=1 max=<?= $product['stock']  ?> class="form-control me-10" value="1">
                                                      <button type="submit" name="add" class="btn btn-primary"><i class="bi bi-bag-plus-fill"></i></button>
                                                </form>
                                                <a data-toggle="tooltip" title="Detalle" class="btn btn-primary btn-circle mt-10" href="javascript:void(0)" onclick="details('<?= $product['id_product'] ?>')">Ver detalle</span></a>
                                          </div>
                                    </div>
                        <?php
                              }
                        }
                        ?>
                  </div>
            </div>
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
      <script>
            $(document).ready(function() {
                  $('#tabla').DataTable();
            });

            function details(id) {
                  $.ajax({
                        url: "<?= PATH ?>/Products/details/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                              $('#product_name').text(data.product_name);
                              $('#product_description').text(data.product_description);
                              $('#category_name').text(data.category_name);
                              $('#price').text(data.price);
                              $('#modal').modal('show');
                              $('.modal-title').text(data.product_name);
                        }
                  })

            }
      </script>
</body>

</html>