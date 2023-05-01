<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Here you can process the form data, for example, send an email
  // to the website owner with the form contents.

  echo "Thank you for your submission!";
} else {
  // Redirect the user back to the form if the request method is not POST.
  header("Location: form.html");
  exit();
}
?>
<?php
// connect to database
$db = new PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');

// sanitize input data
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// insert data into database
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $db->prepare($sql);
$stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

// redirect user to a confirmation page
header('Location: confirmation.php');
exit();
?>
