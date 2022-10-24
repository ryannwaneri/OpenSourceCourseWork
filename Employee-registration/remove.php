<?php
    session_start();
    if (!isset($_SESSION['authenticate'])) {
        echo "<h2 style='color:red;text-align:center;'>Direct access is not allowed. Redirecting....<h2>";
        header("refresh:3;url=./index.php");
        die();
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("refresh:3;url=./display.php");
        die();
    }

    // GET USER ID
    $id = $_POST["id"] ?? "";

    if ($id && ctype_digit($id)) {
        $id = htmlspecialchars($id);
        $id = strip_tags($id);

        //PERFORM DELETION
        include_once('connect.php');
        $sql = "DELETE FROM employee WHERE emp_id = '$id'";
        $result = $conn-> query ($sql);
        if ($result) {
            $_SESSION["successful_delete"] = true;
            header("refresh:0;url=./display.php");
            die();
        }

    } else {
        header("refresh:0;url=./display.php");
        die();
    }
    

?>