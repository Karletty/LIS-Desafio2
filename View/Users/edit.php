<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Editar usuario');
?>

<head>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>

<body>
      <?php
      printNavigate('users');
      ?>
      <div class="container">
            <header>
                  <h1>Usuario <?= $user['user_name'] ?></h1>
            </header>
            <main class="col-md-7">
                  <form role="form" action="<?= PATH ?>/Users/update/<?= $user['user_name'] ?>" method="POST">
                        <input type="hidden" name="op" value="insertar" />
                        <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Campos requeridos</strong></div>
                        <div class="form-group mb-2">
                              <label for="user_name">Nombre del usuario:</label>
                              <div class="input-group">
                                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Usuario" value="<?= isset($user) ? $user['user_name'] : '' ?>" disabled>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                              </div>
                              <?php
                              if (isset($errors)  && isset($errors['user_name'])) : ?>
                                    <div class="alert alert-danger mt-1"><?= $errors['user_name'] ?></div>
                              <?php endif; ?>
                        </div>

                        <div class="form-group mb-2">
                              <label for="user_type">Tipo de usuario</label>
                              <select name="user_type" id="user_type" class="form-control">
                                    <?php
                                    foreach ($user_types as $type) {
                                    ?>
                                          <option value="<?= $type['id_user_type'] ?>"><?= $type['user_type'] ?></option>
                                    <?php
                                    }
                                    ?>
                              </select>
                        </div>

                        <input type="submit" class="btn btn-info" value="Guardar" name="Save">
                        <a class="btn btn-danger" href="<?= PATH . '/Categories' ?>">Cancelar</a>
                  </form>
            </main>
      </div>
</body>

</html>