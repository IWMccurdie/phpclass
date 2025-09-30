<?php
$secPerMin = 60;
$secPerHour = 60 * $secPerMin;
$secPerDay = 24 * $secPerHour;
$secPerYear = 365 * $secPerDay;

$now = time();
$endOfSemester = mktime(21, 30,0, 12,16,2025);

$seconds = $endOfSemester - $now;

$years = floor($seconds/$secPerYear);
$seconds = $seconds - ($years * $secPerYear);

$days = floor($seconds / $secPerDay);
$seconds = $seconds - ($days * $secPerDay);

$hours = floor($seconds / $secPerHour);
$seconds = $seconds - ($hours * $secPerHour);

$minutes = floor($seconds / $secPerMin);
$seconds = $seconds - ($minutes * $secPerMin)

?><!doctype html>
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
        <h3>End of semester timer</h3>
        <span>Years: <?=$years?> | Days: <?=$days?> | Hours: <?=$hours?> | Minutes: <?=$minutes?> | Seconds: <?=$seconds?></span>
    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html>