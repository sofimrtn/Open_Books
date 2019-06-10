<?php
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $connection = new mysqli('localhost', 'root', '');
    echo 'connect success';
     $result = $connection->select_db('library_sew');
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
