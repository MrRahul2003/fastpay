<?php
// connecting to database
include '../partials/_connect.php';
$signin = false;

// collecting data from form and storing in the variables
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    // checking the existance of user in our database
    $sql = "SELECT * FROM `login` WHERE user_name='$user_name'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    // echo $num;
    if ($num != 0) {
        // echo "<br> User Name exists! Try Another User Name";
    } else {          
        // conveting the passworrd into hash value
        $hash = password_hash($user_password,PASSWORD_DEFAULT);

        // Adding data to server
        $sql = "INSERT INTO `login` (`user_name`, `user_password`, `user_date_time`) VALUES ('$user_name', '$hash', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if (!$result) {
            // echo "<br> data cannot be inserted successfully!";
        } 
        else { 
            // echo "Data inserted successfully! <br>";
            // echo "Redirecting to login page";
            session_start();
            $_SESSION['signin'] = true;
            $_SESSION['user_name'] = $user_name;
            // header("location: _login.php");  
            header("location: ../payment/_set_balance.php");
        }
    }               
}         
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
    </style>
</head>

<body>
    <div class="modal modal-signin position-static d-block bg-light py-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <!-- <h5 class="modal-title">Modal title</h5> -->
                    <h2 class="fw-bold mb-0">Sign up for free</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form class="" action="_signin.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="floatingInput"
                                placeholder="name@example.com" name="user_name">
                            <label for="floatingInput">User Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="floatingPassword"
                                placeholder="Password" name="user_password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Sign up</button>
                        <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                        <hr class="my-1">
                        <p class="lead">
                            <a href="_login.php" class="w-100 my-2 btn btn-lg rounded-3 btn-primary">Log in</a>
                        </p>
                        <hr >
                        <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
                        <button class="w-100 py-2 mb-2 btn btn-outline-dark rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#google"></use>
                            </svg>
                            Sign up with Google
                        </button>
                        <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#facebook"></use>
                            </svg>
                            Sign up with Facebook
                        </button>
                        <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#github"></use>
                            </svg>
                            Sign up with GitHub
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>