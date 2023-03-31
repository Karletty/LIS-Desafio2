<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Nuevo producto');
?>

<head>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>

<body>
      <?php
      printNavigate('products');
      ?>
      <div class="container">
            <header>
                  <h1>Nuevo producto</h1>
            </header>
            <main class="col-md-7">
                  <form role="form" action="<?= PATH ?>/Products/add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="op" value="insertar" />
                        <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Campos requeridos</strong></div>
                        <div class="form-group mb-2">
                              <label for="id_product">Codigo del producto:</label>
                              <div class="input-group">
                                    <input type="text" class="form-control" name="id_product" id="id_product" placeholder="PROD#####" value="<?= isset($product) ? $product['id_product'] : '' ?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['id_product'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['id_product'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="product_name">Nombre del producto:</label>
                              <div class="input-group">
                                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Ingresa el nombre del producto" value="<?= isset($product) ? $product['product_name'] : '' ?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['product_name'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['product_name'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="product_description">Descripción del producto:</label>
                              <div class="input-group">
                                    <textarea type="text" name="product_description" id="product_description" value="" class="form-control"><?= isset($product) ? $product['product_description'] : '' ?></textarea>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['product_description'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['product_description'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="product_img">Imagen del producto:</label>
                              <div class="input-group">
                                    <input type="file" accept="image/png, image/jpeg" class="form-control" name="product_img" id="product_img">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['img'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['img'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="category_name">Nombre de la categoría:</label>
                              <div class="input-group">
                                    <select name="id_category" id="id_category" class="form'control">
                                          <?php
                                          foreach ($categories as $cat) {
                                          ?>
                                          <option value="<?= $cat['id_category'] ?>"><?= $cat['category_name'] ?></option>
                                          <?php
                                          }
                                          ?>
                                    </select>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['category_name'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['category_name'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="price">Precio:</label>
                              <div class="input-group">
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Ingrese el precio del producto" value="<?= isset($product) ? $product['price'] : '' ?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['price'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['price'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="stock">Cantidad en existencias:</label>
                              <div class="input-group">
                                    <input type="text" class="form-control" name="stock" id="stock" placeholder="Ingresa la cantidad en existencias" value="<?= isset($product) ? $product['stock'] : '' ?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['stock'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['stock'] ?></div>
                              <?php endif; ?>
                        </div>

                        <input type="submit" class="btn btn-info" value="Guardar" name="Save">
                        <a class="btn btn-danger" href="<?= PATH . '/Products' ?>">Cancelar</a>
                  </form>
            </main>
      </div>
</body>

</html>