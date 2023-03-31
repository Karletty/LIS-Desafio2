<?php
function printNavigate($controller, $activeItem = 'c_signup')
{
      if (isset($_SESSION['success_message'])) {
?>
            <script>
                  alertify.success('<?= $_SESSION['success_message'] ?>');
            </script>
      <?php
            unset($_SESSION['success_message']);
      }
      if (isset($_SESSION['error_message'])) {
      ?>
            <script>
                  alertify.error('<?= $_SESSION['error_message'] ?>');
            </script>
      <?php
            unset($_SESSION['error_message']);
      }
      ?>
      <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                  <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Desplegar navegacion</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Textil Export</a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                              <?php
                              if ($controller == 'client') :
                              ?>
                                    <li class="<?= $activeItem == 'c_login' ?  'active' : '' ?>">
                                          <a href="<?= PATH ?>/Clients/login">Login</a>
                                    </li>
                                    <li class="<?= $activeItem == 'c_signup' ?  'active' : '' ?>">
                                          <a href="<?= PATH ?>/Clients/signup">Signup</a>
                                    </li>
                                    <li class="<?= $activeItem == 'u_login' ?  'active' : '' ?>">
                                          <a href="<?= PATH ?>/Users/login">Soy un administrador/empleado</a>
                                    </li>
                              <?php
                              else :
                              ?>
                                    <li class="<?= $activeItem == 'u_login' ?  'active' : '' ?>">
                                          <a href="<?= PATH ?>/Users/login">Login</a>
                                    </li>
                                    <li class="<?= $activeItem == 'c_signup' ?  'active' : '' ?>">
                                          <a href="<?= PATH ?>/Clients/signup">Soy un cliente</a>
                                    </li>
                              <?php
                              endif;
                              ?>
                        </ul>
                  </div>
            </div>
      </nav>
<?php
}
?>