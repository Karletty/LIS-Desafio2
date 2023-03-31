<?php
require_once 'Controller.php';
require_once './Model/SalesModel.php';
require_once './Core/dateSort.php';
require_once './Core/validations.php';
require_once './vendor/autoload.php';
require_once './Phpmailer/Exception.php';
require_once './Phpmailer/PHPMailer.php';
require_once './Phpmailer/SMTP.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SalesController extends Controller
{
      private $model;

      function __construct()
      {
            if (isset($_SESSION['userType'])) {
                  $this->model = new SalesModel();
            } else {
                  header('location:' . PATH . '/Clients/login');
            }
      }

      public function index()
      {
            if ($_SESSION['userType'] != 'client') {
                  $sales = $this->model->get();
                  uasort($sales, 'dateSort');

                  $viewbag = [
                        'sales' => $sales
                  ];

                  $this->render('index.php', $viewbag);
            } else {
                  renderErrorPrivilegeView();
            }
      }

      public function add($id)
      {
            if (!isset($_SESSION['shopping_cart'])) {
                  $_SESSION['shopping_cart'] = [];
            }
            $_SESSION['shopping_cart'][$id] = array_key_exists($id, $_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'][$id] + ($_POST['quantity'] ? $_POST['quantity'] : 1) : ($_POST['quantity'] ? $_POST['quantity'] : 1);

            $_SESSION['success_message'] = $_POST['quantity'] > 1  ? "Los productos han sido añadido al carrito" : "El producto ha sido añadido al carrito";


            header('location:' . PATH . '/Sales');
      }

      public function removeShopping()
      {
            unset($_SESSION['shopping_cart']);

            header('location:' . PATH . '/Sales');
      }

      public function removeAll($id)
      {
            unset($_SESSION['shopping_cart'][$id]);

            $_SESSION['success_message'] = "Se removió un grupo de productos del carrito";

            header('location:' . PATH . '/Sales');
      }

      public function removeOne($id)
      {
            if ($_SESSION['shopping_cart'][$id] == 1) {
                  unset($_SESSION['shopping_cart'][$id]);
            } else {
                  $_SESSION['shopping_cart'][$id] -= 1;
            }

            $_SESSION['success_message'] = "Se removió un productos del carrito";

            header('location:' . PATH . '/Sales');
      }

      private function sendPDF($filePath)
      {
            $userMail = $_SESSION['user'];
            //Enviar correo

            try {
                  $mail = new PHPMailer(true);
                  $mail->IsSMTP();
                  $mail->CharSet = 'utf-8';
                  $mail->SMTPDebug = 0;
                  $mail->SMTPSecure = 'tls';

                  $mail->SMTPAuth = 'true';
                  // Enables SMTP authentication.

                  $mail->Host = "smtp.gmail.com";
                  // SMTP server host.
                  $mail->Port = 587;
                  // Setting the SMTP port for the GMAIL server.


                  //Usuario con contraseña autorizada por gmail
                  $mail->Username = "textil.export1234@gmail.com";
                  // SMTP account username (GMail email address).
                  $mail->Password = 'pxdzgqcjfptiwale';
                  // Contraseña creada a partir de google,
                  // para permisos de aplicacion

                  //Envio de mensaje
                  $mail->SetFrom('textil.export1234@gmail.com', 'Textil Export');
                  // De quien - match the GMail email.
                  $mail->AddAddress($userMail, 'Someone Else');
                  // Para email / name.

                  //Mensaje
                  $mail->Subject = 'Confirmación de compra';
                  $mail->Body = 'Se adjunta la cotización de los productos comprados el día de hoy.';
                  $mail->addAttachment($filePath);
                  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

                  //Para enviar
                  $mail->send();
            } catch (Exception $e) {
                  var_dump($e);
            }
      }

      private function createPDF()
      {
            $token = substr(bin2hex(openssl_random_pseudo_bytes(16)), 24);
            $products = [];
            if (isset($_SESSION['shopping_cart'])) {
                  foreach ($_SESSION['shopping_cart'] as $key => $value) {
                        $products[$key] = $this->model->getProdCart($key);
                        $products[$key]['quantity'] = $value;
                  }
            }
            $dompdf = new Dompdf();
            ob_start();
            require_once "./View/ShoppingCart/template.php";
            $html = ob_get_clean();
            $html .= '<style>' . file_get_contents('./View/assets/css/bootstrap.min.css') . '</style>';
            // ob_get_clean captura toda la información
            // y lo amacenamos en una variable

            $dompdf->loadHtml($html);
            // loadHtml carga la información contenida
            // en la variable $html

            $basePath = "./pdfs/";
            // se define una ruta en donde se gurdara el pdf

            $fileName =  explode('@', $_SESSION['user'])[0] . "_$token.pdf";
            $filePath = $basePath . $fileName;

            $dompdf->render();
            // define el nombre y la disposicion en la
            // que se vera el documento en el navegador
            $outPut = $dompdf->output();

            file_put_contents($filePath, $outPut);
            // funcion que mueve el archivo a la ruta definida 

            $this->sendPdf($filePath);
            return $fileName;
      }

      public function validatePayment()
      {
            if (isset($_POST['pay'])) {
                  $errors = [];
                  $errors['cc_number'] = validateCreditCard($_POST['cc_number']);
                  $errors['user_name'] = validateText($_POST['user_name']);
                  $errors['user_lastname'] = validateText($_POST['user_lastname']);
                  $errors['cvv'] = validateCVV($_POST['cvv']);
                  $errors['exp_date'] = validateDate($_POST['exp_date']);
                  if (count($errors) != 0) {
                        $file = $this->createPDF();
                        $date = getdate()['mday'] . '/' . getdate()['mon'] . '/' . getdate()['year'];
                        $sale = [
                              'id_client' => $_SESSION['user'],
                              'file_path' => $file,
                              'sale_date' => $date
                        ];
                        $id_sale = $this->model->insertSale($sale);
                        foreach ($_SESSION['shopping_cart'] as $product => $value) {
                              $sale_detail = [
                                    'id_sale' => $id_sale,
                                    'quantity' => $value,
                                    'id_product' => $product
                              ];
                              $this->model->insertSaleDetail($sale_detail);
                        }
                        $_SESSION['success_message'] = 'Pago realizado con éxito';
                  } else {
                        $_SESSION['success_message'] = 'Hubo un error al realizar el pago';
                  }
                  header('location:' . PATH . '/ShoppingCart/removeShopping');
            }
      }
}
