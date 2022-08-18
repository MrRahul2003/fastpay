<?php
session_start();
    // echo var_dump($_SESSION['login']);
    if (!($_SESSION['signin'])) {
        header("location: ../partials/_signin.php");
        exit;
    }
?>
<?php
include '../partials/_connect.php';

    $user_name = $_SESSION['user_name'];

// checking the existance of user in our database
    $sql = "SELECT * FROM `login` WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
     $login_user_id = $row['user_id'];

    // checking users existance in our databases
    $rowsNO = mysqli_num_rows($result);
    echo $rowsNO;

    if ($rowsNO == 1) {
        // inserting pre balance in user's account
        $sql = "INSERT INTO `balance_check` (`login_user_id`, `balance_available`, `Date/Time`) VALUES ('$login_user_id', '1000', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            echo "initial amount has not been inserted";
            header("location: ../partials/_login.php");
            
            
        } else {
            echo "initial amount has been inserted";
            header("location: ../partials/_login.php");
        }
    } else {
        echo "Log in unsuccessful! Sign in first";
    }

?>
