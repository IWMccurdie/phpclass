<?php
session_start();
$memberKey = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

$errorMessage = "";

$formSubmitted = isset($_POST['hidden']);


$txtUsername = $_POST["txtUsername"];
$txtEmail = $_POST["txtEmail"];
$txtPassword = $_POST["txtPassword"];
$txtPassword2 = $_POST["txtPassword"];
$cboRole = $_POST["cboRole"];

$ADMIN_ID = 3;
if (!isset($_SESSION["memberID"]) || $_SESSION["roleID"] != $ADMIN_ID) {
    header("Location: /login");
}

if ($formSubmitted) {
    if ($txtPassword != $txtPassword2) {
        $errorMessage = "Your password must match verify password.";
    }
// todo: Check username email etc... (seperate else ifs)
    else {
        include "../includes/db.php";
        $con = getDBConnection();

        try {
            $hashedPassword = md5($txtPassword . $memberKey);

            $query = "INSERT INTO members (memberName, memberEmail, memberPassword, memberKey, roleID) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $txtUsername, $txtEmail, $hashedPassword, $memberKey, $cboRole);
            mysqli_stmt_execute($stmt);

            $txtUsername = "";
            $txtEmail = "";
            $txtPassword = "";
            $txtPassword2 = "";
            $cboRole = "";

        } catch (mysqli_sql_exception $ex) {
            //echo $ex;
            $errorMessage = $ex;
        }
    }
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
                "email email-input"
                "password password-input"
                "password2 password-input2"
                "role role-input"
                "error error"
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
                    <h3>Add New Member</h3>
                </div>

                <div class="username">
                    <label for="txtUsername">Username</label>
                </div>

                <div class="username-input">
                    <input type="text" name="txtUsername" id="txtUsername" minlength="4"  value ="<?=$txtUsername?>">
                </div>

                <div class="email">
                    <label for="txtEmail">Email</label>
                </div>

                <div class="email-input">
                    <input type="Email" name="txtEmail" id="txtEmail"  value ="<?=$txtEmail?>">
                </div>

                <div class="password">
                    <label for="txtPassword">Password</label>
                </div>
                <div class="password-input">
                    <input type="password" name="txtPassword" id="txtPassword" minlength="4" value ="<?=$txtPassword?>">
                </div>

                <div class="password2">
                    <label for="txtPassword2">Verify Password</label>
                </div>
                <div class="password-input2">
                    <input type="password" name="txtPassword2" id="txtPassword2" value ="<?=$txtPassword2?>">
                </div>

                <div class="role">
                    <label for="cboRole">Role</label>
                </div>

                <div class="role-input">

                    <?php

                        try{
                            include "../includes/db.php";
                            $con = getDBConnection();
                            $rs = mysqli_query($con,"Select * from roles");

                            echo "<select name='cboRole' id='cboRole'>";

                            while($row = mysqli_fetch_array($rs)){

                                $roleID = $row['roleID'];
                                $roleName = $row['roleName'];

                                echo "<option value='$roleID'>$roleName</option>";
                            }

                            echo "</select>";
                        }
                        catch (mysqli_sql_exception $ex){
                            echo $ex;
                        }
                    ?>
                </div>



                <div class="error <?php echo $errorMessage == "" ? "hidden" : ""; ?>">
                    <p><?=$errorMessage?></p>
                </div>



                <div class="grid-footer">
                    <input type="hidden" value="hidden" name="hidden" id="hidden">
                    <input type="submit" value="Add Member">
                </div>
            </div>
        </form>
    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html
