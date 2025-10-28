<?php

if (!empty($_GET["id"])) {
    include "../includes/db.php";
    $con = getDBConnection();

    $customerID = $_GET["id"];

    try {
        $query = "DELETE FROM customers WHERE customerID = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $customerID);
        mysqli_stmt_execute($stmt);

    }
    catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}

header("Location: index.php");