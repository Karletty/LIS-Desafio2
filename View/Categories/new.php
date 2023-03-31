<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Categories');
?>

<head>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>

<body>
      <?php
      printNavigate('categories');
      ?>
      <div class="container">
            <div class="row">
                  <h3>Nueva categoría</h3>
            </div>
            <div class="row">
                  <div class="col-md-7">
                        <form role="form" action="<?= PATH ?>/Categories/add" method="POST">
                              <input type="hidden" name="op" value="insertar" />
                              <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Campos requeridos</strong></div>
                              <div class="form-group mb-2">
                                    <label for="id_category">Codigo de la categoría:</label>
                                    <div class="input-group">
                                          <input type="text" class="form-control" name="id_category" id="id_category" placeholder="CAT###" value="<?= isset($category) ? $category['id_category'] : '' ?>">
                                          <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                    </div>
                                    <?php
                                    if (isset($errors)  && isset($errors['id_category'])) : ?>
                                          <div class="alert alert-danger mt-1"><?= $errors['id_category'] ?></div>
                                    <?php endif; ?>
                              </div>

                              <div class="form-group mb-2">
                                    <label for="category_name">Nombre de la categoría:</label>
                                    <div class="input-group">
                                          <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Ingresa el nombre de la categoría" value="<?= isset($category) ? $category['category_name'] : '' ?>">
                                          <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                    </div>
                                    <?php
                                    if (isset($errors)  && isset($errors['category_name'])) : ?>
                                          <div class="alert alert-danger mt-1"><?= $errors['category_name'] ?></div>
                                    <?php endif; ?>
                              </div>

                              <input type="submit" class="btn btn-info" value="Guardar" name="Save">
                              <a class="btn btn-danger" href="<?= PATH . '/Categories' ?>">Cancelar</a>
                        </form>
                  </div>
            </div>
      </div>
</body>

</html>