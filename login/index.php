<?php

    session_start();

$errorMessage = "";

$txtUsername = $_POST["txtUsername"];
$txtPassword = $_POST["txtPassword"];

include "../includes/db.php";
$con = getDBConnection();

try {

    $query = "SELECT * FROM members WHERE memberName = ? AND memberPassword = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $txtUsername, $txtPassword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_array($result);
    var_dump($row);

    $_SESSION["userID"] = $row["memberID"];
    $_SESSION["roleID"] = $row["roleID"];

    if ($row["roleID"] == 3) {
        header("Location: admin.php");
    }
    else if ($row["roleID"] == 1) {
        header("Location: member.php");
    }
    else
    {
        $errorMessage = "There was an error.";
    }

}catch (mysqli_sql_exception $ex) {
    //echo $ex;
    $errorMessage = $ex;
}





?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="css/grid.css">
    <style>
        .grid-container{
            grid-template-areas:
                "grid-header grid-header"
                "username username-input"
                "password password-input"
                "error-message error-message"
                "grid-footer grid-footer"
        ;
        }
    </style>

</head>
<body>
<?php
include "../includes/header.php"
?>
<div id="three-column">

    <?php
    include "../includes/nav.php"
    ?>

    <main id="mainContent">
        <form method="post">
            <div class="grid-container">
                <div class="grid-header">
                    <h3>Member Login</h3>
                </div>

                <div class="username">
                    <label for="txtUsername">Username</label>
                </div>

                <div class="username-input">
                    <input type="text" name="txtUsername" id="txtUsername"  value ="<?=$txtUsername?>">
                </div>
                <div class="password">
                    <label for="txtPassword">Password</label>
                </div>
                <div class="password-input">
                    <input type="password" name="txtPassword" id="txtPassword" value ="<?=$txtPassword?>">
                </div>

                <div class="error <?php
                echo $errorMessage == "" ? "hidden" : "" ?>?>">
                    <p><?=$errorMessage?></p>
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Login">
                </div>

            </div>
        </form>    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html