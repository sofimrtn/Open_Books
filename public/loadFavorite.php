<?php
session_start();
if (isset($_SESSION['current_user'])) {

    $isbn = $_GET['isbn'];
    $title = $_GET['title'];
    $portada = $_GET['portada'];

    $email = $_SESSION['current_user']['email'];

    try {
        $driver = mysqli_init();
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        mysqli_real_connect($driver,'openbooksserver.mysql.database.azure.com', 'smartin@openbooksserver', 'RESTALLON123#', 'library_sew', 3306);

         $statement = $driver->prepare('INSERT INTO book (ISBN, Title, user, portada) VALUES (?, ?, ?, ?);');
         $statement->bind_param('ssss', $isbn, $title, $email, $portada);

         if ($statement->execute()) {
             $result = [
                'result' => true
             ];
         }
         else {
             $result = [
                'result' => false,
                'error' => 'La consulta no inserto nada'
             ];
         }
    } catch (Exception $e) {
        $result = [
            'result' => false,
            'error' => $e->getMessage()
        ];
    } finally {
        $driver->close();
    }

}
else{
    $result = [
        'result' => false,
        'error' => 'Usuario no logeado'
    ];
}

header('Content-Type: application/json');
echo json_encode($result);

?>
