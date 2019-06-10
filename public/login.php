<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

try {
    //$driver = new mysqli_driver();
    //$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
    $con=mysqli_init();
    mysqli_ssl_set($con, NULL, NULL, NULL, NULL, NULL);
    $connection = mysqli_real_connect($con, "openbooksdb.mysql.database.azure.com", "smartin@openbooksdb","RESTALLON123#","library_sew", 3306);

     $result = $connection->select_db('library_sew');
     $statement = $connection->prepare('SELECT email, name FROM user WHERE email = ? AND password = SHA1(?)');
     $statement->bind_param('ss', $email, $password);
     $statement->bind_result($email, $name);
     $result = $statement->execute();
     if ($statement->fetch()) {
         $_SESSION['current_user'] = [
             'email' => $email,
             'name' => $name
         ];
         header('location:myBooks.php');
     }
     else {
         header('location:login.html');
     }
} catch (Exception $e) {
    header('location: error.php?message=' . $e->getMessage());
} finally {
    $connection->close();
}

?>
