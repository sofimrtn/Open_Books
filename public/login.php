<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $driver = mysqli_init();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_real_connect($driver,'openbooksserver.mysql.database.azure.com', 'smartin@openbooksserver', 'RESTALLON123#', 'library_sew', 3306);

     $statement = $driver->prepare('SELECT email, name FROM user WHERE email = ? AND password = SHA1(?)');
     $statement->bind_param('ss', $email, $password);
     $statement->bind_result($email, $name);
     $statement->execute();
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
    $driver->close();
}

?>
