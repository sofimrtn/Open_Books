<?php
session_start();
if (isset($_SESSION['current_user'])) {
    $email = $_SESSION['current_user']['email'];

    try {
        $driver = mysqli_init();
        $driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

         mysqli_real_connect($driver, 'openbooksserver.mysql.database.azure.com', 'smartin@openbooksserver', 'RESTALLON123#', 'library_sew', 3306);

         $statement = $driver->prepare('SELECT ISBN, Title, user, portada FROM book WHERE user = ?');
         $statement->bind_param('s', $email);
         $statement->bind_result($isbn, $title, $user, $portada);
         $statement->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Books</title>
    <link rel="shortcut icon" href="../static/img/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="myBooks_ratings.js"></script>
    <link rel="stylesheet" type="text/css" href="../myBooks_flex.css" />
</head>
<body>
<div class="sidebar">
  <a class="active" href="myBooks.php">Home</a>
  <a href="../booksAll.html">All Books</a>
  <a href="../authors.html">Authors</a>
  <a href="../clasics.html">Clasics</a>
  <a href="../bestSellings.html">Best Sellings</a>
  <a href="../series.html">Series</a>
  <a href="../events.html">Events</a>
  <a href="../shops.html">Shops</a>
  <a href="../guide.html">Guide</a>
  <a class="logout" href="../index.html">Log out</a>
</div>
<article class="container">
<h1>My Books</h1>
<p id="info">Click a book for more info </p>
<ul class="lista">
<?php
         while ($statement->fetch()) {
?>
        <ul class="flex-item">
            <div><a href="#" class="link-libro" data-isbn="<?php echo $isbn ?>"><img src="<?php echo $portada ?>"/></a></div>
        </ul>

<?php
         }
?>
</ul>
<div id="popup-info-libro" role="dialog">
    <h2 id="titulo-popup"></h2>
    <h3 id="subtitulo-popup"></h3>
    <p>Author: <span id="author-popup"></span></p>
    <p>Publisher: <span id="editorial-popup"></span></p>
    <p>Pages: <span id="pages-popup"></span></p>
    <p id="date-popup"></p>
    <p>Subjects: <span id="subject-popup"></span></p>
    <p></p>
    <a href="#" id="link-cerrar-popup">Close</a>
    <a href="" id="link-info-popup">More info</a>
</div>
<script type="text/javascript">
    $('a#link-cerrar-popup').click(function (e) { e.preventDefault(); $('#popup-info-libro').slideUp(); });
    $('a.link-libro').click(function(e){ e.preventDefault(); clienteServicio.obtenerRatings($(this).attr('data-isbn')); })
</script>
</article>
</body>
</html>
<?php

    } catch (Exception $e) {
        header('location: error.php?message=' . urlencode($e->getMessage()));
    } finally {
        $driver->close();
    }
}
else {
    header('location:login.php');
}
?>

