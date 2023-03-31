<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Carrito');
?>

<body>
      <?php
      printNavigate('shopping_cart');
      $total = 0;
      ?>
      <div class="container">
            <header>
                  <h1>Carrito de compra</h1>
            </header>
            <main class="d-flex shopping-cart">
                  <div class="overflow-x-scroll shop-table">
                        <?php
                        if (count($products)) :
                        ?>
                              <table class="table table-striped table-bordered" id="tabla">
                                    <thead>
                                          <tr>
                                                <th>Imagen</th>
                                                <th style="width:100px">Nombre</th>
                                                <th>Categoría</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                                <th>Operaciones</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php

                                          foreach ($products as $product) {
                                                $total += $product['quantity'] * $product['price'];
                                          ?>
                                                <tr>
                                                      <td><img src="./View/assets/img/<?= $product['img'] ?>" class="table-img" alt="<?= $product['product_name'] ?>"></td>
                                                      <td><?= $product['product_name'] ?></td>
                                                      <td><?= $product['category_name'] ?></td>
                                                      <td>$<?= number_format((float) $product['price'], 2, '.', '') ?></td>
                                                      <td><?= $product['quantity'] ?></td>
                                                      <td>$<?= number_format((float) $product['quantity'] * $product['price'], 2, '.', '') ?></td>
                                                      <td>
                                                            <a class="btn btn-primary" href="<?= PATH . '/ShoppingCart/add/' . $product['id_product'] ?>"><i class="bi bi-bag-plus-fill"></i></a>
                                                            <a class="btn btn-primary" href="<?= PATH . '/ShoppingCart/removeOne/' . $product['id_product'] ?>"><i class="bi bi-bag-dash-fill"></i></a>
                                                            <a title="Eliminar" class="btn btn-danger btn-circle" href="<?= PATH . '/ShoppingCart/removeAll/' . $product['id_product'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                      </td>
                                                </tr>

                                          <?php
                                          }
                                          ?>
                                    </tbody>
                                    <tfoot>
                                          <th colspan="5">Total</th>
                                          <th colspan="2">$<?= number_format((float) $total, 2, '.', '') ?></th>
                                    </tfoot>
                              </table>
                        <?php else :  ?>
                              <h3>No existen productos</h3>
                        <?php endif; ?>
                  </div>
                  <div class="pay card">
                        <div class="card-header">
                              <h3 class="card-title">Datos del pago</h3>
                        </div>
                        <div class="card-body">
                              <?php
                              if (count($products)) :
                              ?>
                                    <form action="./Sales/validatePayment" method="POST">
                                          <div class="mb-3">
                                                <label for="user_name" class="form-label">Nombre: </label>
                                                <div class="input-group">
                                                      <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                      <input type="text" class="form-control form-control-sm" name="user_name" value="<?= isset($payment) ?  $payment["user_name"] : '' ?>">
                                                </div>
                                                <?= isset($errors['user_name']) ? "<p class='text-danger'>" . $errors['user_name'] . "</p>" : "" ?>
                                          </div>

                                          <div class="mb-3">
                                                <label for="user_lastname" class="form-label">Apellido: </label>
                                                <div class="input-group">
                                                      <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                      <input type="text" class="form-control form-control-sm" name="user_lastname" value="<?= isset($payment) ? $payment["user_lastname"] : '' ?>">
                                                </div>
                                                <?= isset($errors['user_lastname']) ? "<p class='text-danger'>" . $errors['user_lastname'] . "</p>" : "" ?>
                                          </div>

                                          <div class="mb-3">
                                                <label for="cnumero" class="form-label">Número de tarjeta: </label>
                                                <div class="input-group">
                                                      <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                                                      <input type="text" class="form-control form-control-sm" name="cc_number" value="<?= isset($payment) ? $payment["cc_number"] : '' ?>" id="credit-num">
                                                </div>
                                                <?= isset($errors['cc_number']) ? "<p class='text-danger'>" . $errors['cc_number'] . "</p>" : "" ?>
                                                <script src="./recursos/js/inputCreditCard.js"></script>
                                          </div>

                                          <div class="mb-3">
                                                <label for="fecha" class="form-label">Fecha Expiración: </label>
                                                <div class="input-group">
                                                      <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                                      <input type="month" class="form-control form-control-sm" name="exp_date" value="<?= isset($payment) ? $payment["exp_date"] : '' ?>">
                                                </div>
                                                <?= isset($errors['exp_date']) ? "<p class='text-danger'>" . $errors['exp_date'] . "</p>" : "" ?>
                                          </div>

                                          <div class="mb-3">
                                                <label for="cvv" class="form-label">CVV: </label>
                                                <div class="input-group">
                                                      <span class="input-group-text"><i class="bi bi-credit-card-2-back"></i></span>
                                                      <input type="text" class="form-control form-control-sm" name="cvv" value="<?= isset($payment) ? $payment["cvv"] : '' ?>">
                                                </div>
                                                <?= isset($errors['cvv']) ? "<p class='text-danger'>" . $errors['cvv'] . "</p>" : "" ?>
                                          </div>

                                          <div class="d-grid">
                                                <button class="btn btn-success" type="submit" name="pay"><i class="bi bi-credit-card-2-front"> Procesar Pago</i></button>
                                          </div>
                                    </form>
                              <?php else :  ?>
                                    <h3>No existen productos</h3>
                              <?php endif; ?>
                        </div>
                  </div>
            </main>
      </div>
</body>

</html>