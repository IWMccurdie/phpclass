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

    <main>
        <?php

        $level = 4;

for ($i = 1; $i <= 6; $i++) {
    echo "<h$i>test</h$i>";
}

for ($i = 6; $i >= 1; $i--) {
    echo "<h$i>Test</h$i>";
}

$i = 1;
while ($i <= 6) {
    echo "<h$i>Test</h$i>";
    $i++;
}

while ($i > 1) {
    $i--;
    echo "<h$i>Test</h$i>";
}

$a = "100";
$b = "50";

//echo "<p>" . ($a + $b) . "</p>";

$firstName = "IAn";
$lastName = "mCcUrDiE";

//$fullName = strtolower("$firstName $lastName");

$fullName = strtolower($firstName) . " " . strtolower($lastName);

//echo $fullName;
echo strtolower($fullName);
echo $fullName[0];

        ?>

    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html>