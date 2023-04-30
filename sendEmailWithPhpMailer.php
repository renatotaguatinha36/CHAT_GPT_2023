<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Load PHPMailer classes into the global namespace
require_once './PHPMailer/src/PHPMailer.php';
require_once './PHPMailer/src/Exception.php';
require_once './PHPMailer/src/SMTP.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  // Sanitize the form data
  $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);

  // Create a new PHPMailer instance
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                 //Enable verbose debug output
    $mail->isSMTP();                                      //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth = true;                               //Enable SMTP authentication
    $mail->Username = 'youremail@gmail.com';              //SMTP username
    $mail->Password = 'yourpassword';                      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 587;                                    //TCP port to connect to

    //Recipients
    $mail->setFrom('youremail@gmail.com', 'Your Name');
    $mail->addAddress('recipientemail@example.com', 'Recipient Name');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Form Submission';
    $mail->Body    = "Name: $name <br> Email: $email <br> Message: $message";
    
    // Send the email
    $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
  }
}
?>
