<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['loginUsername'];
    $passwd = $_POST['loginPassword'];

    $query = "SELECT * FROM user WHERE name = :name AND password = :passwd";
    $statement = $db->prepare($query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':passwd', $passwd);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        session_start();
        $_SESSION['name'] = $name;

        if ($name === 'oussama' && $passwd === 'oussama') {
            header('Location: admin.php');
            exit();
        } else {
            header('Location: ../public/index.php');
            exit();
            }
    } else {
        echo  "<script>alert(\"Invalid password\")</script>";
        echo "<script>window.history.back();</script>";

    }
}
?>
