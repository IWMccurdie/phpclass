<?php

    if (empty($_GET["id"]))
    {
        header("Location: /movielist");
    }

include "../includes/db.php";
$con = getDBConnection();

    $movieID = $_GET["id"];

try {
    $query = "SELECT * FROM movielist WHERE movieID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $movieID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

    $movieTitle = $row["movieTitle"];
    $movieRating = $row["movieRating"];
}
catch (mysqli_sql_exception $ex) {
    echo $ex;
}

//Do the update (update the db)

if (!empty($_POST["txtTitle"]) && !empty($_POST["txtRating"])) {


    $txtTitle = $_POST["txtTitle"];
    $txtRating = $_POST["txtRating"];


    try {
        $query = "UPDATE movielist SET MovieTitle = ?, MovieRating = ? WHERE MovieID = ?;";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $txtTitle, $txtRating, $movieID);
        mysqli_stmt_execute($stmt);

        header("Location: /movielist");
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
    <link rel="stylesheet" href="./css/grid.css">

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
                    <h3>Update Movie</h3>
                </div>

                <div class="movie-title">
                    <label for="txtTitle">Movie Title</label>
                </div>

                <div class="title-input">
                    <input type="text" name="txtTitle" id="txtTitle" value="<?=$movieTitle?>">
                </div>
                <div class="movie-rating">
                    <label for="txtRating">Movie Rating</label>
                </div>
                <div class="rating-input">
                    <input type="text" name="txtRating" id="txtRating" value="<?=$movieRating?>">
                </div>
                <div class="grid-footer">
                    <input type="submit" value="Update Movie">
                    <input type="button" value="Delete Movie" id="delete">
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
        window.location ='./delete.php?id=<?=$movieID?>'
    })
</script>

</body>
</html>