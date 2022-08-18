<?php
// starting session and collecting session data from login page and connecting to database
session_start();
$login_user_id = $_SESSION['login_user_id'];

include '../partials/_connect.php';

// Collecting data from form that is in the index page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // checking that user has send some details or not
    if (!($_POST['myName']) || !($_POST['myPhone'])) {
        echo "Enter some details";
        header("location: ../index.php");
    } else {

        $name = $_POST['myName'];
        $phone = $_POST['myPhone'];

        // inseting the collected data of mobile sender from form to database -- friends
        $sql = "INSERT INTO `friends` (`login_user_id`, `user_friend_name`, `user_friend_phone`, `Date//Time`) VALUES ('$login_user_id', '$name', '$phone', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Friend data cannot be inserted";
            header("location: index.php");
        } else {
            echo "Friend data has be inserted";

            // Fetching the data of the mobile sender which we had recently add in database -- friends  and sending the fetched data to pay_mobile page
            $sql = "SELECT * FROM `friends` WHERE user_friend_name='$name' AND user_friend_phone='$phone'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $_SESSION['friend_id'] = $row['user_friend_id'];
            $_SESSION['login_user_id'] = $login_user_id;
            header("location: _pay_mobile.php");
        }
    }
}
?>
