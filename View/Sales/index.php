<?php
require_once('./View/printHead.php');
require_once('./View/navigation.php');

printHead('Ventas');
?>

<body>
      <?php
      printNavigate('sales');
      ?>
      <div class="container">
            <header>
                  <h1>Lista de Ventas</h1>
            </header>
            <main>
                  <div class="col-md-10 overflow-x-scroll">
                        <table class="table table-striped table-bordered" id="tabla">
                              <thead>
                                    <tr>
                                          <th>Id de venta</th>
                                          <th>Cliente</th>
                                          <th>Factura</th>
                                          <th>Fecha</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php

                                    foreach ($sales as $sale) {
                                    ?>
                                          <tr>
                                                <td><?= $sale['id_sale'] ?></td>
                                                <td><?= $sale['id_client'] ?></td>
                                                <td><a target="_blank" href="./pdfs/<?= $sale['file_path'] ?>" class="btn btn-primary">Ver</a></td>
                                                <td><?= $sale['sale_date'] ?></td>
                                          </tr>

                                    <?php
                                    }
                                    ?>
                              </tbody>
                        </table>
                  </div>
            </main>
      </div>
</body>

</html>