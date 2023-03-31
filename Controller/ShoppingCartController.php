<?php
require_once 'Controller.php';
require_once './Model/ProductsModel.php';
require_once './Core/validations.php';


class ShoppingCartController extends Controller
{
      private $model;

      function __construct()
      {
            if (isset($_SESSION['userType'])) {
                  if ($_SESSION['userType'] == 'client') {
                        $this->model = new ProductsModel();
                        $_SESSION['userType'] = $_SESSION['userType'];
                  } else {
                        renderError404View();
                  }
            } else {
                  header('location:' . PATH . '/Clients/login');
            }
      }

      public function index()
      {
            $products = [];
            if (isset($_SESSION['shopping_cart'])) {
                  foreach ($_SESSION['shopping_cart'] as $key => $value) {
                        $products[$key] = $this->model->getProdCart($key);
                        $products[$key]['quantity'] = $value;
                  }
            }
            $viewbag = [
                  'products' => $products,
                  'userType' => $_SESSION['userType']
            ];

            $this->render('index.php', $viewbag);
      }

      public function add($id)
      {
            if (!isset($_SESSION['shopping_cart'])) {
                  $_SESSION['shopping_cart'] = [];
            }
            $_SESSION['shopping_cart'][$id] = array_key_exists($id, $_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'][$id] + ($_POST['quantity'] ? $_POST['quantity'] : 1) : ($_POST['quantity'] ? $_POST['quantity'] : 1);

            $_SESSION['success_message'] = $_POST['quantity'] > 1  ? "Los productos han sido añadido al carrito" : "El producto ha sido añadido al carrito";


            header('location:' . PATH . '/ShoppingCart');
      }

      public function removeShopping()
      {
            unset($_SESSION['shopping_cart']);

            header('location:' . PATH . '/ShoppingCart');
      }

      public function removeAll($id)
      {
            unset($_SESSION['shopping_cart'][$id]);

            $_SESSION['success_message'] = "Se removió un grupo de productos del carrito";

            header('location:' . PATH . '/ShoppingCart');
      }

      public function removeOne($id)
      {
            if ($_SESSION['shopping_cart'][$id] == 1) {
                  unset($_SESSION['shopping_cart'][$id]);
            } else {
                  $_SESSION['shopping_cart'][$id] -= 1;
            }

            $_SESSION['success_message'] = "Se removió un productos del carrito";

            header('location:' . PATH . '/ShoppingCart');
      }
}
