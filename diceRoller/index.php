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
    include "../includes/nav.php";

    $diceImages = [
        1 => "/diceRoller/dice_1.png",
        2 => "/diceRoller/dice_2.png",
        3 => "/diceRoller/dice_3.png",
        4 => "/diceRoller/dice_4.png",
        5 => "/diceRoller/dice_5.png",
        6 => "/diceRoller/dice_6.png"
    ];
    $diceRoll1 = rand(1, 6);
    $diceRoll2 = rand(1, 6);
    $diceRoll3 = rand(1, 6);
    $diceRoll4 = rand(1, 6);
    $diceRoll5 = rand(1, 6);


    $playerScore = $diceRoll1 + $diceRoll2;
    $computerScore = $diceRoll3 + $diceRoll4 + $diceRoll5;

    if ($playerScore > $computerScore)
    {
        $winnerMessage = "You Win!";
    }
    else if ($computerScore > $playerScore)
    {
        $winnerMessage = "Computer Wins";
    }
    else
    {
        $winnerMessage = "It's a tie";
    }
    ?>

    <main id="mainContent">
       <h1>Dice Rolling Game</h1>
        <h3>Your score is <?=$playerScore?></h3>
        <img src= "<?=$diceImages[$diceRoll1]?>" class="diceImages" alt="Players first die">
        <img src="<?=$diceImages[$diceRoll2]?>" class="diceImages" alt="Players second die">
        <h3>Computer Score is <?=$computerScore?></h3>
        <img src="<?=$diceImages[$diceRoll3]?>" class="diceImages" alt="Computer first die">
        <img src="<?=$diceImages[$diceRoll4]?>" class="diceImages" alt="Computer second die">
        <img src="<?=$diceImages[$diceRoll5]?>" class="diceImages" alt="Computer third die">
        <h3><?=$winnerMessage?></h3>
    </main>
</div>

<?php
include "../includes/footer.php"
?>

</body>
</html>