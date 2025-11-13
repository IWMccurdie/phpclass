<?php
session_start();
$memberKey = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

    $errorMessage = "";

    if (!empty($_POST["txtFirst"]) && !empty($_POST["txtLast"])
        && !empty($_POST["txtAddress"]) && !empty($_POST["txtCity"])
        && !empty($_POST["txtState"]) && !empty($_POST["txtZip"])
        && !empty($_POST["txtPhone"]) && !empty($_POST["txtEmail"])
        && !empty($_POST["txtPassword"])) {
        include "../includes/db.php";
        $con = getDBConnection();

        $txtFirst = $_POST["txtFirst"];
        $txtLast = $_POST["txtLast"];
        $txtAddress = $_POST["txtAddress"];
        $txtCity = $_POST["txtCity"];
        $txtState = $_POST["txtState"];
        $txtZip = $_POST["txtZip"];
        $txtPhone = $_POST["txtPhone"];
        $txtEmail = $_POST["txtEmail"];
        $txtPassword = $_POST["txtPassword"];
        $txtVerify = $_POST["txtVerify"];


        if ($txtPassword != $txtVerify)
        {
            $errorMessage = "Your passwords do not match.";
        }
        else
        {
            try {
                $hashedPassword = md5($txtPassword . $memberKey);

                $query = "INSERT INTO customers (FirstName, LastName, Address, City, State, Zip, Phone, Email, Password, MemberKey ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? );";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "sssssissss", $txtFirst, $txtLast, $txtAddress, $txtCity, $txtState, $txtZip, $txtPhone, $txtEmail, $hashedPassword, $memberKey );
                mysqli_stmt_execute($stmt);

                header("Location: /customer");
            }
            catch (mysqli_sql_exception $ex) {
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
    <title>Customers</title>
    <link rel="stylesheet" href="/css/base.css">

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
                    <h3>Add New Customer</h3>
                </div>

                <div class="firstName">
                    <label for="txtFirst">First Name</label>
                </div>
                <div class="firstName-input">
                    <input type="text" name="txtFirst" id="txtFirst">
                </div>

                <div class="lastName">
                    <label for="txtLast">Last Name</label>
                </div>
                <div class="lastName-input">
                    <input type="text" name="txtLast" id="txtLast">
                </div>

                <div class="address">
                    <label for="txtAddress">Address</label>
                </div>
                <div class="address-input">
                    <input type="text" name="txtAddress" id="txtAddress">
                </div>

                <div class="city">
                    <label for="txtCity">City</label>
                </div>
                <div class="city-input">
                    <input type="text" name="txtCity" id="txtCity">
                </div>

                <div class="state">
                    <label for="txtState">State</label>
                </div>
                <div class="state-input">
                    <input type="text" name="txtState" id="txtState">
                </div>

                <div class="zip">
                    <label for="txtZip">Zip</label>
                </div>
                <div class="zip-input">
                    <input type="text" name="txtZip" id="txtZip">
                </div>

                <div class="phone">
                    <label for="txtPhone">Phone</label>
                </div>
                <div class="phone-input">
                    <input type="tel" name="txtPhone" id="txtPhone">
                </div>

                <div class="email">
                    <label for="txtEmail">Email</label>
                </div>
                <div class="email-input">
                    <input type="email" name="txtEmail" id="txtEmail">
                </div>

                <div class="password">
                    <label for="txtPassword">Password</label>
                </div>
                <div class="password-input">
                    <input type="password" name="txtPassword" id="txtPassword">
                </div>

                <div class="passwordVerification">
                    <label for="txtVerify">Verify Password</label>
                </div>
                <div class="verifyPassword-input">
                    <input type="password" name="txtVerify" id="txtVerify">
                </div>


                <div class="error <?php
                echo $errorMessage == "" ? "hidden" : "" ?>?>">
                    <p><?=$errorMessage?></p>
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Add Customer">
                </div>

            </div>
        </form>
    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html>