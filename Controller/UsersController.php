<?php
require_once 'Controller.php';
require_once './Model/UsersModel.php';
require_once './Core/validations.php';


class UsersController extends Controller
{
      private $model;

      function __construct()
      {
            $this->model = new UsersModel();
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
            header('location:' . PATH . '/Users/login');
      }

      public function validateLoginData()
      {
            if (!isset($_SESSION['userType'])) {
                  $user_name = $_POST['user_name'];
                  $pass = $_POST['pass'];

                  if (!empty($this->model->validate($user_name, $pass))) {
                        $login_data = $this->model->get($user_name);
                        $_SESSION['userType'] = $login_data['user_type'];
                        $_SESSION['user'] = $user_name;
                        header('location:' . PATH . '/Products');
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
                        'users' => $this->model->get(),
                        'userType' => $_SESSION['userType']
                  ];

                  $this->render('index.php', $viewbag);
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function validate($user)
      {
            $errors = [];
            if (isEmpty($user['user_name'])) {
                  array_push($errors, 'Tiene que ingresar su correo');
            } else if (!isEmail($user['user_name'])) {
                  array_push($errors, 'Tiene que ingresar un correo válido');
            }

            if (isEmpty($user['pass'])) {
                  array_push($errors, 'Tiene que ingresar una contraseña');
            }

            return $errors;
      }


      public function register()
      {
            if (isset($_POST['register'])) {
                  extract($_POST);
                  $user = [
                        'user_name' => $user_name,
                        'pass' => $pass
                  ];

                  $errors = $this->validate($user);
                  foreach ($this->model->get() as $u) {
                        if ($u['user_name'] == $user_name) {
                              array_push($errors, 'Este usuario ya existe');
                        }
                  }

                  if (!count($errors)) {
                        if ($this->model->register($users) > 0) {
                              header('location:' . PATH . '/Products');
                        }
                  } else {
                        array_push($errors, 'Hubo un error al crear el usuario');
                        $viewBag['errors'] = $errors;
                        $viewBag['user'] = $user;
                        $this->render("signup.php", $viewBag);
                  }
            }
      }

      public function remove($id)
      {
            $this->model->remove($id);
            $_SESSION['success_message'] = "Usuario eliminado exitosamente";
            header('location:' . PATH . '/Users');
      }
}
