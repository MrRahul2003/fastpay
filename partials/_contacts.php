
    <?php
    $login_user_id = $_SESSION['login_user_id'];

    //connecting to db
    include '_connect.php';

    //selecting all friends from db
    $sql = "SELECT * FROM `friends` WHERE login_user_id=$login_user_id";
    $result = mysqli_query($conn,$sql);
    
    //finding no of friends available in db
    $rowNO = mysqli_num_rows($result);

    if (!$result) {
        // echo "friend disconnected";
    } else {
        // echo "friend connected";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Phone Contacts</title>
    </head>

    <body>

        <div class="container px-4 py-5" id="icon-grid">
            <h2 class="pb-2 border-bottom">Phone Contacts</h2>
        </div>
        <div class="container">
            <div class="card text-center ">
                <div class="card-body">
                    <div class="row">
                        <?php
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo
                            '<div class="col-md-2 my-4"><object data="svg/svg-p'.++$index.'.svg" width="50" height="50"> </object>
                            <a class="nav-link py-0 my-0" href="#"><small>'.$row['user_friend_name'].'</small></a></div>';
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>