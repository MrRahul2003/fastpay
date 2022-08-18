<?php
// connecting to database
include '../partials/_connect.php';

$login = false;

// collecting data from form and storing in the variables
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    // checking the existance of user in our database
    $sql = "SELECT * FROM `login` WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);

    // checking users existance in our databases
    $rowsNO = mysqli_num_rows($result);
    // echo $rowsNO;

    if ($rowsNO == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($user_password, $row['user_password'])) {
                // echo "Log in successful!";
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['login_user_id'] = $row['user_id'];
                header("location: ../index.php");
            } else {
                // echo "login ussuccessful!";
            }
        }
    } else {
        // echo "Log in unsuccessful! Sign in first";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="modal modal-signin position-static d-block bg-light py-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <!-- <h5 class="modal-title">Modal title</h5> -->
                    <h2 class="fw-bold mb-0">Login for free</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form action="_login.php" method='POST'>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="floatingInput"
                                placeholder="name@example.com" name="user_name">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="floatingPassword"
                                placeholder="Password" name="user_password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Login</button>
                        <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                        <hr class="my-1">
                        <p class="lead">
                            <a href="_signin.php" class="w-100 my-2 btn btn-lg rounded-3 btn-primary">Sign up</a>
                        </p>
                        <hr >
                        <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
                        <button class="w-100 py-2 mb-2 btn btn-outline-dark rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#google"></use>
                            </svg>
                            Log in with Google
                        </button>
                        <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#facebook"></use>
                            </svg>
                            Log in with Facebook
                        </button>
                        <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#github"></use>
                            </svg>
                            Log in with GitHub
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
