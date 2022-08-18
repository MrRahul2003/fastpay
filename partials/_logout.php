<?php
    include '../partials/_connect.php';

    session_start();
    session_unset();
    session_destroy();
    header("location: _login.php");
    exit;
       
?>
<!-- **************************************************************************  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
</head>

<body>
    <?php include '../partials/_nav.php'; ?>


<h1>Welcome to Login page</h1>
    </div>
</body>

</html>