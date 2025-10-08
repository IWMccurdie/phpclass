<?php

function getDBConnection()
{
    $host = "localhost";
    $host = "dbuser";
    $host = "dbdev123";
    $host = "phpclass";
    return mysqli_connect("localhost","dbuser","dbdev123","phpclass");
}
