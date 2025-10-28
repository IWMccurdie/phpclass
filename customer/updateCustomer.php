<?php

    if (empty($_GET["id"]))
    {
        header("Location: index.php");
    }

include "../includes/db.php";
$con = getDBConnection();

    $customerID = $_GET["id"];

try {
    $query = "SELECT * FROM customers WHERE CustomerID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $customerID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

    $firstName = $row['FirstName'];
    $lastName = $row['LastName'];
    $address = $row['Address'];
    $city = $row['City'];
    $state = $row['State'];
    $zip = $row['Zip'];
    $phone = $row['Phone'];
    $email = $row['Email'];
    $password = $row['Password'];
}
catch (mysqli_sql_exception $ex) {
    echo $ex;
}

//Do the update (update the db)

if (!empty($_POST["txtFirst"]) && !empty($_POST["txtLast"])
    && !empty($_POST["txtAddress"]) && !empty($_POST["txtCity"])
    && !empty($_POST["txtState"]) && !empty($_POST["txtZip"])
    && !empty($_POST["txtPhone"]) && !empty($_POST["txtEmail"])
    && !empty($_POST["txtPassword"]) && !empty($_POST["txtVerify"])) {

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

    try {
        $query = "UPDATE customers SET FirstName = ?, LastName = ?, Address = ?, City = ?, State = ?, Zip = ?, Phone = ?, Email = ?, Password = ? WHERE CustomerID = ?;";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssss", $txtFirst, $txtLast, $txtAddress, $txtCity, $txtState, $txtZip, $txtPhone, $txtEmail, $txtPassword, $customerID);
        mysqli_stmt_execute($stmt);

        header("Location: index.php");
    }
    catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



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
                    <h3>Update Customer</h3>
                </div>

                <div class="firstName">
                    <label for="txtFirst">First Name</label>
                </div>
                <div class="firstName-input">
                    <input type="text" name="txtFirst" id="txtFirst" value="<?=$firstName?>">
                </div>

                <div class="lastName">
                    <label for="txtLast">Last Name</label>
                </div>
                <div class="lastName-input">
                    <input type="text" name="txtLast" id="txtLast" value="<?=$lastName?>">
                </div>

                <div class="address">
                    <label for="txtAddress">Address</label>
                </div>
                <div class="address-input">
                    <input type="text" name="txtAddress" id="txtAddress" value="<?=$address?>">
                </div>

                <div class="city">
                    <label for="txtCity">City</label>
                </div>
                <div class="city-input">
                    <input type="text" name="txtCity" id="txtCity" value="<?=$city?>">
                </div>

                <div class="state">
                    <label for="txtState">State</label>
                </div>
                <div class="state-input">
                    <input type="text" name="txtState" id="txtState" value="<?=$state?>">
                </div>

                <div class="zip">
                    <label for="txtZip">Zip</label>
                </div>
                <div class="zip-input">
                    <input type="text" name="txtZip" id="txtZip" value="<?=$zip?>">
                </div>

                <div class="phone">
                    <label for="txtPhone">Phone</label>
                </div>
                <div class="phone-input">
                    <input type="tel" name="txtPhone" id="txtPhone" value="<?=$phone?>">
                </div>

                <div class="email">
                    <label for="txtEmail">Email</label>
                </div>
                <div class="email-input">
                    <input type="email" name="txtEmail" id="txtEmail" value="<?=$email?>">
                </div>

                <div class="password">
                    <label for="txtPassword">Password</label>
                </div>
                <div class="password-input">
                    <input type="password" name="txtPassword" id="txtPassword" value="<?=$password?>">
                </div>

                <div class="passwordVerification">
                    <label for="txtVerify">Verify Password</label>
                </div>
                <div class="verifyPassword-input">
                    <input type="password" name="txtVerify" id="txtVerify">
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Update Customer">
                    <input type="button" value="Delete Customer" id="delete">
                </div>

            </div>
        </form>
    </main>
</div>

<?php
include "../includes/footer.php"
?>

<script>
    const deleteButton = document.querySelector('#delete')
    deleteButton.addEventListener('click', () => {
        if (confirm("Are you sure you want to delete?")) {
            window.location ='./deleteCustomer.php?id=<?=$customerID?>'
        }
    })
</script>

</body>
</html>