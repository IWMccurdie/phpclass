<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>
    <style>
        table,th,td{
            border-width: 1px;
            table-layout: fixed;
            width: 90%;
        }
        table a {
            color: darkblue;
        }
        table a:hover{
            text-decoration: underline;
        }
    </style>
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
        <h3>Customer List</h3>
        <table border="1" width="90%">
            <tr>
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
            </tr>

            <?php

            try{
                include "../includes/db.php";
                $con = getDBConnection();
                $rs = mysqli_query($con,"Select * from customers");

                while($row = mysqli_fetch_array($rs)){

                    $customerID = $row['CustomerID'];
                    $firstName = $row['FirstName'];
                    $lastName = $row['LastName'];
                    $address = $row['Address'];
                    $city = $row['City'];
                    $state = $row['State'];
                    $zip = $row['Zip'];
                    $phone = $row['Phone'];
                    $email = $row['Email'];
                    $password = $row['Password'];


                    echo "<tr>";
                    echo "<td><a href='updateCustomer.php?id=$customerID'>$customerID</a></td>";
                    echo "<td>$firstName</td>";
                    echo "<td>$lastName</td>";
                    echo "<td>$address</td>";
                    echo "<td>$city</td>";
                    echo "<td>$state</td>";
                    echo "<td>$zip</td>";
                    echo "<td>$phone</td>";
                    echo "<td>$email</td>";
                    echo "<td>$password</td>";
                    echo "</tr>";
                }
            }
            catch (mysqli_sql_exception $ex){
                echo $ex;
            }
            ?>


        </table>
        <a href="addcustomer.php">Add Customer</a>
    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html>