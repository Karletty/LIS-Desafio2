<?php
require_once 'Controller.php';
require_once './Model/ClientsModel.php';
require_once './Core/validations.php';


class ClientsController extends Controller
{
      private $model;
      private $userType;

      function __construct()
      {
            $this->model = new ClientsModel();
      }

      public function login()
      {
            if (!isset($_SESSION['userType'])) {
                  $this->render("login.php");
            } else {
                  header('location:' . PATH . '/Products');
            }
      }

      public function logout()
      {
            session_unset();
            session_destroy();
            header('location:' . PATH . '/Clients/login');
      }

      public function validateLoginData()
      {
            if (!isset($_SESSION['userType'])) {
                  $client_email = $_POST['client_email'];
                  $pass = $_POST['pass'];

                  if (!empty($this->model->validate($client_email, $pass))) {
                        $login_data = $this->model->validate($client_email, $pass)[0];
                        if ($login_data['is_active']) {
                              $_SESSION['userType'] = 'client';
                              $_SESSION['user'] = $client_email;
                              header('location:' . PATH . '/Products');
                        } else {
                              $errors = array();
                              $viewBag = array();
                              array_push($errors, "Este usuario está inactivo");
                              $viewBag['errors'] = $errors;
                              $this->render("login.php", $viewBag);
                        }
                  } else {
                        $errors = array();
                        $viewBag = array();
                        array_push($errors, "El usuario y/o password son incorrectos");
                        $viewBag['errors'] = $errors;
                        $this->render("login.php", $viewBag);
                  }
            } else {
                  header('location:' . PATH . '/Products');
            }
      }

      public function index()
      {
            if ($_SESSION['userType'] != 'client') {
                  $viewbag = [
                        'clients' => $this->model->get(),
                        'userType' => $_SESSION['userType']
                  ];

                  $this->render('index.php', $viewbag);
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function validate($client)
      {
            $errors = [];
            if (isEmpty($client['client_email'])) {
                  array_push($errors, 'Tiene que ingresar su correo');
            } else if (!isEmail($client['client_email'])) {
                  array_push($errors, 'Tiene que ingresar un correo válido');
            }

            if (isEmpty($client['pass'])) {
                  array_push($errors, 'Tiene que ingresar una contraseña');
            }

            return $errors;
      }


      public function register()
      {
            if (!isset($_POST['register'])) {
                  extract($_POST);
                  $client = [
                        'client_email' => $client_email,
                        'is_active' => true,
                        'pass' => $pass
                  ];

                  $errors = $this->validate($client);
                  foreach ($this->model->get() as $c) {
                        if ($c['client_email'] == $client_email) {
                              array_push($errors, 'Este usuario ya existe');
                        }
                  }

                  if (!count($errors)) {
                        if ($this->model->register($client) > 0) {
                              header('location:' . PATH . '/Products');
                        }
                  } else {
                        array_push($errors, 'Hubo un error al crear el usuario');
                        $viewBag['errors'] = $errors;
                        $viewBag['client'] = $client;
                        $this->render("signup.php", $viewBag);
                  }
            }
      }

      public function signup()
      {
            if (!isset($_SESSION['userType'])) {
                  $this->render("signup.php");
            } else {
                  header('location:' . PATH . '/Products');
            }
      }

      public function disable($id)
      {
            if ($_SESSION['userType'] == 'admin') {
                  $client = [
                        'client_email' => $id,
                        'is_active' => false
                  ];
                  $this->model->enable($client);
                  $this->render('index.php');
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function enable($id)
      {
            if ($_SESSION['userType'] == 'admin') {
                  $client = [
                        'client_email' => $id,
                        'is_active' => true
                  ];
                  $this->model->enable($client);
                  $this->render('index.php');
            } else {
                  renderErrorPrivilegeView();
            }
      }
}
