<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $driver = mysqli_init();
    $connection = mysqli_real_connect($driver, 'openbooksserver.mysql.database.azure.com', 'smartin@openbooksserver', 'RESTALLON123#', 'library_sew', 3306);
     $statement = $connection->prepare('INSERT INTO user (email, password, name) VALUES (?, SHA1(?), ?);');
     $statement->bind_param('sss', $email, $password, $name);
     $result = $statement->execute();
     if ($result) {
         $_SESSION['current_user'] = [
             'email' => $email,
             'name' => $name
         ];
         header('location:myBooks.php');
     }
     else {
         header('location:register.html');
     }
} catch (Exception $e) {
    header('location: error.php?message=' . $e->getMessage());
} finally {
    $connection->close();
}

?>
