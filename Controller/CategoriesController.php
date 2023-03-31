<?php
require_once 'Controller.php';
require_once './Model/CategoriesModel.php';
require_once './Core/validations.php';


class CategoriesController extends Controller
{
      private $model;
      private $userType;

      function __construct()
      {
            if (isset($_SESSION['userType'])) {
                  $this->model = new CategoriesModel();
                  $this->userType = $_SESSION['userType'];
            } else {
                  header('location:' . PATH . '/Clients/login');
            }
      }

      public function index()
      {
            if ($this->userType != 'client') {
                  $viewbag = [
                        'categories' => $this->model->get(),
                        'userType' => $this->userType
                  ];

                  $this->render('index.php', $viewbag);
            } else {
                  renderErrorPrivilegeView();
            }
      }


      public function create()
      {
            if ($this->userType == 'admin') {
                  $this->render('new.php');
            } else {
                  renderErrorPrivilegeView();
            }
      }

      private function validate($category)
      {
            $errors = [];
            extract($category);

            if (isEmpty($id_category)) {
                  $errors['id_category'] = 'Debe ingresar el código de la categoría';
            } elseif (!isIdCategory($id_category)) {
                  $errors['id_category'] = 'Debe ingresar un código con el formato CAT###';
            }

            if (isEmpty($category_name) || !isText($category_name)) {
                  $errors['category_name'] = 'Debe ingresar el nombre de la categoría';
            }
            return $errors;
      }

      public function add()
      {
            if ($this->userType == 'admin') {
                  if (isset($_POST['Save'])) {
                        extract($_POST);
                        $category = [
                              'id_category' => $id_category,
                              'category_name' => $category_name
                        ];
                        $errors = $this->validate($category);
                        foreach ($this->model->get() as $cat) {
                              if ($cat['id_category'] == $id_category) {
                                    $errors['id_category'] = 'Este código de categoría ya existe';
                              }
                        }

                        if (!count($errors)) {
                              if ($this->model->insert($category) > 0) {
                                    $_SESSION['success_message'] = "Categoría creada exitosamente";
                                    header('location:' . PATH . '/Categories');
                              }
                        } else {
                              $_SESSION['error_message'] = "Hubo un error al crear la categoría";
                              $viewBag['errors'] = $errors;
                              $viewBag['category'] = $category;
                              $this->render("new.php", $viewBag);
                        }
                  }
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function remove($id)
      {
            if ($this->userType == 'admin') {
                  $this->model->remove($id);
                  $_SESSION['success_message'] = "Categoría eliminada exitosamente";
                  header('location:' . PATH . '/Categories');
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function edit($id)
      {
            if ($this->userType == 'admin') {
                  $viewBag = array();
                  $viewBag['category'] = $this->model->get($id);
                  $this->render("edit.php", $viewBag);
            } else {
                  renderErrorPrivilegeView();
            }
      }
      public function update($id)
      {
            if ($this->userType == 'admin') {
                  if (isset($_POST['Save'])) {
                        extract($_POST);
                        $category = [
                              'id_category' => $id,
                              'category_name' => $category_name
                        ];
                        $errors = $this->validate($category);

                        if (!count($errors)) {
                              if ($this->model->update($category) > 0) {
                                    $_SESSION['success_message'] = "Categoría editada exitosamente";
                                    header('location:' . PATH . '/Categories');
                              }
                        } else {
                              $_SESSION['error_message'] = "Hubo un error al editar la categoría";
                              $viewBag['errors'] = $errors;
                              $viewBag['category'] = $category;
                              $this->render("edit.php", $viewBag);
                        }
                  }
            } else {
                  renderErrorPrivilegeView();
            }
      }
}
