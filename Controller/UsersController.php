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
                        'userType' => $_SESSION['userType'],
                        'user' => $_SESSION['user']
                  ];

                  $this->render('index.php', $viewbag);
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function update($id)
      {
            if (isset($_POST['Save'])) {
                  $user = [
                        'user_name' => $id,
                        'id_user_type' => $_POST['user_type']
                  ];
                  $this->model->update($user);
                  $_SESSION['success_message'] = 'El usuario fue editado';
            } else {
                  $_SESSION['error_message'] = 'El no usuario fue editado, ocurrió un error';
            }
            header('location:' . PATH . '/Users');
      }



      public function validate($user)
      {
            $errors = [];
            if (isEmpty($user['user_name'])) {
                  array_push($errors, 'Tiene que ingresar su correo');
            }

            if (isEmpty($user['pass'])) {
                  array_push($errors, 'Tiene que ingresar una contraseña');
            }

            return $errors;
      }


      public function register()
      {
            if (isset($_POST['Save'])) {
                  extract($_POST);
                  $user = [
                        'user_name' => $user_name,
                        'pass' => $pass,
                        'id_user_type' => $user_type
                  ];

                  $errors = $this->validate($user);
                  foreach ($this->model->get() as $u) {
                        if ($u['user_name'] == $user_name) {
                              array_push($errors, 'Este usuario ya existe');
                        }
                  }

                  if (!count($errors)) {
                        $this->model->register($user);
                        $_SESSION['success_message'] = 'El usuario fue creado correctamente';
                        header('location:' . PATH . '/Users');
                  } else {
                        array_push($errors, 'Hubo un error al crear el usuario');
                        $viewBag['errors'] = $errors;
                        $viewBag['user'] = $user;
                        $this->render("new.php", $viewBag);
                  }
            }
      }

      public function create()
      {
            if ($_SESSION['userType'] == 'admin') {
                  $user_types = $this->model->getTypes();
                  $viewBag = [
                        'user_types' => $user_types
                  ];
                  $this->render("new.php", $viewBag);
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function edit($id)
      {
            if ($id != $_SESSION['user']) {
                  $user = $this->model->get($id);
                  $user_types = $this->model->getTypes();
                  $viewBag = [
                        'user' => $user,
                        'user_types' => $user_types
                  ];
                  $this->render("edit.php", $viewBag);
            } else {
                  $_SESSION['error_message'] = 'No puede editar su usuario';
                  header('location:' . PATH . '/Users');
            }
      }

      public function remove($id)
      {
            $this->model->remove($id);
            $_SESSION['success_message'] = "Usuario eliminado exitosamente";
            header('location:' . PATH . '/Users');
      }
}
