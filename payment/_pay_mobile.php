<?php
// Including the navigation bar and database and collection data from session which is already set in navbar
include '_nav_payment.php';
include '../partials/_connect.php';

$friend_id = $_SESSION['friend_id'];
$login_user_id = $_SESSION['login_user_id'];

// Collecting data of final transaction from form which is below same page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!($_POST['myAmount']) || !($_POST['myPassword']) || !($_POST['cPassword'])) {
            echo "Enter some details";
            header("location: _pay_mobile.php");
        } else {

        $amount = $_POST['myAmount'];
        $password = $_POST['myPassword'];
        $cpassword = $_POST['cPassword'];
        
        // Fetching the logged in user's available balance from database -- balance_check
        $sql = "SELECT * FROM `balance_check` WHERE login_user_id='$login_user_id'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $balance_available = $row['balance_available'];
        
        if ($balance_available < $amount) {
            echo
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Transaction failed!</strong> Check your account Balance!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            // Fetching the data of the mobile sender which we had recently add in database -- friends from _pay_mobile_no page
            $sql = "SELECT * FROM `friends` WHERE user_friend_id='$friend_id'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $transaction_by = $row['user_friend_name'];

            if ($password != $cpassword) {
                echo "incorrect password";
                echo
                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Incorrect Payment!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {

                // Updating the logged in user's balance database -- balance_check
                $updated_balance = $balance_available - $amount;

                $sql = "UPDATE `balance_check` SET `balance_available`=$updated_balance,`Date/Time`='[current_timestamp()]' WHERE `login_user_id`=$login_user_id";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    echo
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Your Money has not been debited!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                } else {
                    echo
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Payment Done!</strong> Your Money has been debited!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                                    
                    // Inseting the transaction history to database -- balance
                    $sql = "INSERT INTO `balance` (`login_user_id`, `transaction_done_by`, `transaction_amount`, `transation_date`) VALUES ('$login_user_id', '$transaction_by', '$amount', current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    
                        if (!$result) {
                            // echo "money has not been deducted";
                            
                        } else {
                            // echo "money has been deducted";
                            // header("location: ../index.php");
                        }
                    }
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay Mobile</title>
    <script src="https://kit.fontawesome.com/eb7f9471ef.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <!-- ------------------------------------ -->
    <br>
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Money Transfer
        </button>
    </div>
    <br>
    <div class="container d-flex flex-row justify-content-around">

        <!-- sender's div -->
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                <div class="card-header py-3 text-bg-primary border-primary">
                    <h4 class="my-0 fw-normal text-center">Sender</h4>
                </div>
                <div class="card-body align-center">
                    <?php
                // Fetching the Logged in user's information from database -- login
                $sql = "SELECT * FROM `login` WHERE user_id='$login_user_id'";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                echo
                '<ul class="list-unstyled list-block text-center mt-3 mb-4">
                    <li class="list-block-item"><object data="../svg/svg-sender.svg" width="100" height="100"> </object></li>
                    <li class="list-block-item"><h2>' . $row['user_name'] . '</h2></li>
                    <li class="list-block-item"><h2>8108595232</h2></li>
                    <li class="list-block-item">' . $row['user_name'] . '@okhdfc</li>
                </ul>
                <button type="button" class="w-100 btn btn-lg btn-primary">More Info</button>';
                ?>
                </div>
            </div>
        </div>

        <div class="px-5 justify-content-center my-auto">
            <object data="../svg/svg-transfer-2.svg" width="100" height="100"> </object>
        </div>

        <!-- receiver's div -->
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                <div class="card-header py-3 text-bg-primary border-primary">
                    <h4 class="my-0 fw-normal text-center">Receiver</h4>
                </div>
                <div class="card-body">
                    <?php
                // Fetching the Logged in user's information from database -- login
                $sql = "SELECT * FROM `friends` WHERE user_friend_id='$friend_id'";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                echo
                '<ul class="list-unstyled list-block text-center mt-3 mb-4">
                    <li class="list-block-item"><object data="../svg/svg-sender.svg" width="100" height="100"> </object></li>
                    <li class="list-block-item"><h2>' . $row['user_friend_name'] . '</h2></li>
                    <li class="list-block-item">' . $row['user_friend_phone'] . '</li>
                    <li class="list-block-item">' . $row['user_friend_name'] . '@okaxis</li>
                </ul>
                <button type="button" class="w-100 btn btn-lg btn-primary">More Info</button>';
                ?>
                </div>
            </div>
        </div>
    </div>

    <!-- mobile pay page coursel -->
    <div class="container mx-auto">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/coursel3.jpg" style="height:80vh; width:80%;" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Modal -->
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment to &nbsp;
                            <?php
                                //Fetching the receiver's data from database -- bank_user
                                $sql = "SELECT * FROM `friends` WHERE user_friend_id='$friend_id'";
                                $result = mysqli_query($conn, $sql);

                                $row = mysqli_fetch_assoc($result);
                                echo '<h3>' . $row['user_friend_name'] . '</h3>';
                            ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="/fastpay/payment/_pay_mobile.php" method="POST">
                            <div class="form-group">
                                <label for="amount">Amount :</label>
                                <input type="number" class="form-control" id="amount" name="myAmount">
                            </div>

                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" id="password" name="myPassword">
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm Password :</label>
                                <input type="password" class="form-control" id="cpassword" name="cPassword">
                                <small class="form-text text-muted">Write the same password again!
                                </small>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-secondary">Send Now!</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '../partials/_footer.php';
    ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
</body>

</html>