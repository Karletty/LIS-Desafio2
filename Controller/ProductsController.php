<?php
require_once 'Controller.php';
require_once './Model/ProductsModel.php';
require_once './Model/CategoriesModel.php';
require_once './Core/validations.php';


class ProductsController extends Controller
{
      private $model;
      private $catModel;

      function __construct()
      {
            if (isset($_SESSION['userType'])) {
                  $this->model = new ProductsModel();
                  $this->catModel = new CategoriesModel();
                  $_SESSION['userType'] = $_SESSION['userType'];
            } else {
                  header('location:' . PATH . '/Clients/login');
            }
      }

      public function index()
      {
            if ($_SESSION['userType'] != 'client') {
                  $viewbag = [
                        'products' => $this->model->get(),
                        'userType' => $_SESSION['userType']
                  ];

                  $this->render('index.php', $viewbag);
            } else {
                  $viewbag = [
                        'products' => $this->model->get(),
                        'userType' => $_SESSION['userType']
                  ];
                  $this->render('displayProducts.php', $viewbag);
            }
      }


      public function create()
      {
            if ($_SESSION['userType'] != 'client') {
                  $viewBag['categories'] = $this->catModel->get();
                  $this->render('new.php', $viewBag);
            } else {
                  renderErrorPrivilegeView();
            }
      }

      private function validate($product)
      {
            $errors = [];
            extract($product);

            if (isEmpty($id_product)) {
                  $errors['id_product'] = 'Debe ingresar el código del producto';
            } elseif (!isIdProduct($id_product)) {
                  $errors['id_product'] = 'Debe ingresar un código con el formato PROD#####';
            }

            if (isEmpty($product_name) || !isText($product_name)) {
                  $errors['product_name'] = 'Debe ingresar el nombre del producto';
            }

            if (isEmpty($product_description)) {
                  $errors['product_description'] = 'Debe ingresar la descripción del producto';
            }

            if (!isset($_FILES['product_img'])) {
                  $errors['img'] = 'Debe ingresar una imagen';
            } elseif ($_FILES["product_img"]["type"] != "image/jpeg" && $_FILES["product_img"]["type"] != "image/png") {
                  $errors['img'] = 'Debe ingresar una imagen JPG o PNG';
            }

            if (isEmpty($price) || !is_numeric(trim($price))) {
                  $errors['price'] = 'Debe ingresar un precio válido';
            }

            if (isEmpty($stock) || !is_numeric(trim($stock))) {
                  $errors['stock'] = 'Debe ingresar una cantidad de existencias válida';
            }

            return $errors;
      }

      public function add()
      {
            if ($_SESSION['userType'] != 'client') {
                  if (isset($_POST['Save'])) {
                        extract($_POST);
                        $product = [
                              'id_product' => $id_product,
                              'product_name' => $product_name,
                              'product_description' => $product_description,
                              'img' => '',
                              'id_category' => $id_category,
                              'price' => $price,
                              'stock' => $stock
                        ];
                        $errors = $this->validate($product);

                        foreach ($this->model->get() as $prod) {
                              if ($prod['id_product'] == $product) {
                                    $errors['id_product'] = 'Este código de producto ya existe';
                              }
                        }

                        if (!count($errors)) {
                              $extension = '.png';
                              if ($_FILES["product_img"]["type"] == "image/jpeg") {
                                    $extension = '.jpg';
                              }

                              $product['img'] = $id_product . $extension;
                              var_dump($_FILES["product_img"]);
                              $origin = $_FILES["product_img"]["tmp_name"];
                              $destiny = './View/assets/img/' . $id_product . $extension;

                              if (@move_uploaded_file($origin, $destiny) && $this->model->insert($product) > 0) {
                                    $_SESSION['success_message'] = "Producto creado exitosamente";
                                    header('location:' . PATH . '/Products');
                              }
                        } else {
                              $_SESSION['error_message'] = "Hubo un error al crear el producto";
                              $viewBag['errors'] = $errors;
                              $viewBag['product'] = $product;
                              $viewBag['categories'] = $this->catModel->get();
                              $this->render("new.php", $viewBag);
                        }
                  }
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function remove($id)
      {
            if ($_SESSION['userType'] != 'client') {
                  $this->model->remove($id);
                  $_SESSION['success_message'] = "Producto eliminado exitosamente";
                  header('location:' . PATH . '/Products');
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function edit($id)
      {
            if ($_SESSION['userType'] != 'client') {
                  $viewBag = array();
                  $viewBag['product'] = $this->model->get($id);
                  $this->render("edit.php", $viewBag);
            } else {
                  renderErrorPrivilegeView();
            }
      }
      public function update($id)
      {
            if ($_SESSION['userType'] != 'client') {
                  if (isset($_POST['Save'])) {
                        extract($_POST);
                        $product = [
                              'id_product' => $id,
                              'product_name' => $product_name,
                              'product_description' => $product_description,
                              'img' => '',
                              'id_category' => $id_category,
                              'price' => $price,
                              'stock' => $stock
                        ];
                        $errors = $this->validate($product);

                        if (!count($errors)) {
                              $extension = '.png';
                              if ($_FILES["product-img"]["type"] == "image/jpeg") {
                                    $extension = '.jpg';
                              }

                              $product['img'] = $id_product . $extension;
                              $origin = $_FILES["product_img"]["temp_name"];
                              $destiny = './View/assets/img/' . $id_product . $extension;

                              if (@move_uploaded_file($origin, $destiny) && $this->model->update($product) > 0) {
                                    $_SESSION['success_message'] = "Producto editado exitosamente";
                                    header('location:' . PATH . '/Products');
                              }
                        } else {
                              $_SESSION['error_message'] = "Hubo un error al editar el producto";
                              $viewBag['errors'] = $errors;
                              $viewBag['product'] = $product;
                              $this->render("edit.php", $viewBag);
                        }
                  }
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function details($id)
      {
            echo json_encode($this->model->get($id));
      }
}
