<?php
session_start();

echo 'Logged as '. $_SESSION['current_user']['email'] . ' ' . $_SESSION['current_user']['name'];
?>
