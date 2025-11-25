<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <?php

        echo view('includes/header');
        echo view('includes/menu');

        ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit Race
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">

                    <form role="form" method="post" action="/marathon/public/edit_race">

                        <div class="form-group">
                            <label for="race_name">Race Name</label>
                            <input name="race_name" id="race_name" class="form-control" value="<?=$race['raceName']?>">
                        </div>

                        <div class="form-group">
                            <label for="race_description">Race Description</label>
                            <textarea name="race_description" id="race_description" class="form-control"><?=$race['raceDescription']?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="race_location">Race Location</label>
                            <input name="race_location" id="race_location" class="form-control" value="<?=$race['raceLocation']?>">
                        </div>

                        <div class="form-group">
                            <label for="race_datetime">Race Date and Time</label>
                            <input type="datetime-local" name="race_datetime" id="race_datetime" class="form-control" value="<?=$race['raceDateTime']?>">
                        </div>

                        <input type="hidden" name="race_id" value="<?=$race['raceID']?>">
                        <button type="submit" class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-default">Reset Button</button>

                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

</body>

</html>

