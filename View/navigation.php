<?php
function printNavigate($activeItem = 'products')
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
                              <li class="<?= $activeItem == 'products' ?  'active' : '' ?>">
                                    <a href="<?= PATH ?>/Products">Inicio</a>
                              </li>
                              <?php
                              if ($_SESSION['userType'] == 'client') :
                              ?>
                                    <li class="<?= $activeItem == 'shopping_cart' ?  'active' : '' ?>">
                                          <a href="<?= PATH ?>/ShoppingCart">Carrito</a>
                                    </li>
                              <?php
                              else :
                              ?>
                                    <li class="dropdown <?= $activeItem == 'products' ? 'active' : '' ?>">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos<span class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                                <li><a href="<?= PATH ?>/Products/create">Registrar producto</a></li>
                                                <li><a href="<?= PATH ?>/Products">Ver lista de productos</a></li>
                                          </ul>
                                    </li>

                                    <?php if ($_SESSION['userType'] == 'admin') : ?>
                                          <li class=" <?= $activeItem == 'sales' ? 'active' : '' ?>">
                                                <a href="<?= PATH ?>/Sales">Ventas</a>
                                          </li>

                                          <li class="dropdown <?= $activeItem == 'categories' ? 'active' : '' ?>">
                                                <a href=" #" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorías<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                      <li><a href="<?= PATH ?>/Categories/create">Registrar categorías</a></li>
                                                      <li><a href="<?= PATH ?>/Categories">Ver lista de categorías</a></li>
                                                </ul>
                                          </li>

                                          <li class="dropdown <?= $activeItem == 'users' ? 'active' : '' ?>">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                      <li><a href="<?= PATH ?>/Products/create">Registrar usuarios</a></li>
                                                      <li><a href="<?= PATH ?>/Products">Ver lista de usuarios</a></li>
                                                </ul>
                                          </li>
                                    <?php elseif ($_SESSION['userType'] == 'employee') : ?>
                                          <li class=" <?= $activeItem == 'categories' ? 'active' : '' ?>">
                                                <a href="<?= PATH ?>/Categories">Categorías</a>
                                          </li>
                                          <li class=" <?= $activeItem == 'users' ? 'active' : '' ?>">
                                                <a href="<?= PATH ?>/Usuarios">Usuarios</a>
                                          </li>
                                    <?php endif; ?>
                                          <li class=" <?= $activeItem == 'clientes' ? 'active' : '' ?>">
                                                <a href="<?= PATH ?>/Clients">Clientes</a>
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