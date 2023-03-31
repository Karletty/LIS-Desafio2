<?php
require_once('./View/printHead.php');
require_once('./View/navLogin.php');

printHead('Login');
?>

<body>
      <?php
      printNavigate('client', 'c_login');
      ?>
      <div class="container-fluid">
            <header class="col-sm-4 col-sm-offset-4">
                  <h1>Inicio de sesión</h1>
            </header>
            <main class="col-sm-4 col-sm-offset-4">
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

                  <form method="post" action="<?= PATH ?>/Clients/validateLoginData">

                        <div class="form-group">
                              <label for="client_email">Correo:</label>
                              <input type="text" class="form-control" id="client_email" placeholder="Correo" name="client_email">
                        </div>

                        <div class="form-group">
                              <label for="pass">Password:</label>
                              <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
                        </div>
                        <div class="form-group">
                              <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Registrarse</button>
                        </div>
                  </form>
            </main>
      </div>
</body>

</html>