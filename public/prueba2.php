<?php
session_start();

echo 'User added '. $_SESSION['current_user']['email'] . ' ' . $_SESSION['current_user']['name'];
?>
