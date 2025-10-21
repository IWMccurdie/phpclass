<?php

$isHome = $_SERVER['REQUEST_URI'] == '/' ? 'selected' : '';
$isLoops = $_SERVER['REQUEST_URI'] == '/loops/' ? 'selected' : '';
$isCountdown = $_SERVER['REQUEST_URI'] == '/countdown' ? 'selected' : '';
$isMagic8Ball = $_SERVER['REQUEST_URI'] == '/magic-8ball' ? 'selected' : '';
$isMovieList = $_SERVER['REQUEST_URI'] == '/movielist' ? 'selected' : '';
$isDiceRoller = $_SERVER['REQUEST_URI'] == '/diceRoller' ? 'selected' : '';
$isCustomerList = $_SERVER['REQUEST_URI'] == '/customer' ? 'selected' : '';
$isLogin = $_SERVER['REQUEST_URI'] == '/login' ? 'selected' : '';

?>

<nav>

    <ul>
        <li class="<?=$isHome?>"><a href="/">Home</a></li>
        <li class="<?=$isLoops?>"><a href="/loops">Loops</a></li>
        <li class="<?=$isCountdown?>"><a href="/countdown">Countdown</a></li>
        <li class="<?=$isMagic8Ball?>"><a href="/magic-8ball">Magic 8 Ball</a></li>
        <li class="<?=$isMovieList?>"><a href="/movielist">Movie List</a></li>
        <li class="<?=$isDiceRoller?>"><a href="/diceRoller">Dice Roller</a></li>
        <li class="<?=$isCustomerList?>"><a href="/customer">Customer List</a></li>
        <li class="<?=$isLogin?>"><a href="/login">Login</a></li>

    </ul>
</nav>