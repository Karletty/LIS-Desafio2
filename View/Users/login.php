<?php
require_once('./View/printHead.php');
require_once('./View/navLogin.php');

printHead('Login');
?>

<body>
      <?php
      printNavigate('users', 'u_login');
      ?>
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-4 col-sm-offset-4">
                        <h2>Inicio de sesión</h2>

                        <?php
                        if (isset($errors)) {
                              if (count($errors) > 0) {
                                    echo "<div class='alert alert-danger'><ul>";
                                    foreach ($errors as $error) {
                                          echo "<li>$error</li>";
                                    }
                                    echo "</ul></div>";
                              }
                        }

                        ?>

                        <form method="post" action="<?= PATH ?>/Users/validateLoginData">

                              <div class="form-group">
                                    <label for="user_name">Usuario:</label>
                                    <input type="text" class="form-control" id="user_name" placeholder="Usuario" name="user_name">
                              </div>

                              <div class="form-group">
                                    <label for="pass">Password:</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
                              </div>
                              <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Registrarse</button>
                              </div>
                        </form>
                  </div>
            </div>
      </div>
</body>

</html>