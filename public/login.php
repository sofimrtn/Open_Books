<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $driver = mysqli_init();
    $driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

    $connection = mysqli_real_connect($driver, 'openbooksdb.mysql.database.azure.com', 'smartin@openbooksdb', 'RESTALLON123#', 3306);

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
